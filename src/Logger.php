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
     * @var string $logsDir Logs directory
     */
    private $logsDir = __DIR__ . '/../var/log';
    /**
     * @var string $logType Log type
     */
    private $logType;
    public function __construct($logsDir = null)
    {
        if ($logsDir != null)
            $this->logsDir = $logsDir;
    }
    /**
     * Information Log
     *
     * @param $message
     * @return void
     */
    public function info($message)
    {
        $this->logType = 'INFO';
        $this->writeLog($message);
    }
    /**
     * Warning Log
     *
     * @param $message
     * @return void
     */
    public function warning($message)
    {
        $this->logType = 'WARNING';
        $this->writeLog($message);
    }
    /**
     * Error Log
     *
     * @param $message
     * @return void
     */
    public function error($message)
    {
        $this->logType = 'ERROR';
        $this->writeLog($message);
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
        $logsDir = $this->logsDir;
        $logsFile = $logsDir . '/app.log';
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