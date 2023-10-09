<?php

namespace Wisewallet\Model;

class SignupModel
{
    private string $firstName;
    private string $lastName;
    private string $username;
    private string $email;
    private string $password;
    private string $confirmPassword;

    public function __construct($firstName, $lastName, $username, $email, $password, $confirmPassword)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }
}

?>