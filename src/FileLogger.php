<?php

require_once "Logger.php";

class FileLogger implements Logger
{
    private $directory;

    private static function setTimestamp(string $message): string
    {
        $access = date("Y/m/d H:i:s");
        return "$access: $message";
    }
    public function __construct(string $directory)
    {
        $this->directory = $directory;

        if (!file_exists($this->directory))
        {
            mkdir($this->directory, 0777, true);
        }
    }

    public function __destruct()
    {
        closelog();
    }

    private function log(string $level, string $message)
    {
        $filepath = $this->directory.'/log_' . date('d-M-Y') . '.log';
        file_put_contents($filepath, "[$level] $message.\n", FILE_APPEND);
    }

    public function info(string $message)
    {
        $this->log("INFO", self::setTimestamp($message));
    }

    public function warn(string $message)
    {
        $this->log("WARN", self::setTimestamp($message));
    }

    public function error(string $message)
    {
        $this->log("ERROR", self::setTimestamp($message));
    }
}