<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Seller\Create;

use Api\Application\Commands\Seller\Create\CreateSellerCommand;
use Api\Domain\ValueObj\Seller\SellerName;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class CreateSellerCommandTest extends TestCase
{
    /**
     * @test
     * @dataProvider sellerProvider
     * @param string $name
     */
    public function should_receive_correct_params(string $name)
    {
        $command = new CreateSellerCommand($name);

        self::assertInstanceOf(UuidInterface::class, $command->getUuid());
        self::assertInstanceOf(SellerName::class, $command->getName());
    }

    public function sellerProvider()
    {
        return [
            ['Carlos'],
        ];
    }
}
