<?php

declare(strict_types=1);

namespace Api\Domain\Events\Product;

use Api\Domain\Common\Param;
use Api\Domain\Entity\Product;
use Api\Domain\Events\Common\AbstractEvent;
use Api\Domain\ValueObj\Base\CreatedAt;
use Api\Domain\ValueObj\Product\ProductName;
use Api\Domain\ValueObj\Product\ProductPrice;
use Ramsey\Uuid\UuidInterface;

final class ProductWasCreated extends AbstractEvent
{
    private UuidInterface $uuid;

    private UuidInterface $sellerUuid;

    private ProductName $name;

    private ProductPrice $price;

    private CreatedAt $createdAt;


    public function __construct(Product $product)
    {
        $this->uuid       = $product->getUuid();
        $this->sellerUuid = $product->getSellerUuid();
        $this->name       = $product->getName();
        $this->price      = $product->getPrice();
        $this->createdAt  = $product->getCreatedAt();

        parent::__construct();
    }


    protected function index(): string
    {
        return $this->uuid->toString() . '/' . $this->name->toStr();
    }


    protected function payload(): array
    {
        return [
            Param::UUID                => $this->uuid->toString(),
            Param::PRODUCT_SELLER_UUID => $this->name->toStr(),
            Param::PRODUCT_NAME        => $this->name->toStr(),
            Param::PRODUCT_PRICE       => $this->price->toFloat(),
            Param::CREATED_AT          => $this->createdAt->toStr(),
        ];
    }
}
