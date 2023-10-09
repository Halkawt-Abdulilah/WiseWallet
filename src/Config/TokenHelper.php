<?php

namespace Wisewallet\Config;

use FFI\Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenHelper
{
    public static function getTokenEmail()
    {
        $key = new Key("Shakey", "HS256");

        try {
            $decoded = JWT::decode($_COOKIE['jwt'], $key);
            return $decoded->email;
        } catch (Exception $e) {
            // Handle invalid tokens here
        }
    }
    public static function getTokenAccessLevel()
    {
        $key = new Key("Shakey", "HS256");

        try {
            $decoded = JWT::decode($_COOKIE['jwt'], $key);
            return $decoded->access;
        } catch (Exception $e) {
            // Handle invalid tokens here
        }

    }
}

?>