<?php

declare(strict_types=1);

namespace Api\Domain\ReadModel;

use Api\Domain\Entity\Cart;
use Api\Domain\ReadModel\Specification\SpecificationInterface;

interface CartRepositoryInterface
{
    /**
     * @param SpecificationInterface $specification
     * @return Cart|null
     */
    public function getOneOrNull(SpecificationInterface $specification): ?Cart;


    /**
     * @param SpecificationInterface $specification
     * @return iterable
     */
    public function findCarts(SpecificationInterface $specification): iterable;
}
