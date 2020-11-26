<?php

declare(strict_types=1);

namespace Api\Domain\ReadModel\Specification\Factory;

use Api\Domain\ReadModel\Specification\SpecificationInterface;
use Ramsey\Uuid\UuidInterface;

interface SellerSpecificationFactoryInterface
{
    /**
     * @param UuidInterface $uuid
     * @return SpecificationInterface
     */
    public function createForFindWithUuid(UuidInterface $uuid): SpecificationInterface;
}
