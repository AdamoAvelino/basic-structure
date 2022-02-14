<?php

function env($name)
{
    $env = new \App\src\Services\ConfigEnv;
    return $env->getEnv($name);
}

function dd($debug)
{
    var_dump($debug);
    die();
}