<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Model;

use Doctrine\DBAL\Query\QueryBuilder as PdoQueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder as OrmQueryBuilder;

abstract class ReadModel
{
    /** @var string */
    protected $class;

    /** @var EntityManagerInterface */
    protected $entityManager;


    /**
     * ReadModel constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityManager->getRepository($this->class);
    }


    /**
     * @return OrmQueryBuilder
     */
    protected function createOrmQueryBuilder(): OrmQueryBuilder
    {
        return $this->entityManager->createQueryBuilder();
    }


    /**
     * @return PdoQueryBuilder
     */
    protected function createDbalQueryBuilder(): PdoQueryBuilder
    {
        return $this->entityManager->getConnection()->createQueryBuilder();
    }
}
