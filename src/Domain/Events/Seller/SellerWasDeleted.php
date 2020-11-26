<?php

declare(strict_types=1);

namespace Api\Domain\Events\Seller;

use Api\Domain\Common\Param;
use Api\Domain\Entity\Seller;
use Api\Domain\Events\Common\AbstractEvent;
use Api\Domain\ValueObj\Base\CreatedAt;
use Api\Domain\ValueObj\Seller\SellerName;
use Ramsey\Uuid\UuidInterface;

class SellerWasDeleted extends AbstractEvent
{
    private UuidInterface $uuid;

    private SellerName $name;

    private CreatedAt $createdAt;


    public function __construct(Seller $seller)
    {
        $this->uuid      = $seller->getUuid();
        $this->name      = $seller->getName();
        $this->createdAt = $seller->getCreatedAt();

        parent::__construct();
    }


    protected function index(): string
    {
        return $this->uuid->toString() . '/' . $this->name->toStr();
    }


    protected function payload(): array
    {
        return [
            Param::UUID        => $this->uuid->toString(),
            Param::SELLER_NAME => $this->name->toStr(),
            Param::CREATED_AT  => $this->createdAt->toStr(),
        ];
    }
}
