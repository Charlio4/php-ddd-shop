<?php

declare(strict_types=1);

namespace Api\Application\Commands\Seller\Delete;

use Api\Application\CommandInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class DeleteSellerCommand implements CommandInterface
{
    private UuidInterface $uuid;


    public function __construct(string $uuid)
    {
        $this->uuid = Uuid::fromString($uuid);
    }

    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }
}
