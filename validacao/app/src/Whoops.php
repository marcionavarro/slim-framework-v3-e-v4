<?php


namespace app\src;

use Dopesong\Slim\Error\Whoops as WhoopsError;
use Whoops\Handler\PrettyPageHandler;

class Whoops extends WhoopsError
{
    public function run($app)
    {
        $this->php();
        $this->slim($app);
    }

    private function php()
    {
        $this->pushHandler(new PrettyPageHandler());
        $this->register();
    }

    private function slim($app)
    {
        $container = $app->getContainer();

        $container['phpErrorHandler'] = $container['errorHandler'] = function () {
            return $this;
        };
    }

}