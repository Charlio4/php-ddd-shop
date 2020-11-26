<?php

declare(strict_types=1);

namespace Api\Application\Commands\Cart\Add;

use Api\Application\CommandInterface;
use Api\Domain\ValueObj\Product\ProductQuantity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class AddProductCommand implements CommandInterface
{
    private UuidInterface $customerUuid;

    private UuidInterface $productUuid;

    private ProductQuantity $quantity;


    public function __construct(string $customerUuid, string $productUuid, int $quantity)
    {
        $this->customerUuid = Uuid::fromString($customerUuid);
        $this->productUuid  = Uuid::fromString($productUuid);
        $this->quantity     = ProductQuantity::fromInt($quantity);
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
}
