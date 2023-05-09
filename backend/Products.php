<?php

include_once realpath(dirname(__FILE__)) . '\Helper.php';

class Products {
    use Helper;

    public static function getProducts(){
        $helper = new Products();
        $data = $helper->getData();
        $resp = [
            "status" => "success",
            "message" => "Products retrived successfully",
            "data" => $data
        ];
        $helper->returnResponse($resp);
    }

    public static function add() {
        $helper = new Products();
        // Get Payload Data
        $request = $helper->getPost();
        
        // Get CSV Data
        $data = $helper->getData();

        // Check Data already exist
        $keys = array_column($data, 'name');
        $index = array_search($request['name'], $keys);

        // If data does not exists, insert into csv
        if($index === false) {
            $newRow = $helper->addData($data,$request);

            $data[] = $newRow;
            $resp = [
                "status" => "success",
                "message" => "Products added successfully",
                "data" => $data
            ];
        } else {
            $resp = [
                "status" => "error",
                "message" => "Product already exists"
            ];

        }
        $helper->returnResponse($resp);
    }

    public static function update() {
        $helper = new Products();
        $request = $helper->getPost();
    
        $data = $helper->getData();
        $keys = array_column($data, 'id');
        $index = array_search($request['id'], $keys);
        if($index !== false) {
            $data = $helper->updateData($data,$index,$request);
            $resp = [
                "status" => "success",
                "message" => "Product updated successfully",
                "data" => $data
            ];
            
        } else {
            $resp = [
                "status" => "error",
                "message" => "No product found"
            ];

        }
        $helper->returnResponse($resp);
    }

    public static function delete() {
        
        $helper = new Products();
        $request = $helper->getPost();
        
        $data = $helper->getData();
        $keys = array_column($data, 'id');
        $index = array_search($request['id'], $keys);
        if($index !== false) {
            $data = $helper->deleteData($data, $index);
            $resp = [
                "status" => "success",
                "message" => "Product deleted Successfully",
                "data" => $data
            ];
        } else {
            $resp = [
                "status" => "error",
                "message" => "No products found"
            ];
    
        }
        $helper->returnResponse($resp);

    }

}