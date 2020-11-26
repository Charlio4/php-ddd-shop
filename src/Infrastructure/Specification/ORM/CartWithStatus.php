<?php

declare(strict_types=1);

namespace Api\Infrastructure\Specification\ORM;

use Api\Domain\Entity\Cart;
use Api\Domain\ValueObj\Cart\CartStatus;
use Api\Infrastructure\Specification\Common\ORM\OrmSpecification;
use Doctrine\ORM\Query\Expr;

class CartWithStatus extends OrmSpecification
{
    public function __construct(Expr $expr, CartStatus $status)
    {
        $this->setParameter('cart_status', $status->toStr());

        parent::__construct($expr);
    }


    public function getConditions()
    {
        return $this->expr->eq(Cart::ALIAS . '.status', ':cart_status');
    }
}
