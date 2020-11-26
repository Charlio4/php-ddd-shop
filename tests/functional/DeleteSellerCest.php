<?php

declare(strict_types=1);

namespace functional;

use Codeception\Util\HttpCode;
use FunctionalTester;

class DeleteSellerCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function should_delete_celler(FunctionalTester $I)
    {
        $I->sendDelete(
            '/seller/uuid/c8644b26-14e6-4664-88bf-efaed7293c49',
        );

        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
