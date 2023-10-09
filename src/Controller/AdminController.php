<?php

namespace Wisewallet\Controller;


use Wisewallet\Config\TokenHelper;
use Wisewallet\Repository\AuthRepository;
use Wisewallet\Repository\AdminRepository;


class AdminController
{


    public function showDashboard()
    {
        $authRep = new AuthRepository();
        $decryptedEmail = TokenHelper::getTokenEmail();
        $emailIsValid = $authRep->checkEmailExistence($decryptedEmail);

        if ($emailIsValid && TokenHelper::getTokenAccessLevel() == "Shadmin") {

            $adminRepository = new AdminRepository();
            $data = [
                'accounts' => $adminRepository->getAccounts(),

            ];
            HomeController::display("shadminAccountsView", "views", $data);
        }
    }
    public function showIncomes()
    {
        $authRep = new AuthRepository();
        $decryptedEmail = TokenHelper::getTokenEmail();
        $emailIsValid = $authRep->checkEmailExistence($decryptedEmail);

        if ($emailIsValid && TokenHelper::getTokenAccessLevel() == "Shadmin") {

            $adminRepository = new AdminRepository();
            $data = [
                'incomes' => $adminRepository->getIncomes(),

            ];
            HomeController::display("shadminIncomesView", "views", $data);
        }
    }
    public function showExpenses()
    {
        $authRep = new AuthRepository();
        $decryptedEmail = TokenHelper::getTokenEmail();
        $emailIsValid = $authRep->checkEmailExistence($decryptedEmail);

        if ($emailIsValid && TokenHelper::getTokenAccessLevel() == "Shadmin") {

            $adminRepository = new AdminRepository();
            $data = [
                'expenses' => $adminRepository->getExpenses(),

            ];
            HomeController::display("shadminExpensesView", "views", $data);
        }
    }

}

?>