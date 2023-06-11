<?php

class ProductApiTest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function getAllProductsApi(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGet('/products', [ ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'message' => "Products retrieved successfully"
          ]);
    }
    // Check add new product
    public function addNewProductApi(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/products/add', ['id'=>1000, 'name' => 'Product a', 'state' => 'abcd', 'zip'=>'12456', 'amount' => 1, 'quantity' => 3, 'item' => 'a2b3']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'message' => "Product added successfully"
          ]);
    }
    // Check add new product
    public function updateProductApi(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/products/update', ['id'=>1000, 'name' => 'Product a', 'state' => 'abcd', 'zip'=>'12456', 'amount' => 2, 'quantity' => 3, 'item' => 'a2b3']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'message' => "Product updated successfully"
          ]);
    }
    public function deleteProductApi(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/products/delete', ['id'=>1000, 'name' => 'Product a', 'state' => 'abcd', 'zip'=>'12456', 'amount' => 2, 'quantity' => 3, 'item' => 'a2b3']);
        $I->seeResponseCodeIs(204);
    }
}
