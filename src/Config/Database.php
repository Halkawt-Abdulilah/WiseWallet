<?php

namespace Wisewallet\Config;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $db;

    private function __construct()
    {
        $host = "localhost";
        $dbname = "webspring_wisewallet";
        $user = "root";
        $pass = "";

        try {
            $this->db = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_FOUND_ROWS => true
                ]
            );
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->db;
    }
}