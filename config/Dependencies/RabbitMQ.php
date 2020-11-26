<?php

declare(strict_types=1);

use Api\Domain\Events\Bus\ConsumerMessageInterface;
use Api\Domain\Events\Bus\PublisherMessageInterface;
use Api\Infrastructure\RabbitMQ\BasicConsumer;
use Api\Infrastructure\RabbitMQ\BasicPublisher;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Psr\Container\ContainerInterface;

$container['AMQConnection'] = function (ContainerInterface $c) {
    $conf = $c['settings']['rabbitMQ'];

    return new AMQPStreamConnection(
        $conf['host'],
        $conf['port'],
        $conf['user'],
        $conf['password']
    );
};

// Create customer
$container['ReadyToCreateCustomer'] = function (ContainerInterface $c): PublisherMessageInterface {
    $conf = $c['settings']['rabbitMQ']['queues'];

    return new BasicPublisher(
        $c['AMQConnection'],
        $conf['create-customer']
    );
};

$container['ReadyToConsumeCreateCustomer'] = function (ContainerInterface $c): ConsumerMessageInterface {
    $conf = $c['settings']['rabbitMQ']['queues'];

    return new BasicConsumer(
        $c['AMQConnection'],
        $conf['create-customer']
    );
};
