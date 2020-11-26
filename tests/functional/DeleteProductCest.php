<?php

declare(strict_types=1);

namespace functional;

use Codeception\Util\HttpCode;
use FunctionalTester;

class DeleteProductCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function should_delete_product(FunctionalTester $I)
    {
        $I->sendDelete(
            '/product/uuid/7fad1dfc-dd9a-49eb-b11c-145c3e8f6cbc',
        );

        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
