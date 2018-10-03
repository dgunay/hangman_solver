<?php

$command = __DIR__ . '/vendor/bin/phpunit --bootstrap ' . __DIR__ . '/vendor/autoload.php test --strict-coverage --stop-on-failure';

echo passthru(str_replace('/', DIRECTORY_SEPARATOR, $command));