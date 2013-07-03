<?php
/**
 * Log
 * A class for logging output to a file
 */

class Log {

    public $app;
    public $content;
    public $level;
    public $timestamp;

    function __construct( $app, $content, $level="log", $timestamp="D M j G:i:s T Y" ) {
        $this->app = $app;
        $this->content = $content;
        $this->level = $level;
        $this->timestamp = $timestamp;
    }

    public function putLog() {
        $strLogEntry = "[" . date($this->timestamp) . "] ";
        $strLogEntry .= "{$this->app} - {$this->level} - {$this->content}";
        return $strLogEntry;
    }

}

class LogToFile extends Log {

    public $file;
    
    function __construct( $file, $app, $content, $level="log", $timestamp="D M j G:i:s T Y") {
        $this->file = $file;
        $this->app = $app;
        $this->content = $content;
        $this->level = $level;
        $this->timestamp = $timestamp;
        $this->logToFile();
    }

    public function logToFile() {
        $line = $this->putLog();
        file_put_contents($this->file, $line . "\n", FILE_APPEND | LOCK_EX);
    }
}

class LogToSyslog extends Log {

    public $log;
    
    function __construct( $log, $app, $content, $level=LOG_INFO, $timestamp="D M j G:i:s T Y") {
        $this->log = $log;
        $this->app = $app;
        $this->content = $content;
        $this->level = $level;
        $this->timestamp = $timestamp;
        openlog($this->log, LOG_PID | LOG_PERROR, LOG_LOCAL0);
        $this->logToSyslog();
        closelog();
    }

    public function logToSyslog() {
        $line = $this->putLog();
        syslog($this->level, $line);
    }
}

$log = new LogToFile("/home/lgoldstien/logs/ocp.log", "OCPTest", "This is a test log to see if the system works.", "info");
$log = new LogToSyslog("OCPTestLog", "OCPTest", "This is a test log to see if the system works.", LOG_INFO);
