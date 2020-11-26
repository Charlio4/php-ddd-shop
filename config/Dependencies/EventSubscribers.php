<?php

declare(strict_types=1);

use Api\Domain\Events\DomainEventSubscriberInterface;
use Api\Infrastructure\Subscriber\Delete;
use Api\Infrastructure\Subscriber\Persist;
use Psr\Container\ContainerInterface;

$container['Persist'] = function (ContainerInterface $c): DomainEventSubscriberInterface {
    return new Persist(
        $c['WriteModel'],
        $c['logger']
    );
};

$container['Delete'] = function (ContainerInterface $c): DomainEventSubscriberInterface {
    return new Delete(
        $c['WriteModel'],
        $c['logger']
    );
};
