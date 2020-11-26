<?php

declare(strict_types=1);

namespace functional;

use Codeception\Util\HttpCode;
use FunctionalTester;

class AddProductCest
{
    public function _before(FunctionalTester $I)
    {
    }


    // tests
    public function should_add_product_to_cart(FunctionalTester $I)
    {
        $I->sendPost(
            '/cart/product',
            [
                'customer_uuid' => '4c87ea6d-1249-4bf1-bb36-863be3f22188',
                'product_uuid'  => '7fad1dfc-dd9a-49eb-b11c-145c3e8f6cbc',
                'quantity'      => 100,
            ]
        );

        $I->seeResponseCodeIs(HttpCode::CREATED);
    }
}
