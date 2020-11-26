<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Seller\Create;

use Api\Application\Commands\Seller\Create\CreateSellerCommand;
use Api\Application\Commands\Seller\Create\CreateSellerHandler;
use PHPUnit\Framework\TestCase;

class CreateSellerHandlerTest extends TestCase
{
    /**
     * @test
     * @dataProvider sellerProvider
     * @param string $name
     */
    public function should_create_seller(string $name)
    {
        $command = new CreateSellerCommand($name);
        $handler = new CreateSellerHandler();

        $result = $handler($command);

        self::assertIsString($result);
    }

    public function sellerProvider()
    {
        return [
            ['Carlos'],
        ];
    }
}
