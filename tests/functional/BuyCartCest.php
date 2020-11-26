<?php

declare(strict_types=1);

namespace functional;

use Codeception\Util\HttpCode;
use FunctionalTester;

class BuyCartCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->sendPut(
            '/cart/buy',
            [
                'customer_uuid' => '4c87ea6d-1249-4bf1-bb36-863be3f22188',
            ]
        );

        $I->seeResponseCodeIs(HttpCode::OK);
    }
}
