<?php

class ProductControllerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;


    public function testAddProduct()
    {
        $controller = new \App\Controllers\ProductController();

        // Mock the request parameters
        $controller->request = ['id'=>1000, 'name' => 'Product 1', 'state' => 'abcd', 'zip'=>12345, 'amount' => 1, 'quantity' => 2, 'item' => 'a2b3'];

        // Mock the data returned by the Product model's getData() method
        $mockData = [
            
        ];
        
        // Set the mock Product model in the controller
        $reflection = new ReflectionClass(\App\Controllers\ProductController::class);
        $property = $reflection->getProperty('data');
        $property->setAccessible(true);
        $property->setValue($controller, $mockData);
        
        $this->expectOutputRegex('/Product added successfully/i');
        $controller->addProduct();
    }
    public function testAddProductAlreadyExists()
    {
        $controller = new \App\Controllers\ProductController();

        // Mock the request parameters
        $controller->request = ['id'=>1000, 'name' => 'Product 1', 'state' => 'abcd', 'zip'=>'12345', 'amount' => 1, 'quantity' => 2, 'item' => 'a2b3'];

        // Mock the data returned by the Product model's getData() method
        $mockData = [
            ['id'=>1000, 'name' => 'Product 1', 'state' => 'abcd', 'zip'=>'12456', 'amount' => 1, 'quantity' => 3, 'item' => 'a2b3']
        ];
        // Set the mock Product model in the controller
        $reflection = new ReflectionClass(\App\Controllers\ProductController::class);
        $property = $reflection->getProperty('data');
        $property->setAccessible(true);
        $property->setValue($controller, $mockData);
        
        $controller->addProduct();
        $this->expectOutputString('{"message":"Product already exists","data":null}');
    }

    public function testUpdateProduct()
    {
        $controller = new \App\Controllers\ProductController();

        // Mock the request parameters
        $controller->request = ['id'=>1000, 'name' => 'Product 1', 'state' => 'abcd', 'zip'=>'12345', 'amount' => 1, 'quantity' => 2, 'item' => 'a2b3'];

        // Mock the data returned by the Product model's getData() method
        $mockData = [
            ['id'=>1000, 'name' => 'Product 1', 'state' => 'abcd', 'zip'=>'12345', 'amount' => 1, 'quantity' => 2, 'item' => 'a2b3']
        ];
        // Set the mock Product model in the controller
        $reflection = new ReflectionClass(\App\Controllers\ProductController::class);
        $property = $reflection->getProperty('data');
        $property->setAccessible(true);
        $property->setValue($controller, $mockData);
        
        $controller->updateProduct();
        $this->expectOutputRegex('/Product updated successfully/i');
    }
    public function testDeleteProduct()
    {
        $controller = new \App\Controllers\ProductController();

        // Mock the request parameters
        $controller->request = ['id'=>1000, 'name' => 'Product 1', 'state' => 'aass', 'zip'=>'axxa', 'amount' => 1, 'quantity' => 2, 'item' => 'a'];

        // Mock the data returned by the Product model's getData() method
        $mockData = [
            ['id'=>1000, 'name' => 'Product 1', 'state' => 'a', 'zip'=>'a', 'amount' => 1, 'quantity' => 222, 'item' => 'a']
        ];
        
        // Set the mock Product model in the controller
        $reflection = new ReflectionClass(\App\Controllers\ProductController::class);
        $property = $reflection->getProperty('data');
        $property->setAccessible(true);
        $property->setValue($controller, $mockData);
        
        $controller->deleteProduct();
        $this->expectOutputRegex('/Product deleted successfully/i');
    }
    public function testValidator()
    {
        $product = new \App\Models\Product();

        // Mock the request parameters
        $request = [
            "amount" => "12",
            "name" => "hars",
            "quantity" => "1",
            "state" => "jars"
        ];

        
        $result = $product->validateProduct($request);
        $this->assertEquals(false,$result);
    }

}