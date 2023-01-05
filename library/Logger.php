<?php 

namespace library;

use Pattern\Creational\Singleton\Singleton;

class Logger extends Singleton
{
    private $fileHandle;

    protected function __construct()
    {
        $this->fileHandle = fopen('../tmp/log/log.txt', 'a+');
    }

    public function writeLog(string $message): void
    {
        $date = date('Y-m-d');
        fwrite($this->fileHandle, "$date: $message\n");
    }

    public static function log(string $message): void
    {
        $logger = static::getInstance();
        $logger->writeLog($message);
    }
}

/*
use \library\Logger;

Logger::log("Started!");

$l1 = Logger::getInstance();
$l2 = Logger::getInstance();


if ($l1 === $l2) {
    Logger::log("Logger has a single instance. " . date('H:i:s'));
} else {
    Logger::log("Loggers are different. " . date('H:i:s'));
}

Logger::log("Finished!");
*/