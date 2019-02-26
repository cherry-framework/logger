# cherry-logger
The Cherry-project logger

[![GitHub license](https://img.shields.io/github/license/abgeo07/cherry-logger.svg)](https://github.com/ABGEO07/cherry-logger/blob/master/LICENSE)

[![GitHub release](https://img.shields.io/github/release/abgeo07/cherry-logger.svg)](https://github.com/ABGEO07/cherry-logger/releases)

------------

## Including
Install from composer `composer require cherry-project/logger`

Include Autoloader in your main file (Ex.: index.php)
```php
require_once __DIR__ . '/vendor/autoload.php';
```
Import class
```php
use Cherry\Logger;
```
Set logs directory
```php
define('LOGS_DIR', __DIR__ . '/var/log');
```
Crete class new object
```php
$logger = new Logger(LOGS_DIR);
```

## Logger methods
The logger has 3 methods (Log types): info, warning, error;

### Call methods
```php
$logger->info('Info Message');
$logger->warning('Warning Message');
$logger->error('Error Message');
```

**2019 &copy; Temuri Takalandze <takalandzet@gmail.com>**
