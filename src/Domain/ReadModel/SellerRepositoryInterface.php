<?php

declare(strict_types=1);

namespace Api\Domain\ReadModel;

use Api\Domain\Entity\Seller;
use Api\Domain\ReadModel\Specification\SpecificationInterface;

interface SellerRepositoryInterface
{
    /**
     * @param SpecificationInterface $specification
     * @return Seller|null
     */
    public function getOneOrNull(SpecificationInterface $specification): ?Seller;
}
