<?php

namespace Twig;

use app\src\Flash;

$message = new TwigFunction('message', function ($index) {
    echo Flash::get($index);
});

return [
    $message
];
