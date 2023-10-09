<?php

namespace Wisewallet\Config;

use Exception;

class AuthView
{

    public static function render($view, $data = [])
    {
        if (file_exists(__DIR__ . '/../View/auth/' . $view . '.php')) {
            $params = [
                'title' => $view,
                'navbar' => include(__DIR__ . '/../View/layout/nav.php'),
                'mainContent' => file_get_contents(__DIR__ . '/../View/auth/' . $view . '.php'),
                'footerContent' => include(__DIR__ . '/../View/layout/Footer.php')
            ];
            extract($params);
            require(__DIR__ . '/../View/base.php');
        } else {
            throw new Exception('View not found');
        }
    }
}
?>