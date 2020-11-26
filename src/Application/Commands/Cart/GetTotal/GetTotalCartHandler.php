<?php

declare(strict_types=1);

namespace Api\Application\Commands\Cart\GetTotal;

use Api\Domain\Entity\Cart;
use Api\Domain\Exceptions\CartException;
use Api\Domain\Service\EntityFinder\CartFinderInterface;

final class GetTotalCartHandler
{
    private CartFinderInterface $cartFinder;


    /**
     * GetTotalCartHandler constructor.
     * @param CartFinderInterface $cartFinder
     */
    public function __construct(CartFinderInterface $cartFinder)
    {
        $this->cartFinder = $cartFinder;
    }


    /**
     * @param GetTotalCartCommand $command
     * @return float
     */
    public function __invoke(GetTotalCartCommand $command): float
    {
        $carts = $this->cartFinder->getCartsByCustomerAndStatusInProgress(
            $command->getCustomerUuid(),
        );

        if (!$carts) {
            throw new CartException('Cart not found', 400);
        }

        $totalAmount = null;
        /** @var Cart $cart */
        foreach ($carts as $cart) {
            $totalAmount += $cart->getAmount()->toFloat();
        }

        return $totalAmount;
    }
}
