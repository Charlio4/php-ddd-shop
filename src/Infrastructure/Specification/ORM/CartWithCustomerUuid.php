<?php

declare(strict_types=1);

namespace Api\Infrastructure\Specification\ORM;

use Api\Domain\Entity\Cart;
use Api\Infrastructure\Specification\Common\ORM\OrmSpecification;
use Doctrine\ORM\Query\Expr;
use Ramsey\Uuid\UuidInterface;

class CartWithCustomerUuid extends OrmSpecification
{
    public function __construct(Expr $expr, UuidInterface $customerUuid)
    {
        $this->setParameter('customer_uuid', $customerUuid->toString());

        parent::__construct($expr);
    }


    public function getConditions()
    {
        return $this->expr->eq(Cart::ALIAS . '.customerUuid', ':customer_uuid');
    }
}
