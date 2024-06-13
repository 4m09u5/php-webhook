<?php

interface Logger
{
    public function info(string $message);

    public function warn(string $message);

    public function error(string $message);
}