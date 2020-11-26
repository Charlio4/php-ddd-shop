<?php

declare(strict_types=1);

namespace Api\Infrastructure\ReadModel;

use Api\Domain\Entity\Product;
use Api\Domain\ReadModel\ProductRepositoryInterface;
use Api\Domain\ReadModel\Specification\SpecificationInterface;
use Api\Infrastructure\Doctrine\Model\ReadModel;
use Doctrine\ORM\EntityManagerInterface;

final class ProductRepository extends ReadModel implements ProductRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->class = Product::class;
        parent::__construct($entityManager);
    }


    public function getOneOrNull(SpecificationInterface $specification): ?Product
    {
        $builder = $this->createOrmQueryBuilder();
        $builder
            ->select(Product::ALIAS)
            ->from($this->class, Product::ALIAS)
            ->where($specification->getConditions())
            ->setParameters($specification->getParameters());

        $query = $builder->getQuery();

        return $query->getOneOrNullResult();
    }
}
