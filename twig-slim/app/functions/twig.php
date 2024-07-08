<?php

namespace Twig;

$file_exists = new TwigFunction('file_exists', function($file) {
    return file_exists($file);
});

$teste = new TwigFunction('teste', function() {
    echo 'teste';
});

return [
    $file_exists,
    $teste
];
