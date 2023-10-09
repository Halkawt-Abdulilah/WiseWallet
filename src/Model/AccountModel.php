<?php

namespace Wisewallet\Model;

class AccountModel
{
    private int $id;
    private string $username;
    private string $email;
    private int $balance;
    private int $savings;

    public function __construct($id, $username, $email, $balance, $savings)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->balance = $balance;
        $this->savings = $savings;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function getSavings(): int
    {
        return $this->savings;
    }

}

?>