<?php

declare(strict_types=1);

namespace Api\Domain\Service\EntityFinder;

use Api\Domain\Entity\Seller;
use Ramsey\Uuid\UuidInterface;

interface SellerFinderInterface
{
    /**
     * @param UuidInterface $uuid
     * @return Seller|null
     */
    public function getSellerByUuid(UuidInterface $uuid): ?Seller;
}
