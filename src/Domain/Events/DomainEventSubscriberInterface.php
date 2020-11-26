<?php

declare(strict_types=1);

namespace Api\Domain\Events;

use Api\Domain\Events\Common\EventInterface;

interface DomainEventSubscriberInterface
{
    /**
     * @param EventInterface $event
     * @param object|null $emitterObj
     */
    public function handle(EventInterface $event, $emitterObj): void;
}
