<?php

namespace App\src\Services;

class ConfigEnv
{
    public function __construct()
    {
        $env = \Dotenv\Dotenv::createImmutable(__DIR__.'/../../../');
        $env->load();
        
    }

    public function getEnv($name)
    {
        return $_ENV[$name];
    }
}