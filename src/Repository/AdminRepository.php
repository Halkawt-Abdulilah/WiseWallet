<?php

namespace Wisewallet\Repository;

use DateTime;
use PDO;
use Wisewallet\Config\Database;
use Wisewallet\Model\AccountModel;
use Wisewallet\Model\ExpenseModel;
use Wisewallet\Model\IncomeModel;


class AdminRepository
{

    private $db;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->db = $database->getConnection();

    }

    public function getAccounts()
    {
        $query = "SELECT * FROM accounts";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $accounts = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $account = new AccountModel($row['account_id'], $row['username'], $row['email'], $row['Balance'], $row['Savings']);
            $accounts[] = $account;
        }
        return $accounts;
    }
    public function getIncomes()
    {
        $query = "SELECT *, (SELECT username FROM accounts WHERE account_id = incomes.account_id) AS username FROM incomes";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $incomes = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $dateString = $row['income_date'];
            $dateTime = new DateTime($dateString);

            $account = new IncomeModel($row['income_id'], $row['income_name'], $row['income_amount'], $dateTime, $row['income_note'], $row['username']);
            $incomes[] = $account;
        }
        return $incomes;
    }
    public function getExpenses()
    {
        $query = "SELECT *, (SELECT username FROM accounts WHERE account_id = expenses.account_id) as username FROM expenses";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $expenses = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dateString = $row['expense_date'];
            $dateTime = new DateTime($dateString);

            $account = new IncomeModel($row['expense_id'], $row['expense_name'], $row['expense_amount'], $dateTime, $row['expense_note'], $row['username']);
            $expenses[] = $account;
        }
        return $expenses;
    }

}

?>