<?php

//Include autoloader
require_once __DIR__ . '/../vendor/autoload.php';

use Cherry\Logger;

define('LOGS_DIR', __DIR__ . '/../var/log');
$logger = new Logger('custom-logs', LOGS_DIR);

$logger->info('Info Message');
$logger->warning('Warning Message');
$logger->error('Error Message');
$logger->debug('Debug Message');

$logger->info('Info Message 2')
    ->warning('Warning Message 2')
    ->error('Error Message 2')
    ->debug('Debug Message 2');

//Clear all logs
$logger->clear();