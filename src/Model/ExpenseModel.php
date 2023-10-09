<?php

namespace Wisewallet\Model;

use DateTime;

class ExpenseModel
{
    private int $id;
    private string $name;
    private string $amount;
    private DateTime $date;
    private string $note;
    private string $owner;

    public function __construct(int $id, string $name, string $amount, DateTime $date, string $note, string $owner)
    {
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
        $this->date = $date;
        $this->note = $note;
        $this->owner = $owner;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): string
    {
        return number_format($this->amount);
    }

    public function getnote(): string
    {
        return $this->note;
    }
    public function getOwner(): string
    {
        return $this->owner;
    }

    public function getDate(): string
    {
        return $this->date->format('Y-m-d H:i:s');
    }
}


?>