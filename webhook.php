<?php

require_once "HookArray.php";
require_once "Logger.php";

$logger = new Logger("logs");

$ip = $_SERVER['REMOTE_ADDR'];
$port = $_SERVER['REMOTE_PORT'];

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$logger->info("Request from $ip:$port - $request");

$endpoints = HookArray::fromFile("config.json");

header("Content-Type: application/json");

$response = array();

try {
    $result = $endpoints->handleRequest($request);
    $response["result"] = $result;
} catch (Exception $e) {
    http_response_code(404);
    $response["error"] = $e->getMessage();
}

$response["execution_time"] = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

echo json_encode($response);