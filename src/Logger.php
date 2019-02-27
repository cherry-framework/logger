<?php

namespace Cherry;

/**
 * Cherry project logger
 *
 * @package Cherry
 * @author Temuri Takalandze(ABGEO) <takalandzet@gmail.com>
 */
class Logger
{
    /**
     * @var string $logsName Log File (Use in file name)
     */
    private $logsName;

    /**
     * @var string $logsDir Logs directory
     */
    private $logsDir;

    /**
     * @var string $logType Log type
     */
    private $logType;

    public function __construct($logsName = 'app', $logsDir = __DIR__ . '/../var/log')
    {
        $this->logsName = $logsName;
        $this->logsDir = $logsDir;
    }

    /**
     * Information Log
     *
     * @param $message
     * @return Logger
     */
    public function info($message)
    {
        $this->logType = 'INFO';
        $this->writeLog($message);

        return $this;
    }

    /**
     * Warning Log
     *
     * @param $message
     * @return Logger
     */
    public function warning($message)
    {
        $this->logType = 'WARNING';
        $this->writeLog($message);

        return $this;
    }

    /**
     * Error Log
     *
     * @param $message
     * @return Logger
     */
    public function error($message)
    {
        $this->logType = 'ERROR';
        $this->writeLog($message);

        return $this;
    }

    /**
     * Write log in file
     *
     * @param $message
     * @return void
     */
    private function writeLog($message)
    {
        //Get log type
        $logType = $this->logType;

        //Set logs directory and file names
        $logName = $this->logsName;
        $logsDir = $this->logsDir;
        $logsFile = $logsDir . '/' . $logName . '.log';

        //Make logs directory if don't exists
        if (!is_dir($logsDir))
            mkdir($logsDir, 0777, true);

        //Get Backtrace
        $trace = debug_backtrace()[1];
        $traceFile = $trace['file'];
        $traceLine = $trace['line'];

        //Get current date and time
        $dateTime = date("Y-m-d H:i:s");

        //Generate message text
        $logTxt = "{$dateTime}  {$logType}: {$message} In {$traceFile} On line {$traceLine}.\n";

        //Write message in $logsFile
        $fs = fopen($logsFile, 'a') or die("Unable to open log file!");
        fwrite($fs, $logTxt);
        fclose($fs);
    }
}