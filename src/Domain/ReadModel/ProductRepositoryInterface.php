<?php

declare(strict_types=1);

namespace Api\Domain\ReadModel;

use Api\Domain\Entity\Product;
use Api\Domain\ReadModel\Specification\SpecificationInterface;

interface ProductRepositoryInterface
{
    /**
     * @param SpecificationInterface $specification
     * @return Product|null
     */
    public function getOneOrNull(SpecificationInterface $specification): ?Product;
}
