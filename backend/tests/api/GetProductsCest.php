<?php

class GetProductsCest
{
    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $response = $I->sendGet('/products', [ ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->seeResponseContainsJson([
            'status' => "success"
          ]);
    }
}
