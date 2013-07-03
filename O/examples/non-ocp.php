<?php
/**
 * Log
 * A class for logging output to a file
 */

class Log {
    /**
     * @var string
     */
    public $file;

    function __construct() {

    }

    public function putLog( $app, $content, $level="log" ) {
        $strLogEntry = "[" . date("D M j G:i:s T Y") . "] ";
        $strLogEntry .= "{$app} - {$level} - {$content}";
        return $strLogEntry;
    }

    public function logToFile( $line ) {
        file_put_contents($this->file, $line . "\n", FILE_APPEND | LOCK_EX);
    }
}

$log = new Log();
$log->file = "/home/lgoldstien/logs/ocp.log";
$line = $log->putLog( "OC1PTest", "This is a test log to see if the system works.", "info" );
$log->logToFile( $line );
