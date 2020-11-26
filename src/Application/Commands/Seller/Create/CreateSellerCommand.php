<?php

declare(strict_types=1);

namespace Api\Application\Commands\Seller\Create;

use Api\Application\CommandInterface;
use Api\Domain\ValueObj\Seller\SellerName;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class CreateSellerCommand implements CommandInterface
{
    /** @var SellerName */
    private $name;

    /** @var UuidInterface */
    private $uuid;


    public function __construct(string $name)
    {
        $this->uuid = Uuid::uuid4();
        $this->name = SellerName::fromStr($name);
    }


    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }


    /**
     * @return SellerName
     */
    public function getName(): SellerName
    {
        return $this->name;
    }
}
