<?php

namespace App\Controllers;


class Controller
{
    protected $app;
    
    public function __construct()
    {
        $this->app = \Slim\Slim::getInstance();
    }
}