<?php

declare(strict_types=1);

namespace Api\Application\Commands\Cart\GetTotal;

use Api\Application\CommandInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class GetTotalCartCommand implements CommandInterface
{
    private UuidInterface $customerUuid;


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
