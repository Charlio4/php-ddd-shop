<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Cart\Buy;

use Api\Application\Commands\Cart\Buy\BuyCartCommand;
use Exception;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class BuyCartCommandTest extends TestCase
{
    /**
     * @test
     * @dataProvider cartProvider
     * @param string $customerUuid
     * @throws Exception
     */
    public function should_receive_correct_params(string $customerUuid)
    {
        $command = new BuyCartCommand($customerUuid);

        self::assertInstanceOf(UuidInterface::class, $command->getCustomerUuid());
    }

    public function cartProvider()
    {
        return [
            [Uuid::uuid4()->toString()],
        ];
    }
}
