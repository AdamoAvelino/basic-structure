<?php
include '../vendor/autoload.php';
include '../app/helpers/helpers.php';

$app = new Slim\Slim([
    'mode' => 'development',
    'view' => new App\src\Services\View()
]);

$app->add(new App\src\Middleware\RoutePath());

include '../config/config.php';

$app->run();