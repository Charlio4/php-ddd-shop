<?php

declare(strict_types=1);

namespace Api\Domain\Entity;

use Api\Domain\Entity\Common\EntityEvent;
use Api\Domain\ValueObj\Base\CreatedAt;
use Api\Domain\ValueObj\Customer\CustomerFirstname;
use Api\Domain\ValueObj\Customer\CustomerLastname;
use Ramsey\Uuid\UuidInterface;

class Customer extends EntityEvent
{
    private UuidInterface $uuid;

    private CustomerFirstname $firstname;

    private CustomerLastname $lastname;

    private CreatedAt $createdAt;


    public function __construct()
    {
        $this->createdAt = CreatedAt::now();
    }


    public static function create(UuidInterface $uuid, CustomerFirstname $firstname, CustomerLastname $lastname): self
    {
        $instance = new static();

        $instance->uuid      = $uuid;
        $instance->firstname = $firstname;
        $instance->lastname  = $lastname;

        return $instance;
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


    /**
     * @return CreatedAt
     */
    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }
}
