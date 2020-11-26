<?php

declare(strict_types=1);

use Api\Infrastructure\Error\ApiError;
use Monolog\Logger;
use Nette\Database\Connection;
use Psr\Container\ContainerInterface;

$container['logger'] = function (ContainerInterface $c): Logger {
    $settings = $c->get('settings')['logger'];

    return new Logger($settings['name']);
};

$container['errorHandler'] = function (ContainerInterface $c): ApiError {
    return new ApiError(
        $c['logger'],
        $c['settings']['displayErrorDetails']
    );
};

$container['phpErrorHandler'] = function (ContainerInterface $c): ApiError {
    return $c['errorHandler'];
};

$container['redis'] = function (ContainerInterface $c): Redis {
    $conf  = $c['settings']['redis'];
    $redis = new Redis();
    $redis->connect($conf['host'], $conf['port']);

    return $redis;
};

$container['db'] = function (ContainerInterface $c): Connection {
    $settings = $c['settings']['postgres'];

    return new Connection(
        $settings['dsn'],
        $settings['username'],
        $settings['password']
    );
};
