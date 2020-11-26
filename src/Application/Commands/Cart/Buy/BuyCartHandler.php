<?php

declare(strict_types=1);

namespace Api\Application\Commands\Cart\Buy;

use Api\Domain\Entity\Cart;
use Api\Domain\Exceptions\CartException;
use Api\Domain\Service\EntityFinder\CartFinderInterface;

final class BuyCartHandler
{
    private CartFinderInterface $cartFinder;


    /**
     * BuyCartHandler constructor.
     * @param CartFinderInterface $cartFinder
     */
    public function __construct(
        CartFinderInterface $cartFinder
    ) {
        $this->cartFinder = $cartFinder;
    }


    public function __invoke(BuyCartCommand $command): bool
    {
        $carts = $this->cartFinder->getCartsByCustomerAndStatusInProgress(
            $command->getCustomerUuid()
        );

        if (!$carts) {
            throw new CartException('Carts to buy not founded', 404);
        }

        /** @var Cart $cart */
        foreach ($carts as $cart) {
            $cart->buyCart();
        }

        return true;
    }
}
