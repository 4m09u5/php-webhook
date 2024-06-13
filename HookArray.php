<?php

class HookArray
{
    private $hooks = array();

    static function fromFile($filepath)
    {
        $content = file_get_contents($filepath);

        if ($content === false) {
            die('Failed to access sconfiguration file.');
        }

        $rules = json_decode($content, true);

        $hookArray = new HookArray();

        foreach ($rules as $rule) {
            $hookArray->add($rule['endpoint'], $rule['action']);
        }

        return $hookArray;
    }

    public function add($endpoint, $action)
    {
        $this->hooks[$endpoint] = $action;
    }

    public function handleRequest($endpoint)
    {
        if (!isset($this->hooks[$endpoint]))
            throw new Exception("Endpoint {$endpoint} does not exist.");

        return shell_exec($this->hooks[$endpoint] . " 2>&1");
    }
}