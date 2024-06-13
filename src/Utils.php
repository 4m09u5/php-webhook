<?php

require_once "Logger.php";

class Utils
{
    static function currentExecutionTime(): float
    {
        return microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    }

    static function getClientAddressAndPort(): array
    {
        return [$_SERVER['REMOTE_ADDR'], $_SERVER['REMOTE_PORT']];
    }

    static function getRequestURI(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    static function logIncomingRequest(Logger $logger)
    {
        $request = Utils::getRequestURI();
        [$ip, $port] = Utils::getClientAddressAndPort();

        $logger->info("Request from $ip:$port - $request");
    }

}