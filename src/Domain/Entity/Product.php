<?php

declare(strict_types=1);

namespace Api\Domain\Entity;

use Api\Domain\Entity\Common\EntityEvent;
use Api\Domain\Events\Product\ProductWasCreated;
use Api\Domain\Events\Product\ProductWasDeleted;
use Api\Domain\ValueObj\Base\CreatedAt;
use Api\Domain\ValueObj\Product\ProductName;
use Api\Domain\ValueObj\Product\ProductPrice;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class Product extends EntityEvent
{
    const ALIAS = 'pr';

    private UuidInterface $uuid;

    private UuidInterface $sellerUuid;

    private ProductName $name;

    private ProductPrice $price;

    private CreatedAt $createdAt;

    /** @var Seller[]|ArrayCollection */
    private $seller;

    private function __construct()
    {
        $this->createdAt = CreatedAt::now();
        $this->seller    = new ArrayCollection();
    }


    public static function create(
        UuidInterface $uuid,
        UuidInterface $sellerUuid,
        ProductName $name,
        ProductPrice $price,
        Seller $seller
    ): self {
        $instance = new static();

        $instance->uuid       = $uuid;
        $instance->sellerUuid = $sellerUuid;
        $instance->name       = $name;
        $instance->price      = $price;

        $instance->setSeller($seller);

        return $instance;
    }


    public function createProduct()
    {
        $this->publish(new ProductWasCreated($this));
    }


    public function deleteProduct()
    {
        $this->publish(new ProductWasDeleted($this));
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
    public function getSellerUuid(): UuidInterface
    {
        return $this->sellerUuid;
    }


    /**
     * @return ProductName
     */
    public function getName(): ProductName
    {
        return $this->name;
    }


    /**
     * @return ProductPrice
     */
    public function getPrice(): ProductPrice
    {
        return $this->price;
    }


    /**
     * @return CreatedAt
     */
    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }


    /**
     * @return Seller[]|ArrayCollection
     */
    public function getSeller()
    {
        return $this->seller;
    }


    private function setSeller(Seller $seller): self
    {
        $this->seller = $seller;

        return $this;
    }

    public function setPrice(self $product): self
    {
        $this->price = ProductPrice::fromNumber(10);

        return $this;
    }
}
