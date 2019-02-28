<?php

use Cherry\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    /** @var string */
    private $logger;

    /** @var string  */
    private $logsName = 'UnitTesting';

    /** @var string  */
    private $logsDir = __DIR__ . '/logs';

    /**
     * Setup default settings for all tests
     *
     * @return void
     */
    public function setUp(): void
    {
        //Create new Cherry\Logger instance
        $this->logger = new Logger($this->logsName, $this->logsDir);
    }

    /**
     * Test if log file was created in logs directory
     *
     * @return void
     */
    public function testIfLogFileCreated()
    {
        /** @var Logger $logger */
        $logger = $this->logger;
        $logger->info('created');

        $this->assertFileExists($this->logsDir . '/' . $this->logsName . '.log');

        $logger->clear();
    }

    /**
     * Test the logs directory and log file permissions;
     *
     * @return void
     */
    public function testLogDirectoryAndFilePermissions()
    {
        /** @var Logger $logger */
        $logger = $this->logger;
        $logger->info('created');

        $logsDirectory = $this->logsDir;
        $logFile = $logsDirectory . '/' . $this->logsName . '.log';

        $dirPerms = (int)substr(decoct(fileperms($logsDirectory)), -3);
        $filePerms = (int)substr(decoct(fileperms($logFile)), -3);

        $this->assertEquals(755, $dirPerms);
        $this->assertEquals(644, $filePerms);

        $logger->clear();
    }

    /**
     * Test created logs type
     *
     * @return void
     */
    public function testLoggerType()
    {
        /** @var Logger $logger */
        $logger = $this->logger;

        $logTypes = array(
            'info' => 'INFO',
            'warning' => 'WARNING',
            'error' => 'ERROR',
            'debug' => 'DEBUG'
        );

        foreach ($logTypes as $k => $v) {
            $logger->{$k}('created');

            $log = @file_get_contents($this->logsDir . '/' . $this->logsName . '.log');

            $start = strpos($log, ']') + 3;
            $end = strpos($log, ':', $start);
            $logType = substr($log, $start, $end - $start);

            $this->assertEquals($v, $logType);

            $logger->clear();
        }
    }

    /**
     * Test Log creating date and time
     *
     * @return void
     */
    public function testLogDateTime()
    {
        /** @var Logger $logger */
        $logger = $this->logger;
        $logger->info('created');

        $dateTimeNow = date("Y-m-d H:i");

        $log = @file_get_contents($this->logsDir . '/' . $this->logsName . '.log');
        $start = strpos($log, '[') + 1;
        $end = strpos($log, ']');

        $logDateTime = substr($log, $start, $end - $start - 3);

        $this->assertEquals($dateTimeNow, $logDateTime);

        $logger->clear();
    }

    /**
     * Test logger call backtrace line
     *
     * @return void
     */
    public function testBacktraceLine()
    {
        /** @var Logger $logger */
        $logger = $this->logger;
        $logger->info('created');

        $log = @file_get_contents($this->logsDir . '/' . $this->logsName . '.log');
        $start = strpos($log, 'line') + 5;
        $end = strpos($log, '.', $start);

        $line = (int)substr($log, $start, $end - $start);

        $this->assertEquals(132, $line);

        $logger->clear();
    }

    /**
     * Test logs count
     *
     * @return void
     */
    public function testCountMethod()
    {
        /** @var Logger $logger */
        $logger = $this->logger;
        $logger->info('created');
        $logger->debug('created');
        $logger->warning('created');

        $this->assertEquals(3, $logger->count());

        $logger->error('created');
        $logger->info('created');

        $this->assertEquals(5, $logger->count());

        $logger->error('created');
        $logger->info('created');
        $logger->debug('created');
        $logger->info('created');
        $logger->warning('created');
        $logger->info('created');

        $this->assertEquals(11, $logger->count());

        $logger->clear();
    }
}
