<?php

declare(strict_types=1);

namespace Api\Domain\Entity;

use Api\Domain\Entity\Common\EntityEvent;
use Api\Domain\Events\Seller\SellerWasCreated;
use Api\Domain\Events\Seller\SellerWasDeleted;
use Api\Domain\ValueObj\Base\CreatedAt;
use Api\Domain\ValueObj\Seller\SellerName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

class Seller extends EntityEvent
{
    const ALIAS = 'se';

    private UuidInterface $uuid;

    private SellerName $name;

    private CreatedAt $createdAt;

    /** @var Product[]|Collection */
    private $products;


    private function __construct()
    {
        $this->products  = new ArrayCollection();
        $this->createdAt = CreatedAt::now();
    }


    /**
     * @param UuidInterface $uuid
     * @param SellerName $name
     * @return Seller
     */
    public static function create(UuidInterface $uuid, SellerName $name): self
    {
        $instance = new static();

        $instance->uuid = $uuid;
        $instance->name = $name;

        return $instance;
    }


    public function addSeller()
    {
        $this->publish(new SellerWasCreated($this));
    }


    public function deleteSeller()
    {
        $this->publish(new SellerWasDeleted($this));
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


    /**
     * @return CreatedAt
     */
    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }
}
