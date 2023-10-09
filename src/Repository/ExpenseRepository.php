<?php

namespace Wisewallet\Repository;

use DateTime;
use PDO;
use Wisewallet\Config\Database;
use Wisewallet\Model\ExpenseModel;

class ExpenseRepository
{
    private $db;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->db = $database->getConnection();

    }

    public function getExpense(string $email)
    {
        $query = "
        SELECT expense_id, expense_name, expense_amount, expense_date, expense_note
        FROM expenses
        WHERE account_id = (
        SELECT account_id
        FROM accounts
        WHERE email = :email
        )
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $expenses = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $date = new DateTime($row['expense_date']);
            $expense = new ExpenseModel($row['expense_id'], $row['expense_name'], $row['expense_amount'], $date, $row['expense_note'], "");
            $expenses[] = $expense;
        }

        return $expenses;
    }
    public function addExpense($email, ExpenseModel $expenseModel)
    {
        $query = "UPDATE `accounts` SET `Balance`= `Balance` - :amount WHERE email = :email;
        INSERT INTO `expenses` (`account_id`, `expense_name`, `expense_amount`, `expense_date`, `expense_note`)
        VALUES ((SELECT account_id FROM accounts WHERE email = :email), :name, :amount, :date, :note);
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':name', $expenseModel->getName());
        $stmt->bindValue(':amount', intval(str_replace(',', '', $expenseModel->getAmount())));
        $stmt->bindValue(':date', $expenseModel->getDate());
        $stmt->bindValue(':note', $expenseModel->getNote());
        $added = $stmt->execute();


        if ($added) {
            $id = $this->db->lastInsertId();
            $expenseModel->setId($id);
            return $expenseModel;
        }
    }

    public function updateExpense(ExpenseModel $expenseModel)
    {
        $query = "UPDATE `accounts` SET `Balance`= `Balance` - (:amount - (SELECT expense_amount FROM expenses WHERE expense_id =:id)) WHERE account_id = (SELECT account_id FROM expenses WHERE expense_id = :id);
        UPDATE `expenses` SET `expense_name`=:name,`expense_amount`=:amount,`expense_date`=:date,`expense_note`=:note WHERE `expense_id`=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $expenseModel->getId());
        $stmt->bindValue(':name', $expenseModel->getName());
        $stmt->bindValue(':amount', intval(str_replace(',', '', $expenseModel->getAmount())));
        $stmt->bindValue(':date', $expenseModel->getDate());
        $stmt->bindValue(':note', $expenseModel->getNote());

        $updated = $stmt->execute();
        return $updated;
    }

    public function deleteExpense($id)
    {
        $query = "UPDATE `accounts` SET `Balance`= `Balance` + (SELECT expense_amount FROM expenses WHERE expense_id =:id) WHERE account_id = (SELECT account_id FROM expenses WHERE expense_id = :id);
        DELETE FROM `expenses` WHERE `expense_id` = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $removed = $stmt->execute();

        return $removed;
    }

}

?>