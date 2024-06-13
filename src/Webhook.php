<?php

require_once "Utils.php";

class Webhook
{
    private HookArray $endpoints;

    public function __construct(HookArray $endpoints)
    {
        $this->endpoints = $endpoints;
    }

    public function handleRequest($request) {
        $response = array();

        try {
            $result = $this->endpoints->handleRequest($request);
            $response["result"] = $result;
        } catch (Exception $e) {
            http_response_code(404);
            $response["error"] = $e->getMessage();
        }

        $response["execution_time"] = Utils::currentExecutionTime();

        return $response;
    }
}