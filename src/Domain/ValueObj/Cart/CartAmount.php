<?php

declare(strict_types=1);

namespace Api\Domain\ValueObj\Cart;

use Api\Domain\ValueObj\Base\FloatTrait;

final class CartAmount
{
    use FloatTrait;

    public static function calcAmount(int $quantity, float $price)
    {
        $amount = $quantity * $price;

        return self::fromNumber($amount);
    }
}
