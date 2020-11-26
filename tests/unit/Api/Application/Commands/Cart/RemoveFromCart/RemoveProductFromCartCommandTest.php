<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Cart\RemoveFromCart;

use Api\Application\Commands\Cart\RemoveFromCart\RemoveProductFromCartCommand;
use Api\Domain\ValueObj\Product\ProductQuantity;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class RemoveProductFromCartCommandTest extends TestCase
{
    /**
     * @test
     * @dataProvider dataProvider
     * @param string $customerUuid
     * @param string $productUuid
     * @param int $quantity
     */
    public function should_receive_correct_params(string $customerUuid, string $productUuid, int $quantity)
    {
        $command = new RemoveProductFromCartCommand($customerUuid, $productUuid, $quantity);

        self::assertInstanceOf(UuidInterface::class, $command->getCustomerUuid());
        self::assertInstanceOf(UuidInterface::class, $command->getProductUuid());
        self::assertInstanceOf(ProductQuantity::class, $command->getQuantity());
    }


    public function dataProvider()
    {
        return [
            [
                Uuid::uuid4()->toString(),
                Uuid::uuid4()->toString(),
                1,
            ],
        ];
    }
}
