<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Entity;

use Api\Domain\Entity\Cart;
use Api\Domain\Exceptions\CartException;
use Api\Domain\ValueObj\Cart\CartStatus;
use Api\Domain\ValueObj\Product\ProductQuantity;

final class CartSpecification
{
    public static function checkDecreaseQuantity(Cart $cart, ProductQuantity $quantity)
    {
        $entityQuantity = $cart->getQuantity();

        if ($quantity > $entityQuantity) {
            throw new CartException("You can't delete so many units", 400);
        }
    }


    public static function checkBuyCart(Cart $cart)
    {
        $status = $cart->getStatus();

        if (CartStatus::COMPLETED == $status->toStr()) {
            throw new CartException('Cart already buyed', 400);
        }
    }
}
