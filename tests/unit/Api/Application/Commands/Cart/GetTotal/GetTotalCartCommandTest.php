<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Cart\GetTotal;

use Api\Application\Commands\Cart\GetTotal\GetTotalCartCommand;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class GetTotalCartCommandTest extends TestCase
{
    /**
     * @test
     * @dataProvider customerProvider
     * @param string $customerUuid
     */
    public function should_receive_correct_params(string $customerUuid)
    {
        $command = new GetTotalCartCommand($customerUuid);

        self::assertInstanceOf(UuidInterface::class, $command->getCustomerUuid());
    }


    public function customerProvider()
    {
        return [
            [Uuid::uuid4()->toString()],
        ];
    }
}
