<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Customer;

use Api\Application\Commands\Customer\CreateCustomerCommand;
use Api\Domain\ValueObj\Customer\CustomerFirstname;
use Api\Domain\ValueObj\Customer\CustomerLastname;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class CreateCustomerCommandTest extends TestCase
{
    /**
     * @test
     * @dataProvider customerProvider
     * @param string $firstname
     * @param string $lastname
     */
    public function should_receive_correct_params(string $firstname, string $lastname)
    {
        $command = new CreateCustomerCommand($firstname, $lastname);

        self::assertInstanceOf(UuidInterface::class, $command->getUuid());
        self::assertInstanceOf(CustomerFirstname::class, $command->getFirstname());
        self::assertInstanceOf(CustomerLastname::class, $command->getLastname());
    }


    public function customerProvider()
    {
        return [
            ['Carlos', 'Suárez'],
        ];
    }
}
