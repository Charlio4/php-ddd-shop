<?php

declare(strict_types=1);

namespace Api\Application\Commands\Cart\Delete;

use Api\Domain\Common\WriteModelInterface;
use Api\Domain\Exceptions\CartException;
use Api\Domain\Service\EntityFinder\CartFinderInterface;

final class DeleteCartHandler
{
    private WriteModelInterface $writeModel;

    private CartFinderInterface $cartFinder;


    /**
     * RemoveCartHandler constructor.
     * @param WriteModelInterface $writeModel
     * @param CartFinderInterface $cartFinder
     */
    public function __construct(WriteModelInterface $writeModel, CartFinderInterface $cartFinder)
    {
        $this->writeModel = $writeModel;
        $this->cartFinder = $cartFinder;
    }


    public function __invoke(DeleteCartCommand $command)
    {
        $carts = $this->cartFinder->getCartsByCustomer($command->getCustomerUuid());

        if (!$carts) {
            throw new CartException('Cart not found', 404);
        }

        foreach ($carts as $cart) {
            $this->writeModel->delete($cart);
        }

        return true;
    }
}
