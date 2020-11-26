<?php

declare(strict_types=1);

namespace Api\Application\Commands\Customer;

use Api\Application\CommandInterface;
use Api\Domain\ValueObj\Customer\CustomerFirstname;
use Api\Domain\ValueObj\Customer\CustomerLastname;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class CreateCustomerCommand implements CommandInterface
{
    private UuidInterface $uuid;

    private CustomerFirstname $firstname;

    private CustomerLastname $lastname;


    public function __construct(string $firstname, string $lastname)
    {
        $this->uuid      = Uuid::uuid4();
        $this->firstname = CustomerFirstname::fromStr($firstname);
        $this->lastname  = CustomerLastname::fromStr($lastname);
    }


    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }


    /**
     * @return CustomerFirstname
     */
    public function getFirstname(): CustomerFirstname
    {
        return $this->firstname;
    }


    /**
     * @return CustomerLastname
     */
    public function getLastname(): CustomerLastname
    {
        return $this->lastname;
    }
}
