<?php

declare(strict_types=1);

namespace Api\Infrastructure\ReadModel;

use Api\Domain\Entity\Seller;
use Api\Domain\ReadModel\SellerRepositoryInterface;
use Api\Domain\ReadModel\Specification\SpecificationInterface;
use Api\Infrastructure\Doctrine\Model\ReadModel;
use Doctrine\ORM\EntityManagerInterface;

final class SellerRepository extends ReadModel implements SellerRepositoryInterface
{
    /**
     * SellerRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->class = Seller::class;
        parent::__construct($entityManager);
    }


    /**
     * {@inheritdoc}
     */
    public function getOneOrNull(SpecificationInterface $specification): ?Seller
    {
        $builder = $this->createOrmQueryBuilder();
        $builder
            ->select(Seller::ALIAS)
            ->from($this->class, Seller::ALIAS)
            ->where($specification->getConditions())
            ->setParameters($specification->getParameters());

        $query = $builder->getQuery();

        return $query->getOneOrNullResult();
    }
}
