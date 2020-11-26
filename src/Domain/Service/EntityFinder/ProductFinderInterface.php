<?php

declare(strict_types=1);

namespace Api\Domain\Service\EntityFinder;

use Api\Domain\Entity\Product;
use Ramsey\Uuid\UuidInterface;

interface ProductFinderInterface
{
    /**
     * @param UuidInterface $uuid
     * @return Product|null
     */
    public function getProductByUuid(UuidInterface $uuid): ?Product;
}
