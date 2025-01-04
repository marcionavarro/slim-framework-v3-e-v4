<?php

namespace app\traits;

use app\src\Load;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

trait View
{
    protected $twig;

    protected function twig()
    {
        $loader = new FilesystemLoader('../app/views');

        $this->twig = new Environment($loader, [
            //'cache' => '',
            'debug' => true
        ]);
    }

    protected function functions()
    {
        $functions = Load::file('/app/functions/twig.php');

        foreach ($functions as $function) {
            $this->twig->addFunction($function);
        }
    }

    protected function load()
    {
        $this->twig();
        $this->functions();
    }

    protected function view($view, $data)
    {
        $this->load();
        $template = $this->twig->loadTemplate(str_replace('.', '/', $view) . '.html');
        return $template->display($data);
    }
}