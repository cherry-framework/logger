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
}
