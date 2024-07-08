<?php

require "vendor/autoload.php";
use Slim\App;

// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
]];

$app = new App($config);
