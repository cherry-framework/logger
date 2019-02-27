# cherry-logger
The Cherry-project logger

[![GitHub license](https://img.shields.io/github/license/abgeo07/cherry-logger.svg)](https://github.com/ABGEO07/cherry-logger/blob/master/LICENSE)

[![GitHub release](https://img.shields.io/github/release/abgeo07/cherry-logger.svg)](https://github.com/ABGEO07/cherry-logger/releases)

------------

## Including
**Install from composer** `composer require cherry-project/logger`

**Include Autoloader in your main file** (Ex.: index.php)
```php
require_once __DIR__ . '/vendor/autoload.php';
```
**Import class**
```php
use Cherry\Logger;
```
**Set logs directory**
```php
define('LOGS_DIR', __DIR__ . '/var/log');
```
**Crete class new object** 

Logger class takes two arguments:
- Log Name, the logs filename **{LogName}.log** (Default **'app'**).
- Logs Directory(Default **'/var/log'**).
```php
$logger = new Logger('app-logs', LOGS_DIR);
```

## Logger methods
The logger has 4 Log types:
- **info()**;
- **warning()**;
- **error()**;
- **debug()** 

and additional methods:
 - **clear()** clear logs in current instance;
 - **count()** get logs count in current instance;

### Call methods
```php
$logger->info('Info Message');
$logger->warning('Warning Message');
$logger->error('Error Message');
$logger->debug('Debug Message');
```

Also you can call more then one method from one object:
```php
$logger->info('Info Message 2')
    ->warning('Warning Message 2')
    ->error('Error Message 2')
    ->debug('Debug Message 2');
```

You can clear all the logs in the current instance using the **clear()* method:
```php
$logger->clear();
```

If you need logs count in current instance, you might use **count()** method:
```php
echo $logger->count();
```

**2019 &copy; Temuri Takalandze <takalandzet@gmail.com>**
