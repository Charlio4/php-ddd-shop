<?php

declare(strict_types=1);

namespace Api\Application\Commands\Cart\RemoveFromCart;

use Api\Domain\Common\WriteModelInterface;
use Api\Domain\Entity\Cart;
use Api\Domain\Entity\Product;
use Api\Domain\Exceptions\CartException;
use Api\Domain\Exceptions\ProductException;
use Api\Domain\Service\EntityFinder\CartFinderInterface;
use Api\Domain\Service\EntityFinder\ProductFinderInterface;
use Throwable;

final class RemoveProductFromCartHandler
{
    private WriteModelInterface $writeModel;

    private ProductFinderInterface $productFinder;

    private CartFinderInterface $cartFinder;


    /**
     * RemoveProductHandler constructor.
     * @param WriteModelInterface $writeModel
     * @param ProductFinderInterface $productFinder
     * @param CartFinderInterface $cartFinder
     */
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
     * @param RemoveProductFromCartCommand $command
     * @throws Throwable
     * @return bool
     */
    public function __invoke(RemoveProductFromCartCommand $command): bool
    {
        $product = $this->getProduct($command);
        $cart    = $this->getCart($command);

        $cart->setProduct($product);
        $cart->decreaseQuantity(
            $command->getQuantity(),
            $product->getPrice()
        );

        if ($cart->quantityIsZero()) {
            $cart->removeProductFromCart();

            return true;
        }

        $cart->updateProductFromCart();

        return true;
    }


    /**
     * @param RemoveProductFromCartCommand $command
     * @return Product
     */
    private function getProduct(RemoveProductFromCartCommand $command): Product
    {
        $product = $this->productFinder->getProductByUuid($command->getProductUuid());

        if (!$product) {
            throw new ProductException('Product not found', 404);
        }

        return $product;
    }


    /**
     * @param RemoveProductFromCartCommand $command
     * @return Cart
     */
    private function getCart(RemoveProductFromCartCommand $command): Cart
    {
        $cart = $this->cartFinder->getCartByCustomerAndProduct(
            $command->getCustomerUuid(),
            $command->getProductUuid()
        );

        if (!$cart) {
            throw new CartException('Product not founded in this cart', 404);
        }

        return $cart;
    }
}
