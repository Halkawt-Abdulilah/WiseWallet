<?php

namespace Wisewallet\Repository;

use DateTime;
use PDO;
use Wisewallet\Config\Database;
use Wisewallet\Model\ExpenseModel;
use Wisewallet\Model\IncomeModel;


class DashboardRepository
{

    private $db;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->db = $database->getConnection();

    }

    public function getUsername(string $email)
    {
        $stmt = $this->db->prepare("SELECT username FROM accounts WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['username'];
    }
    public function getBalance(string $email)
    {
        $stmt = $this->db->prepare("SELECT balance FROM accounts WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['balance'];
    }
    public function getSavings(string $email)
    {
        $stmt = $this->db->prepare("SELECT savings FROM accounts WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['savings'];
    }
    public function getMonthlyIncome(string $email)
    {
        $query = "SELECT SUM(income_amount) AS total_income
        FROM incomes
        WHERE account_id = (
          SELECT account_id
          FROM accounts
          WHERE email = :email
        )
        AND YEAR(income_date) = YEAR(CURDATE())
        AND MONTH(income_date) = MONTH(CURDATE())
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $totalIncome = $stmt->fetchColumn();

        return $totalIncome;
    }
    public function getMonthlyExpense(string $email)
    {
        $query = "SELECT SUM(expense_amount) AS total_expense
        FROM expenses
        WHERE account_id = (
          SELECT account_id
          FROM accounts
          WHERE email = :email
        )
        AND YEAR(expense_date) = YEAR(CURDATE())
        AND MONTH(expense_date) = MONTH(CURDATE())
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $totalExpense = $stmt->fetchColumn();

        return $totalExpense;
    }

    public function getRecentIncome(string $email)
    {
        $query = "
        SELECT income_id, income_name, income_amount, income_date, income_note
        FROM incomes
        WHERE account_id = (
        SELECT account_id
        FROM accounts
        WHERE email = :email
        )
        ORDER BY income_date DESC
        LIMIT 5
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

    public function getRecentExpense(string $email)
    {
        $query = "
        SELECT expense_id, expense_name, expense_amount, expense_date, expense_note
        FROM expenses
        WHERE account_id = (
        SELECT account_id
        FROM accounts
        WHERE email = :email
        )
        ORDER BY expense_date DESC
        LIMIT 5
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

    public function depositSaving(int $amount, string $email)
    {
        $query = "UPDATE accounts SET savings = savings + :amount, balance = balance - :amount
                WHERE account_id = (
                SELECT account_id
                FROM accounts
                WHERE email = :email
                )";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':amount', $amount);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->rowCount() == 1;

    }
    public function withdrawSaving(int $amount, string $email)
    {
        $query = "UPDATE accounts SET savings = savings - :amount, balance = balance + :amount
                WHERE account_id = (
                SELECT account_id
                FROM accounts
                WHERE email = :email
                )";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':amount', $amount);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

}

?>