<?php

declare(strict_types=1);

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Slim\App;

/** @var App $app */
$app = require __DIR__ . '/bootstrap.php';

$entityManager = $app->getContainer()->get('EntityManager');

return ConsoleRunner::createHelperSet($entityManager);
