<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Cart\Delete;

use Api\Application\Commands\Cart\Delete\DeleteCartCommand;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class DeleteCartCommandTest extends TestCase
{
    /**
     * @test
     * @dataProvider customerProvider
     * @param string $customerUuid
     */
    public function should_receive_correct_params(string $customerUuid)
    {
        $command = new DeleteCartCommand($customerUuid);

        self::assertInstanceOf(UuidInterface::class, $command->getCustomerUuid());
    }

    public function customerProvider()
    {
        return [
            [Uuid::uuid4()->toString()],
        ];
    }
}
