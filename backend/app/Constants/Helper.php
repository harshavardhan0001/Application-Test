<?php

trait Helper {
    
    public function getParams()
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

    public function returnResponse($code,$data,$message) {
        $resp = [
            "message" => $message,
            "data" => $data
        ];
        header("HTTP/1.0 $code $message");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resp);
    }
    
    public function writeToCsv($data) {
        
        $fp = fopen($this->csvFilePath, 'w');    
        fputcsv($fp, $this->header);

        foreach ($data as $rows) {
            fputcsv($fp, array_values($rows));
        } 
        return $data;
    }

    public function getCsvData() {
        
        $header = NULL;
        $data = array();
        if (($handle = fopen($this->csvFilePath, 'r')) !== FALSE)
        {
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
        }
        return $data;
    }
}
