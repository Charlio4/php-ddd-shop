<?php

declare(strict_types=1);

namespace Api\Application\Commands\Cart\Buy;

use Api\Application\CommandInterface;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class BuyCartCommand implements CommandInterface
{
    private UuidInterface $customerUuid;


    /**
     * BuyCartCommand constructor.
     * @param $customerUuid
     * @throws Exception
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
