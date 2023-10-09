<?php

namespace Wisewallet\Repository;

use Wisewallet\Config\Database;
use Wisewallet\Model\LoginModel;
use Wisewallet\Model\SignupModel;

class AuthRepository
{
    private $db;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->db = $database->getConnection();

    }

    public function checkUsernameExistense(string $username)
    {
        $stmt = $this->db->prepare("SELECT username FROM accounts WHERE username= :username LIMIT 1");
        $stmt->bindValue(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function checkEmailExistence(string $email)
    {
        $stmt = $this->db->prepare("SELECT * FROM accounts WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $count = $stmt->rowCount();

        return $count == 1;
    }

    public function checkAccountCredentials(LoginModel $userData)
    {


        $stmt = $this->db->prepare("SELECT * FROM accounts WHERE email = :email AND password = :password");
        $stmt->bindValue(':email', $userData->getEmail());
        $stmt->bindValue(':password', $userData->getPassword());
        $stmt->execute();

        $count = $stmt->rowCount();

        return $count == 1;
    }

    public function checkAccessLevel(LoginModel $userData)
    {
        $stmt = $this->db->prepare("SELECT * FROM shadmin WHERE account_id = (SELECT account_id FROM accounts WHERE email = :email)");
        $stmt->bindValue(':email', $userData->getEmail());
        $stmt->execute();

        $count = $stmt->rowCount();

        return $count == 1;

    }

    public function createUser(SignupModel $userData)
    {
        $stmt = $this->db->prepare("INSERT INTO accounts (first_name, last_name, username, email, password) VALUES (:firstName, :lastName, :username, :email, :password)");
        $stmt->bindValue(':firstName', $userData->getFirstName());
        $stmt->bindValue(':lastName', $userData->getLastName());
        $stmt->bindValue(':username', $userData->getUsername());
        $stmt->bindValue(':email', $userData->getEmail());
        $stmt->bindValue(':password', md5($userData->getPassword()));

        $created = $stmt->execute();
        return $created;
    }
}