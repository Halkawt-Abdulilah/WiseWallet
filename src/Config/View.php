<?php

namespace Wisewallet\Config;

use Exception;

class View
{

    public static function render($view, $directory, $data = [])
    {
        if (file_exists(__DIR__ . '/../View/' . $directory . '/' . $view . '.php')) {

            extract($data);

            $params = [
                'title' => $view,
                'navbar' => include(__DIR__ . '/../View/layout/nav.php'),
                'mainContent' => include(__DIR__ . '/../View/' . $directory . '/' . $view . '.php'),
                'footerContent' => include(__DIR__ . '/../View/layout/Footer.php'),
            ];
            extract($params);

            require(__DIR__ . '/../View/base.php');
        } else {
            throw new Exception('View not found');
        }
    }

}
?>