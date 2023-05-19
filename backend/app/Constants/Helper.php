<?php

trait Helper {
    
    private $csvFilePath = __DIR__.'/../../storage/data.csv';

    // Common function to retrive POST request parameters
    public function getPostParams()
    {
        if(!empty($_POST)) {
            return $_POST;
        }
        $post = json_decode(file_get_contents('php://input'), true);
        if(json_last_error() == JSON_ERROR_NONE) {
            return $post;
        }
        return [];
    }

    // Common function to return data in Json format with headers
    public function returnResponse($code,$data,$message) {
        $resp = [
            "message" => $message,
            "data" => $data
        ];
        header("HTTP/1.0 $code $message");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resp);
    }
    
    // Opens csv file and write to file
    public function writeToCsv($data) {
        
        $fp = fopen($this->csvFilePath, 'w');    
        fputcsv($fp, $this->header);

        foreach ($data as $rows) {
            fputcsv($fp, array_values($rows));
        } 
        return $data;
    }

    // Reads data from csv file
    public function getCsvData() {
        
        try {
            // Create file if not exists
            if (!file_exists($this->csvFilePath)) {
                fopen($this->csvFilePath, 'w') or die("Can't create file");
            }
            $header = NULL;
            $data = array();

            $handle = fopen($this->csvFilePath, 'r');
            // Reads earch row from csv
            while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
            {
                // to skip header
                if(!$header){
                    $header = $row;
                } else{
                    if(count($row)) {
                        $data[] = array_combine($header, $row);
                    }
                }
            }
            fclose($handle);
            
            return $data;
        } catch(Exception $e) {
            $this->returnResponse(500,null,"Something went wrong!");
        }

    }
}
