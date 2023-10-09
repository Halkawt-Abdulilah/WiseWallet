<?php

namespace Wisewallet\Controller;

class LogoutController
{
    public function logout()
    {
        setcookie('jwt', '', time() - 3600);
        header('Location: ./');
    }
}

?>