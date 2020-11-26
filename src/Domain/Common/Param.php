<?php

declare(strict_types=1);

namespace Api\Domain\Common;

class Param
{
    const UUID        = 'uuid';
    const CREATED_AT  = 'created_at';

    const SELLER_UUID = 'seller_uuid';
    const SELLER_NAME = 'name';

    const PRODUCT             = 'product';
    const PRODUCT_UUID        = 'product_uuid';
    const PRODUCT_SELLER_UUID = 'seller_uuid';
    const PRODUCT_NAME        = 'name';
    const PRODUCT_PRICE       = 'price';
    const PRODUCT_QUANTITY    = 'quantity';

    const CUSTOMER_UUID      = 'customer_uuid';
    const CUSTOMER_FIRSTNAME = 'firstname';
    const CUSTOMER_LASTNAME  = 'lastname';

    const CART_UUID         = 'cart_uuid';
    const CART_STATUS       = 'status';
    const CART_AMOUNT       = 'amount';
    const CART_TOTAL_AMOUNT = 'total_amount';
}
