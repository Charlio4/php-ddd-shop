<?php

declare(strict_types=1);

namespace Api\Infrastructure\Specification\ORM;

use Api\Domain\Entity\Cart;
use Api\Infrastructure\Specification\Common\ORM\OrmSpecification;
use Doctrine\ORM\Query\Expr;
use Ramsey\Uuid\UuidInterface;

class CartWithProductUuid extends OrmSpecification
{
    public function __construct(Expr $expr, UuidInterface $productUuid)
    {
        $this->setParameter('product_uuid', $productUuid->toString());

        parent::__construct($expr);
    }


    public function getConditions()
    {
        return $this->expr->eq(Cart::ALIAS . '.productUuid', ':product_uuid');
    }
}
