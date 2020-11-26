<?php

declare(strict_types=1);

namespace Api\Application\Commands\Product\Create;

use Api\Application\CommandInterface;
use Api\Domain\ValueObj\Product\ProductName;
use Api\Domain\ValueObj\Product\ProductPrice;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class CreateProductCommand implements CommandInterface
{
    private UuidInterface $uuid;

    private UuidInterface $sellerUuid;

    private ProductName $name;

    private ProductPrice $price;


    /**
     * CreateProductCommand constructor.
     * @param string $sellerUuid
     * @param string $name
     * @param string $price
     * @throws \Throwable
     */
    public function __construct(string $sellerUuid, string $name, string $price)
    {
        $this->uuid       = Uuid::uuid4();
        $this->sellerUuid = Uuid::fromString($sellerUuid);
        $this->name       = ProductName::fromStr($name);
        $this->price      = ProductPrice::fromNumber((float) $price);
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
}
