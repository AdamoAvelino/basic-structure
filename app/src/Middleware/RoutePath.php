<?php

namespace App\src\Middleware;

use Slim\Middleware;

class RoutePath extends Middleware
{
    public function __construct()
    {
        
    }

    public function call()
    {
        $app = $this->app;
        $this->includeFiles('../routes', $app);
        $this->next->call();
    }

    

    private function includeFiles(String $path, $app) : void
    {
        foreach(new \DirectoryIterator($path) as $file) {
            if ($file->isDot()) {
                continue;
            }

            if($file->isDir()) {
                $this->includeFiles($file->getPathName(), $app);
            }
             
            if($file->getExtension() == 'php') {
                include $file->getPathName();
            }

        }
    }
}