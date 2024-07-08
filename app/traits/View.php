<?php

namespace app\traits;

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