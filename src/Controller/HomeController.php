<?php

namespace Wisewallet\Controller;

use Wisewallet\Config\TokenHelper;
use Wisewallet\Config\View;
use Wisewallet\Repository\AuthRepository;

class HomeController
{
    public function entry()
    {
        $authRepo = new AuthRepository();
        if (isset($_COOKIE['jwt'])) {
            if ($authRepo->checkEmailExistence(TokenHelper::getTokenEmail()) && TokenHelper::getTokenAccessLevel() == "Shadmin") {
                header('location: accounts');
            } else {
                header('location: dashboard');
            }
        } else {
            $this->display("login", "Auth");
        }
    }
    public static function display($view, $directory, $data = [])
    {
        View::render($view, $directory, $data);
    }
}

?>