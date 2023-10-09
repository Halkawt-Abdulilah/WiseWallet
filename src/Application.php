<?php

namespace Wisewallet;

use Wisewallet\Config\Router;

class Application
{

    private Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        $this->router->dispatch();
    }
}

?>