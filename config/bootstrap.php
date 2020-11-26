<?php

declare(strict_types=1);

use Slim\App;
use Slim\Http\StatusCode;
use Symfony\Component\Dotenv\Dotenv;

setlocale(LC_TIME, 'es_ES.utf8');

require __DIR__ . '/../vendor/autoload.php';

set_error_handler(function ($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting, so ignore it
        return;
    }

    throw new ErrorException($message, StatusCode::HTTP_INTERNAL_SERVER_ERROR, $severity, $file, $line);
});

(new Dotenv(true))->loadEnv(dirname(__DIR__) . '/.env');

require_once __DIR__ . '/settings.php';

$app = new App($settings);

require __DIR__ . '/dependencies.php';
require __DIR__ . '/domainEventManager.php';
require __DIR__ . '/routes.php';

return $app;
