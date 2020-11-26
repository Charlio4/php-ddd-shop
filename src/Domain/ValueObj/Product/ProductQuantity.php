<?php

declare(strict_types=1);

namespace Api\Domain\ValueObj\Product;

use Api\Domain\ValueObj\Base\IdTrait;
use Throwable;

final class ProductQuantity
{
    use IdTrait;

    /**
     * @param int $quantity
     * @throws Throwable
     * @return self
     */
    public static function fromInt(int $quantity): self
    {
        return self::fromInteger($quantity);
    }


    /**
     * @param ProductQuantity $quantity1
     * @param ProductQuantity $quantity2
     * @throws Throwable
     * @return static
     */
    public static function increase(self $quantity1, self $quantity2): self
    {
        $sumQuantity = $quantity1->toInt() + $quantity2->toInt();

        return self::fromInt($sumQuantity);
    }


    /**
     * @param ProductQuantity $quantity1
     * @param ProductQuantity $quantity2
     * @throws Throwable
     * @return static
     */
    public static function decrease(self $quantity1, self $quantity2): self
    {
        $decreaseQuantity = $quantity1->toInt() - $quantity2->toInt();

        return self::fromInt($decreaseQuantity);
    }
}
