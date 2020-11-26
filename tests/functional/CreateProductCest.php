<?php

declare(strict_types=1);

namespace functional;

use Codeception\Util\HttpCode;
use FunctionalTester;

class CreateProductCest
{
    private array $json_decode;


    public function __construct()
    {
        $this->json_decode = [];
    }


    public function _before(FunctionalTester $I)
    {
    }


    // tests
    public function should_create_product(FunctionalTester $I)
    {
        $I->sendPost(
            '/product',
            [
                'seller_uuid' => '2c7d51ec-7814-4998-a130-a912debb24ae',
                'name'        => 'Product test',
                'price'       => 10.50,
            ]
        );

        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();

        $response          = $I->grabResponse();
        $this->json_decode = json_decode($response, true);

        $I->seeResponseMatchesJsonType(
            [
                'product_uuid' => 'string',
            ]
        );
    }
}
