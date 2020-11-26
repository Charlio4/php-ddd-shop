<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Product\Delete;

use Api\Application\Commands\Product\Delete\DeleteProductCommand;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class DeleteProductCommandTest extends TestCase
{
    /**
     * @test
     * @dataProvider productProvider
     * @param string $uuid
     */
    public function should_receive_correct_params(string $uuid)
    {
        $command = new DeleteProductCommand($uuid);

        self::assertInstanceOf(UuidInterface::class, $command->getUuid());
    }


    public function productProvider()
    {
        return [
            [Uuid::uuid4()->toString()],
        ];
    }
}
