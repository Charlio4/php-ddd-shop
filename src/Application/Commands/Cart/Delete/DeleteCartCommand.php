<?php

declare(strict_types=1);

namespace Api\Application\Commands\Cart\Delete;

use Api\Application\CommandInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class DeleteCartCommand implements CommandInterface
{
    private UuidInterface $customerUuid;


    /**
     * RemoveCartCommand constructor.
     * @param string $customerUuid
     */
    public function __construct(string $customerUuid)
    {
        $this->customerUuid = Uuid::fromString($customerUuid);
    }


    /**
     * @return UuidInterface
     */
    public function getCustomerUuid(): UuidInterface
    {
        return $this->customerUuid;
    }
}
