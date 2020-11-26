<?php

declare(strict_types=1);

namespace Api\Infrastructure\ReadModel;

use Api\Domain\Entity\Cart;
use Api\Domain\ReadModel\CartRepositoryInterface;
use Api\Domain\ReadModel\Specification\SpecificationInterface;
use Api\Infrastructure\Doctrine\Model\ReadModel;
use Doctrine\ORM\EntityManagerInterface;

final class CartRepository extends ReadModel implements CartRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->class = Cart::class;
        parent::__construct($entityManager);
    }


    public function getOneOrNull(SpecificationInterface $specification): ?Cart
    {
        $builder = $this->createOrmQueryBuilder();
        $builder
            ->select(Cart::ALIAS)
            ->from($this->class, Cart::ALIAS)
            ->where($specification->getConditions())
            ->setParameters($specification->getParameters());

        $query = $builder->getQuery();

        return $query->getOneOrNullResult();
    }


    /**
     * {@inheritdoc}
     */
    public function findCarts(SpecificationInterface $specification): iterable
    {
        $builder = $this->createOrmQueryBuilder();
        $builder
            ->select(Cart::ALIAS)
            ->from($this->class, Cart::ALIAS)
            ->where($specification->getConditions())
            ->setParameters($specification->getParameters());

        $query = $builder->getQuery();

        return $query->getResult();
    }
}
