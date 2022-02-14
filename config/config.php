<?php

$app->setName('Ficha Técnica');

$app->configureMode('development', function() use($app) {
    $app->config([
        'debug' => true
    ]);
});

$app->configureMode('production', function() use($app) {
    $app->config([
        'debug' => false
    ]);
});
