<?php

declare(strict_types=1);

namespace Api\Infrastructure\Subscriber;

use Api\Domain\Common\WriteModelInterface;
use Api\Domain\Events\Cart\ProductFromCartWasUpdated;
use Api\Domain\Events\Common\EventInterface;
use Api\Domain\Events\DomainEventSubscriberInterface;
use Monolog\Logger;

final class Persist implements DomainEventSubscriberInterface
{
    private WriteModelInterface $writeModel;

    private Logger $logger;


    /**
     * @param WriteModelInterface $writeModel
     * @param Logger $logger
     */
    public function __construct(WriteModelInterface $writeModel, Logger $logger)
    {
        $this->writeModel = $writeModel;
        $this->logger     = $logger;
    }


    /**
     * @param EventInterface $event
     * @param object|null $emitterObj
     */
    public function handle(EventInterface $event, $emitterObj): void
    {
        switch ($event) {
            case $event instanceof ProductFromCartWasUpdated:
                $this->writeModel->update($emitterObj);
                $this->logger->info('Entity updated');

                break;
            default:
                $this->writeModel->save($emitterObj);
                $this->logger->info('Entity saved');

                break;
        }
    }
}
