<?php

namespace Wisewallet\Repository;

use DateTime;
use PDO;
use Wisewallet\Config\Database;
use Wisewallet\Model\IncomeModel;

class IncomeRepository
{
    private $db;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->db = $database->getConnection();

    }

    public function getIncomes(string $email)
    {
        $query = "
        SELECT income_id, income_name, income_amount, income_date, income_note
        FROM incomes
        WHERE account_id = (
        SELECT account_id
        FROM accounts
        WHERE email = :email
        )
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $incomes = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $date = new DateTime($row['income_date']);
            $income = new IncomeModel($row['income_id'], $row['income_name'], $row['income_amount'], $date, $row['income_note'], "");
            $incomes[] = $income;
        }

        return $incomes;
    }
    public function addIncome($email, IncomeModel $incomeModel)
    {
        $query = "INSERT INTO `incomes`(`account_id`, `income_name`, `income_amount`, `income_date`, `income_note`)
        VALUES ((SELECT account_id FROM accounts WHERE email = :email), :name, :amount, :date, :note);
        UPDATE `accounts` SET `Balance`= `Balance` + :amount WHERE email = :email;
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':name', $incomeModel->getName());
        $stmt->bindValue(':amount', intval(str_replace(',', '', $incomeModel->getAmount())));
        $stmt->bindValue(':date', $incomeModel->getDate());
        $stmt->bindValue(':note', $incomeModel->getNote());
        $added = $stmt->execute();


        if ($added) {
            $id = $this->db->lastInsertId();
            $incomeModel->setId($id);
            return $incomeModel;
        }
    }

    public function updateIncome(IncomeModel $incomeModel)
    {
        $query = "UPDATE `accounts` SET `Balance`= `Balance` + (:amount - (SELECT income_amount FROM incomes WHERE income_id =:id)) WHERE account_id = (SELECT account_id FROM incomes WHERE income_id = :id);
        UPDATE `incomes` SET `income_name`=:name,`income_amount`=:amount,`income_date`=:date,`income_note`=:note WHERE `income_id`=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $incomeModel->getId());
        $stmt->bindValue(':name', $incomeModel->getName());
        $stmt->bindValue(':amount', intval(str_replace(',', '', $incomeModel->getAmount())));
        $stmt->bindValue(':date', $incomeModel->getDate());
        $stmt->bindValue(':note', $incomeModel->getNote());

        $updated = $stmt->execute();
        return $updated;
    }

    public function deleteIncome($id)
    {
        $query = "UPDATE `accounts` SET `Balance`= `Balance` - (SELECT income_amount FROM incomes WHERE income_id =:id);
        DELETE FROM `incomes` WHERE `income_id` = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $removed = $stmt->execute();

        return $removed;
    }

}

?>