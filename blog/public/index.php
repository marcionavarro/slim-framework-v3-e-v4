<?php

require "../bootstrap.php";

$app->get('/login', 'app\controllers\admin\LoginController:index');
$app->post('/login', 'app\controllers\admin\LoginController:store');

$app->group('/admin', function () use ($app) {
    $app->get('/painel', 'app\controllers\admin\PainelController:index');
});

$app->run();