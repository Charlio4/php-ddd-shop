<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Cart\Add;

use Api\Application\Commands\Cart\Add\AddProductCommand;
use Api\Domain\ValueObj\Product\ProductQuantity;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class AddProductCommandTest extends TestCase
{
    /**
     * @test
     * @dataProvider productProvider
     * @param string $customerUuid
     * @param string $productUuid
     * @param int $quantity
     */
    public function should_receive_correct_params(
        string $customerUuid,
        string $productUuid,
        int $quantity
    ) {
        $command = new AddProductCommand($customerUuid, $productUuid, $quantity);

        self::assertInstanceOf(UuidInterface::class, $command->getCustomerUuid());
        self::assertInstanceOf(UuidInterface::class, $command->getProductUuid());
        self::assertInstanceOf(ProductQuantity::class, $command->getQuantity());
    }

    public function productProvider()
    {
        return [
            [
                Uuid::uuid4()->toString(),
                Uuid::uuid4()->toString(),
                4,
            ],
        ];
    }
}
