<?php

trait Helper {
    
    public static $filename = 'data.csv';

    public function getData()
    {
        if(!file_exists($this::$filename) || !is_readable($this::$filename))
            return FALSE;
    
        $header = NULL;
        $data = array();
        if (($handle = fopen($this::$filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
    
    public function getPost()
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

    public function addData($data,$request){
        
        $newRow = [];
        $newRow["id"] = count($data) ? ($data[count($data)-1]["id"] + 1)  : 1;
        $newRow["name"] = $request["name"];
        $newRow["state"] = $request["state"];
        $newRow["zip"] = $request["zip"];
        $newRow["amount"] = $request["amount"];
        $newRow["qty"] = $request["qty"];
        $newRow["item"] = $request["item"];
        $fp = fopen($this::$filename, 'a');    
        fputcsv($fp, array_values($newRow));

        return $data;
    }
    public function updateData($data,$index,$request){
        
        $data[$index] = $request; // update old data with new

        $fp = fopen($this::$filename, 'w');    
        fputcsv($fp, array_keys($data[0]));
        foreach ($data as $rows) {
            fputcsv($fp, array_values($rows));
        } 
    
        return $data;
    }
    public function deleteData($data,$index){
        
        $fp = fopen($this::$filename, 'w');
        fputcsv($fp, array_keys($data[0]));

        array_splice($data, $index, 1); // deletes
        foreach ($data as $rows) {
                fputcsv($fp, array_values($rows));
        } 
        return $data;
    }

    public function returnResponse($resp) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resp, JSON_PRETTY_PRINT);
        exit;
    }
}
