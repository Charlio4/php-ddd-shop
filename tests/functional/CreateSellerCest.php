<?php

declare(strict_types=1);

namespace functional;

use Codeception\Util\HttpCode;
use FunctionalTester;

class CreateSellerCest
{
    private array $json_decode;


    public function __construct()
    {
        $this->json_decode = [];
    }


    public function _before(FunctionalTester $I)
    {
    }


    public function should_create_seller(FunctionalTester $I)
    {
        $I->sendPost(
            '/seller',
            [
                'name' => 'Carlos',
            ]
        );

        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();

        $response          = $I->grabResponse();
        $this->json_decode = json_decode($response, true);

        $I->seeResponseMatchesJsonType(
            [
                'seller_uuid' => 'string',
            ]
        );
    }
}
