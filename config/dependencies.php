<?php

declare(strict_types=1);

$container = $app->getContainer();

require_once 'Dependencies/CommandBus.php';
require_once 'Dependencies/Controllers.php';
require_once 'Dependencies/Doctrine.php';
require_once 'Dependencies/Infrastructure.php';
require_once 'Dependencies/Services.php';
require_once 'Dependencies/Specifications.php';
require_once 'Dependencies/EventSubscribers.php';
require_once 'Dependencies/RabbitMQ.php';
