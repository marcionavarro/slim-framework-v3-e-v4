<?php

require "../bootstrap.php";

use Slim\Http\Request;
use Slim\Http\Response;


$app->group('/admin', function () use ($app) {
    $app->get('/login', function () {
        echo 'login';
    });
});

/*$app->group('/site', function () use ($app) {

    $app->get('/contato', function () {
        echo 'contato';
    });

});*/


// Só essa rota que funciona
$app->get('/', function () {
    echo 'home';
});

$app->get('/update/user/{id}', function (Request $request, Response $response, array $args) {
    dd($args);
});

$app->run();