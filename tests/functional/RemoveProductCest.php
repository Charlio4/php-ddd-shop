<?php

declare(strict_types=1);

namespace functional;

use Codeception\Util\HttpCode;
use FunctionalTester;

class RemoveProductCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function should_remove_product_to_cart(FunctionalTester $I)
    {
        $I->sendPut(
            '/cart/product',
            [
                'customer_uuid' => '4c87ea6d-1249-4bf1-bb36-863be3f22188',
                'product_uuid'  => '7fad1dfc-dd9a-49eb-b11c-145c3e8f6cbc',
                'quantity'      => 1,
            ]
        );

        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
