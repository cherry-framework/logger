<?php

//Include autoloader
require_once __DIR__ . '/../vendor/autoload.php';

use Cherry\Logger;

define('LOGS_DIR', __DIR__ . '/../var/log');
$logger = new Logger(LOGS_DIR);

$logger->info('Info Message');
$logger->warning('Warning Message');
$logger->error('Error Message');