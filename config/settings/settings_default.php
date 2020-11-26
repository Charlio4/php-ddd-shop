<?php

declare(strict_types=1);

use Monolog\Logger;

return [
    'settings' => [
        'app_env'                           => 'prod',
        'displayErrorDetails'               => false, // set to false in production
        'addContentLengthHeader'            => false, // Allow the web server to send the content-length header
        'determineRouteBeforeAppMiddleware' => true,

        'logger' => [
            'name'  => 'shopapi',
            'path'  => 'php://stdout',
            'level' => Logger::INFO,
        ],

        'redis' => [
            'host' => 'local_redis',
            'port' => 6379,
        ],

        'doctrine' => [
            'dev_mode'     => false,
            'cache_dir'    => __DIR__ . '/../../var/cache/doctrine/orm',
            'metadata_dir' => __DIR__ . '/../mapping/orm',
            'proxy_dir'    => __DIR__ . '/../../var/cache/doctrine/proxy',
            'connection'   => [
                'shopapi'    => [
                    'driver'  => 'pdo_pgsql',
                    'url'     => 'postgres://root:root@local_postgres:5432/shop',
                    'charset' => 'utf8',
                ],
            ],
        ],

        'postgres' => [
            'dsn'      => 'pgsql:host=local_postgres;port=5432;dbname=shop',
            'username' => 'root',
            'password' => 'root',
        ],

        'rabbitMQ' => [
            'host'     => $_ENV['RABBIT_HOST'],
            'port'     => $_ENV['RABBIT_PORT'],
            'user'     => $_ENV['RABBIT_USER'],
            'password' => $_ENV['RABBIT_PASSWORD'],
            'queues'   => [
                'create-customer' => 'create-customer',
            ],
        ],
    ],
];
