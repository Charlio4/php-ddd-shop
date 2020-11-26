<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Product\Create;

use Api\Application\Commands\Product\Create\CreateProductCommand;
use Api\Domain\ValueObj\Product\ProductName;
use Api\Domain\ValueObj\Product\ProductPrice;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Throwable;

class CreateProductCommandTest extends TestCase
{
    /**
     * @test
     * @dataProvider productProvider
     * @param string $sellerUuid
     * @param string $name
     * @param string $price
     * @throws Throwable
     */
    public function should_receive_correct_params(
        string $sellerUuid,
        string $name,
        string $price
    ) {
        $command = new CreateProductCommand($sellerUuid, $name, $price);

        self::assertInstanceOf(UuidInterface::class, $command->getUuid());
        self::assertInstanceOf(UuidInterface::class, $command->getSellerUuid());
        self::assertInstanceOf(ProductName::class, $command->getName());
        self::assertInstanceOf(ProductPrice::class, $command->getPrice());
    }


    public function productProvider()
    {
        return [
            [
                Uuid::uuid4()->toString(),
                'Product test',
                '19.95',
            ],
        ];
    }
}
