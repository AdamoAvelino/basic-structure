<?php

use App\Controllers\Home;

$app->group('/api', function() use ($app) {
    $app->group('/usuarios', function() use ($app) {

        $app->get('/', function() use($app) {
            $home = new Home();
            $home->listar($app);
        });

        $app->post('/cadastrar', function() use ($app){
            $home = new Home();
            $home->cadastrar($app);
        });

    });
});