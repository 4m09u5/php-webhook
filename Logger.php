<?php

class Logger
{
    private $directory;

    private static function setTimestamp($message)
    {
        $access = date("Y/m/d H:i:s");
        return "$access: $message";
    }
    public function __construct($directory)
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

    private function log($level, $message)
    {
        $filepath = $this->directory.'/log_' . date('d-M-Y') . '.log';
        file_put_contents($filepath, "[$level] $message.\n", FILE_APPEND);
    }

    public function info($message)
    {
        $this->log("INFO", self::setTimestamp($message));
    }

    public function warn($message)
    {
        $this->log("WARN", self::setTimestamp($message));
    }

    public function error($message)
    {
        $this->log("ERROR", self::setTimestamp($message));
    }
}