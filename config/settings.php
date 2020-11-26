<?php

declare(strict_types=1);

use Zend\Stdlib\ArrayUtils;

$settings = require __DIR__ . '/settings/settings_default.php';

if (file_exists(__DIR__ . '/settings/settings_dev.php')) {
    $devSettings = require __DIR__ . '/settings/settings_dev.php';
    $settings    = ArrayUtils::merge($settings, $devSettings);
}
