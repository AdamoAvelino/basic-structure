<?php

use App\Controllers\Home;

$authi = function ($nome) {
    return function() use($nome) {
        if($nome != 'Adamo') {
            $app = \Slim\Slim::getInstance();
            $app->redirect('/');
        }
    };
};

$app->get('/', $authi,  function() {
    $home = new Home();
    $home->index();
});

