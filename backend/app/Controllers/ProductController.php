<?php

namespace App\Controllers;

use App\Models\Product;
use Helper;

class ProductController
{
    use Helper;
    public $productModel;
    public $data = [];
    public $request;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->data = $this->productModel->getData();
        $this->request = $this->getParams();
    }

    public function getAllProducts()
    {
        $data = $this->productModel->getData();
        $this->returnResponse(200, $data, "Products retrieved successfully");
    }

    public function addProduct()
    {
        $errors = $this->productModel->validateProduct($this->request);
        if ($errors) {
            $this->returnResponse(422, null, "Unprocessable Entity, Invalid product data");
        } else {
            $keys = array_column($this->productModel->getData(), 'name');
            $index = array_search($this->request['name'], $keys);
            if ($index === false) {
                $newRow = $this->productModel->addProduct($this->productModel->getData(), $this->request);
                $data[] = $newRow;
                $this->returnResponse(200, $data, "Product added successfully");
            } else {
                $this->returnResponse(409, null, "Product already exists");
            }
        }
    }

    public function updateProduct()
    {
        $errors = $this->productModel->validateProduct($this->request);
        if ($errors) {
            $this->returnResponse(422, null, "Unprocessable Entity, Invalid product data");
        } else {
            $keys = array_column($this->productModel->getData(), 'id');
            $index = array_search($this->request['id'], $keys);

            if ($index !== false) {
                $this->data = $this->productModel->updateProduct($this->productModel->getData(), $index, $this->request);
                $this->returnResponse(200, $this->data, "Product updated successfully");
            } else {
                $this->returnResponse(404, null, "No product found");
            }
        }
    }

    public function deleteProduct()
    {
        $errors = $this->productModel->validateProduct($this->request);
        if ($errors) {
            $this->returnResponse(422, null, "Unprocessable Entity, Invalid product data");
        } else {
            $keys = array_column($this->productModel->getData(), 'id');
            $index = array_search($this->request['id'], $keys);
            if ($index !== false) {
                $this->data = $this->productModel->deleteProduct($this->productModel->getData(), $index);
                $this->returnResponse(204, null, "Product deleted successfully");
            } else {
                $this->returnResponse(404, null, "No products found");
            }
        }
    }
}