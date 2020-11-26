<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Seller\Delete;

use Api\Application\Commands\Seller\Delete\DeleteSellerCommand;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class DeleteSellerCommandTest extends TestCase
{
    /**
     * @test
     * @dataProvider sellerProvider
     * @param string $uuid
     */
    public function should_receive_correct_params(string $uuid)
    {
        $command = new DeleteSellerCommand($uuid);

        self::assertInstanceOf(UuidInterface::class, $command->getUuid());
    }

    public function sellerProvider()
    {
        return [
            [Uuid::uuid4()->toString()],
        ];
    }
}
