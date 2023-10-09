<?php

namespace Wisewallet\Controller;

use DateTime;
use Wisewallet\Config\TokenHelper;
use Wisewallet\Model\IncomeModel;
use Wisewallet\Repository\AuthRepository;
use Wisewallet\Repository\IncomeRepository;

class IncomeController
{
    public function showIncome()
    {
        $authRep = new AuthRepository();

        $decryptedEmail = TokenHelper::getTokenEmail();
        $emailIsValid = $authRep->checkEmailExistence($decryptedEmail);

        if ($emailIsValid) {
            $incomeRepository = new IncomeRepository();

            $data = [
                'allIncome' => $incomeRepository->getIncomes($decryptedEmail),
            ];

            HomeController::display("incomeView", "views", $data);
        }

    }
    public function addIncome()
    {
        $email = TokenHelper::getTokenEmail();

        $name = $_POST['incomeNameInput'] ?? '';
        $amount = $_POST['incomeAmountInput'] ?? '';
        $date = new DateTime($_POST['incomeDateInput']) ?? date('Y-m-d H:i:s');
        $note = $_POST['incomeNoteInput'] ?? '';

        $incomeModel = new IncomeModel(0, $name, $amount, $date, $note, "");
        $incomeRepository = new IncomeRepository();

        $incomeModel = $incomeRepository->addIncome($email, $incomeModel);
        $data = array(
            'id' => $incomeModel->getId(),
            'name' => $incomeModel->getName(),
            'date' => $incomeModel->getDate(),
            'amount' => $incomeModel->getAmount(),
            'note' => $incomeModel->getNote(),
        );
        echo json_encode($data);
    }

    public function updateIncome()
    {
        $id = $_POST['incomeIdInput'];
        $name = $_POST['incomeNameInput'] ?? '';
        $amount = $_POST['incomeAmountInput'] ?? '';
        $date = new DateTime($_POST['incomeDateInput']) ?? date('Y-m-d H:i:s');
        $note = $_POST['incomeNoteInput'] ?? '';

        $result = str_replace(",", "", $amount);
        $result = str_replace(" IQD", "", $result);

        $incomeModel = new IncomeModel($id, $name, intval($result), $date, $note, "");

        $incomeRepository = new IncomeRepository();

        $updated = $incomeRepository->updateIncome($incomeModel);
        if ($updated) {
            echo json_encode(array('status' => 'success'));
        }
    }

    public function deleteIncome()
    {
        $id = $_POST['id'];

        $incomeRepository = new IncomeRepository();
        $removed = $incomeRepository->deleteIncome($id);

        if ($removed) {
            echo json_encode(array('status' => 'success'));
        }
    }
}

?>