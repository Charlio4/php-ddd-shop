<?php

declare(strict_types=1);

namespace Api\Infrastructure\Specification\Factory\ORM;

use Api\Domain\ReadModel\Specification\Factory\CartSpecificationFactoryInterface;
use Api\Domain\ReadModel\Specification\SpecificationInterface;
use Api\Domain\ValueObj\Cart\CartStatus;
use Api\Infrastructure\Specification\ORM\CartWithCustomerUuid;
use Api\Infrastructure\Specification\ORM\CartWithProductUuid;
use Api\Infrastructure\Specification\ORM\CartWithStatus;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr;
use Ramsey\Uuid\UuidInterface;

class OrmCartSpecificationFactory implements CartSpecificationFactoryInterface
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
    public function createForFindWithCustomerAndProduct(
        UuidInterface $customerUuid,
        UuidInterface $productUuid
    ): SpecificationInterface {
        $withCustomerUuid = new CartWithCustomerUuid($this->expr, $customerUuid);
        $withProductUuid  = new CartWithProductUuid($this->expr, $productUuid);
        $withStatus       = new CartWithStatus($this->expr, CartStatus::createInProgress());

        return $withCustomerUuid->andX($withProductUuid)->andX($withStatus);
    }


    /**
     * {@inheritdoc}
     */
    public function createForFindWithCustomer(UuidInterface $customerUuid): SpecificationInterface
    {
        return new CartWithCustomerUuid($this->expr, $customerUuid);
    }


    /**
     * {@inheritdoc}
     */
    public function createForFindWithCustomerAndStatusInProgress(UuidInterface $customerUuid): SpecificationInterface
    {
        $withCustomerUuid = new CartWithCustomerUuid($this->expr, $customerUuid);
        $withStatus       = new CartWithStatus($this->expr, CartStatus::createInProgress());

        return $withCustomerUuid->andX($withCustomerUuid)->andX($withStatus);
    }
}
