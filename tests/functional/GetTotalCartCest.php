<?php

declare(strict_types=1);

namespace functional;

use Codeception\Util\HttpCode;
use FunctionalTester;

class GetTotalCartCest
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
        $I->sendGet('/cart/total/4c87ea6d-1249-4bf1-bb36-863be3f22188');

        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();

        $response          = $I->grabResponse();
        $this->json_decode = json_decode($response, true);

        $I->seeResponseMatchesJsonType(
            [
                'total_amount' => 'string',
            ]
        );
    }
}
