<?php

class HookArray
{
    private $hooks = array();

    static function fromFile(string $filepath): HookArray
    {
        $content = file_get_contents($filepath);

        if ($content === false) {
            die('Failed to access configuration file.');
        }

        $rules = json_decode($content, true);

        $hookArray = new HookArray();

        foreach ($rules as $rule) {
            $hookArray->add($rule['endpoint'], $rule['action']);
        }

        return $hookArray;
    }

    public function add(string $endpoint, string $action)
    {
        $this->hooks[$endpoint] = $action;
    }

    public function handleRequest($endpoint): string
    {
        if (!isset($this->hooks[$endpoint]))
            throw new Exception("Endpoint {$endpoint} does not exist.");

        return shell_exec($this->hooks[$endpoint] . " 2>&1");
    }
}