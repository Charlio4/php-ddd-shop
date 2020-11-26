<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Model;

use Api\Domain\Common\WriteModelInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class WriteModel implements WriteModelInterface
{
    /** @var EntityManagerInterface */
    private $manager;

    /** @var LoggerInterface */
    private $logger;


    /**
     * WriteModel constructor.
     * @param EntityManagerInterface $manager
     * @param LoggerInterface $logger
     */
    public function __construct(EntityManagerInterface $manager, LoggerInterface $logger)
    {
        $this->manager = $manager;
        $this->logger  = $logger;
    }

    public function preSave($entity): void
    {
        $this->manager->persist($entity);
    }

    public function save($entity = null): void
    {
        if ($entity) {
            $this->preSave($entity);
        }

        $this->manager->flush();
        $this->logger->info('Entity saved');
    }


    public function update($entity = null): void
    {
        if ($entity) {
            $this->preSave($entity);
        }

        $this->manager->flush();
        $this->logger->info('Entity updated');
    }


    public function delete($entity): void
    {
        $this->manager->remove($entity);
        $this->manager->flush();
        $this->logger->info('Entity removed');
    }
}
