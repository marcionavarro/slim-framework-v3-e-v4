<?php

namespace Twig;

use app\models\admin\Admin;
use app\src\Flash;

$message = new TwigFunction('message', function ($index) {
    echo Flash::get($index);
});

$admin = new TwigFunction('admin', function () {
    return (new Admin)->user();
});

return [
    $message,
    $admin
];
