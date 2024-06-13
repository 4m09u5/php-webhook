<?php

require_once "HookArray.php";
require_once "FileLogger.php";
require_once "Utils.php";
require_once "Webhook.php";

header("Content-Type: application/json");

Utils::logIncomingRequest(new FileLogger("logs"));

$webhook = new Webhook(HookArray::fromFile("config.json"));
echo json_encode($webhook->handleRequest(Utils::getRequestURI()));