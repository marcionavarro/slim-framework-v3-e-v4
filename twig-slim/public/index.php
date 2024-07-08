<?php

require "../bootstrap.php";

use Slim\Http\Request;
use Slim\Http\Response;


/*$app->group('/admin', function () use ($app) {
    $app->get('/login', function () {
        echo 'login';
    });
});*/

/*$app->group('/site', function () use ($app) {

    $app->get('/contato', function () {
        echo 'contato';
    });

});*/


/*$app->get('/update/user/{id}', function (Request $request, Response $response, array $args) {
    dd($args);
});*/

$app->get('/', 'app\controllers\HomeController:index');
$app->get('/user/{id}', 'app\controllers\UserController:show');
$app->get('/contato', 'app\controllers\ContatoController:index');
$app->get('/posts', 'app\controllers\PostsController:index');
$app->post('/user/subscribe', 'app\controllers\SubscribeController:store');

$app->run();