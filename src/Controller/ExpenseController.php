<?php

namespace Wisewallet\Controller;

use DateTime;
use Wisewallet\Config\TokenHelper;
use Wisewallet\Model\ExpenseModel;
use Wisewallet\Repository\AuthRepository;
use Wisewallet\Repository\ExpenseRepository;

class ExpenseController
{
    public function showExpense()
    {
        $authRep = new AuthRepository();
        $decryptedEmail = TokenHelper::getTokenEmail();
        $emailIsValid = $authRep->checkEmailExistence($decryptedEmail);
        if ($emailIsValid) {
            $expenseRepository = new ExpenseRepository();

            $data = [
                'allExpense' => $expenseRepository->getExpense($decryptedEmail),
            ];

            HomeController::display("expenseView", "views", $data);
        }

    }
    public function addExpense()
    {
        $email = TokenHelper::getTokenEmail();

        $name = $_POST['expenseNameInput'] ?? '';
        $amount = $_POST['expenseAmountInput'] ?? '';
        $date = new DateTime($_POST['expenseDateInput']) ?? date('Y-m-d H:i:s');
        $note = $_POST['expenseNoteInput'] ?? '';

        $expenseModel = new ExpenseModel(0, $name, $amount, $date, $note, "");
        $expenseRepository = new ExpenseRepository();

        $expenseModel = $expenseRepository->addExpense($email, $expenseModel);
        $data = array(
            'id' => $expenseModel->getId(),
            'name' => $expenseModel->getName(),
            'date' => $expenseModel->getDate(),
            'amount' => $expenseModel->getAmount(),
            'note' => $expenseModel->getNote(),
        );
        echo json_encode($data);
    }

    public function updateExpense()
    {
        $id = $_POST['expenseIdInput'];
        $name = $_POST['expenseNameInput'] ?? '';
        $amount = $_POST['expenseAmountInput'] ?? '';
        $date = new DateTime($_POST['expenseDateInput']) ?? date('Y-m-d H:i:s');
        $note = $_POST['expenseNoteInput'] ?? '';

        $result = str_replace(",", "", $amount);
        $result = str_replace(" IQD", "", $result);

        $expenseModel = new ExpenseModel($id, $name, intval($result), $date, $note, "");

        $expenseRepository = new ExpenseRepository();

        $updated = $expenseRepository->updateExpense($expenseModel);
        if ($updated) {
            echo json_encode(array('status' => 'success'));
        }
    }

    public function deleteExpense()
    {
        $id = $_POST['id'];

        $expenseRepository = new ExpenseRepository();
        $removed = $expenseRepository->deleteExpense($id);

        if ($removed) {
            echo json_encode(array('status' => 'success'));
        }
    }
}

?>