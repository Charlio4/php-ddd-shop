<?php

declare(strict_types=1);

namespace Api\Infrastructure\Specification\ORM;

use Api\Domain\Entity\Product;
use Api\Infrastructure\Specification\Common\ORM\OrmSpecification;
use Doctrine\ORM\Query\Expr;
use Ramsey\Uuid\UuidInterface;

class ProductWithUuid extends OrmSpecification
{
    public function __construct(Expr $expr, UuidInterface $uuid)
    {
        $this->setParameter('uuid', $uuid->toString());

        parent::__construct($expr);
    }


    public function getConditions()
    {
        return $this->expr->eq(Product::ALIAS . '.uuid', ':uuid');
    }
}
