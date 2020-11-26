<?php

declare(strict_types=1);

namespace Api\Application\Commands\Cart\Add;

use Api\Domain\Common\WriteModelInterface;
use Api\Domain\Entity\Cart;
use Api\Domain\Entity\Product;
use Api\Domain\Exceptions\ProductException;
use Api\Domain\Service\EntityFinder\CartFinderInterface;
use Api\Domain\Service\EntityFinder\ProductFinderInterface;
use Exception;
use Ramsey\Uuid\Uuid;
use Throwable;

final class AddProductHandler
{
    private WriteModelInterface $writeModel;

    private ProductFinderInterface $productFinder;

    private CartFinderInterface $cartFinder;


    public function __construct(
        WriteModelInterface $writeModel,
        ProductFinderInterface $productFinder,
        CartFinderInterface $cartFinder
    ) {
        $this->writeModel    = $writeModel;
        $this->productFinder = $productFinder;
        $this->cartFinder    = $cartFinder;
    }


    /**
     * @param AddProductCommand $command
     * @throws Throwable
     * @return bool
     */
    public function __invoke(AddProductCommand $command): bool
    {
        $product = $this->productExists($command);

        $cart = $this->cartFinder->getCartByCustomerAndProduct(
            $command->getCustomerUuid(),
            $command->getProductUuid()
        );

        if ($cart) {
            $this->updateCart($cart, $command, $product);

            return true;
        }

        $this->createCart($command, $product);

        return true;
    }


    /**
     * @param AddProductCommand $command
     * @return Product
     */
    private function productExists(AddProductCommand $command): Product
    {
        $product = $this->productFinder->getProductByUuid($command->getProductUuid());

        if (!$product) {
            throw new ProductException('Product not found', 404);
        }

        return $product;
    }


    /**
     * @param Cart $cart
     * @param AddProductCommand $command
     * @param Product $product
     * @throws Throwable
     * @return bool
     */
    private function updateCart(
        Cart $cart,
        AddProductCommand $command,
        Product $product
    ) {
        $cart->increaseQuantity($command->getQuantity());
        $cart->setAmount($cart->getQuantity(), $product->getPrice());

        $this->writeModel->update($cart);
    }


    /**
     * @param AddProductCommand $command
     * @param Product $product
     * @throws Exception
     * @return bool
     */
    private function createCart(AddProductCommand $command, Product $product): bool
    {
        $cart = Cart::create(
            Uuid::uuid4(),
            $command->getCustomerUuid(),
            $command->getProductUuid(),
            $command->getQuantity(),
            $product
        );

        $cart->setStatusInProgress();

        $this->writeModel->save($cart);

        return true;
    }
}
