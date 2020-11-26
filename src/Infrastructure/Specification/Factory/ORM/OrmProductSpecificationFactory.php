<?php

declare(strict_types=1);

namespace Api\Infrastructure\Specification\Factory\ORM;

use Api\Domain\ReadModel\Specification\Factory\ProductSpecificationFactoryInterface;
use Api\Domain\ReadModel\Specification\SpecificationInterface;
use Api\Infrastructure\Specification\ORM\ProductWithUuid;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr;
use Ramsey\Uuid\UuidInterface;

class OrmProductSpecificationFactory implements ProductSpecificationFactoryInterface
{
    private Expr $expr;


    /**
     * OrmProductSpecificationFactory constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->expr = $entityManager->getExpressionBuilder();
    }


    /**
     * {@inheritdoc}
     */
    public function createForFindWithUuid(UuidInterface $uuid): SpecificationInterface
    {
        return new ProductWithUuid($this->expr, $uuid);
    }
}
