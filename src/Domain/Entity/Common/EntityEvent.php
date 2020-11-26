<?php

declare(strict_types=1);

namespace Api\Domain\Entity\Common;

use Api\Domain\Events\Common\EventInterface;
use Api\Domain\Events\DomainEventManagerSubscriber;

abstract class EntityEvent
{
    public function publish(EventInterface $event): void
    {
        DomainEventManagerSubscriber::instance()->publish($event, $this);
    }
}
