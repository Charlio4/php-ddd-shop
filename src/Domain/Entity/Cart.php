<?php

declare(strict_types=1);

namespace Api\Domain\Entity;

use Api\Domain\Entity\Common\EntityEvent;
use Api\Domain\Events\Cart\CartWasBuyed;
use Api\Domain\Events\Cart\ProductFromCartWasDeleted;
use Api\Domain\Events\Cart\ProductFromCartWasUpdated;
use Api\Domain\Specification\Entity\CartSpecification;
use Api\Domain\ValueObj\Base\CreatedAt;
use Api\Domain\ValueObj\Cart\CartAmount;
use Api\Domain\ValueObj\Cart\CartStatus;
use Api\Domain\ValueObj\Product\ProductPrice;
use Api\Domain\ValueObj\Product\ProductQuantity;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;
use Throwable;

class Cart extends EntityEvent
{
    const ALIAS = 'ca';

    private UuidInterface $uuid;

    private UuidInterface $customerUuid;

    private UuidInterface $productUuid;

    private ProductQuantity $quantity;

    private CartStatus $status;

    private CreatedAt $createdAt;

    /** @var Product[]|ArrayCollection */
    private $product;

    private CartAmount $amount;


    private function __construct()
    {
        $this->product   = new ArrayCollection();
        $this->createdAt = CreatedAt::now();
    }


    public static function create(
        UuidInterface $uuid,
        UuidInterface $customerUuid,
        UuidInterface $productUuid,
        ProductQuantity $quantity,
        Product $product
    ): self {
        $instance = new static();

        $instance->uuid         = $uuid;
        $instance->customerUuid = $customerUuid;
        $instance->productUuid  = $productUuid;
        $instance->quantity     = $quantity;

        $instance->setProduct($product);
        $instance->setAmount($instance->quantity, $product->getPrice());

        return $instance;
    }


    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }


    /**
     * @return UuidInterface
     */
    public function getCustomerUuid(): UuidInterface
    {
        return $this->customerUuid;
    }


    /**
     * @return UuidInterface
     */
    public function getProductUuid(): UuidInterface
    {
        return $this->productUuid;
    }


    /**
     * @return ProductQuantity
     */
    public function getQuantity(): ProductQuantity
    {
        return $this->quantity;
    }


    /**
     * @return CartStatus
     */
    public function getStatus(): CartStatus
    {
        return $this->status;
    }


    /**
     * @return CreatedAt
     */
    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }


    /**
     * @return Product[]|ArrayCollection
     */
    public function getProduct()
    {
        return $this->product;
    }


    /**
     * @return CartAmount
     */
    public function getAmount(): CartAmount
    {
        return $this->amount;
    }


    public function setStatusInProgress(): self
    {
        $this->status = CartStatus::createInProgress();

        return $this;
    }


    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }


    /**
     * @param ProductQuantity $quantity
     * @throws Throwable
     * @return $this
     */
    public function increaseQuantity(ProductQuantity $quantity): self
    {
        $this->quantity = ProductQuantity::increase($this->quantity, $quantity);

        return $this;
    }


    /**
     * @param ProductQuantity $quantity
     * @param ProductPrice $price
     * @return $this
     */
    public function setAmount(ProductQuantity $quantity, ProductPrice $price): self
    {
        $this->amount = CartAmount::calcAmount($quantity->toInt(), $price->toFloat());

        return $this;
    }


    /**
     * @param ProductQuantity $quantity
     * @param ProductPrice $price
     * @throws Throwable
     * @return $this
     */
    public function decreaseQuantity(ProductQuantity $quantity, ProductPrice $price): self
    {
        CartSpecification::checkDecreaseQuantity($this, $quantity);

        $this->quantity = ProductQuantity::decrease($this->quantity, $quantity);

        $amount = $this->setAmount($this->quantity, $price);

        $this->amount = $amount->getAmount();

        return $this;
    }


    public function quantityIsZero(): bool
    {
        return 0 == $this->quantity->toInt();
    }


    public function removeProductFromCart()
    {
        $this->publish(new ProductFromCartWasDeleted($this));
    }


    public function updateProductFromCart()
    {
        $this->publish(new ProductFromCartWasUpdated($this));
    }


    public function buyCart()
    {
        CartSpecification::checkBuyCart($this);

        $this->status = CartStatus::createCompleted();

        $this->publish(new CartWasBuyed($this));
    }
}
