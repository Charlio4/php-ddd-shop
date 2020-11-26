<?php

declare(strict_types=1);

namespace Api\Domain\Events\Cart;

use Api\Domain\Common\Param;
use Api\Domain\Entity\Cart;
use Api\Domain\Entity\Product;
use Api\Domain\Events\Common\AbstractEvent;
use Api\Domain\ValueObj\Base\CreatedAt;
use Api\Domain\ValueObj\Cart\CartAmount;
use Api\Domain\ValueObj\Cart\CartStatus;
use Api\Domain\ValueObj\Product\ProductQuantity;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

final class CartWasBuyed extends AbstractEvent
{
    private UuidInterface $uuid;

    private UuidInterface $customerUuid;

    private UuidInterface $productUuid;

    private ProductQuantity $quantity;

    private CartStatus $status;

    private CreatedAt $createdAt;

    /** @var Product[]|ArrayCollection */
    private $product;

    private CartAmount $amount;


    public function __construct(Cart $cart)
    {
        $this->uuid         = $cart->getUuid();
        $this->customerUuid = $cart->getCustomerUuid();
        $this->productUuid  = $cart->getProductUuid();
        $this->quantity     = $cart->getQuantity();
        $this->status       = $cart->getStatus();
        $this->createdAt    = $cart->getCreatedAt();
        $this->product      = $cart->getProduct();
        $this->amount       = $cart->getAmount();

        parent::__construct();
    }


    protected function index(): string
    {
        return $this->uuid->toString() . '/' . $this->customerUuid->toString();
    }


    protected function payload(): array
    {
        return [
            Param::UUID             => $this->uuid->toString(),
            Param::CUSTOMER_UUID    => $this->customerUuid->toString(),
            Param::PRODUCT_UUID     => $this->productUuid->toString(),
            Param::PRODUCT_QUANTITY => $this->quantity->toInt(),
            Param::CART_STATUS      => $this->status->toStr(),
            Param::CREATED_AT       => $this->createdAt->toStr(),
            Param::CART_AMOUNT      => $this->amount->toFloat(),
        ];
    }
}
