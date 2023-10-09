<?php

namespace Wisewallet\Controller;

use Exception;
use Wisewallet\Config\TokenHelper;
use Wisewallet\Repository\AuthRepository;
use Wisewallet\Repository\DashboardRepository;


class DashboardController
{


    public function showDashboard()
    {
        $authRep = new AuthRepository();
        $decryptedEmail = TokenHelper::getTokenEmail();
        $emailIsValid = $authRep->checkEmailExistence($decryptedEmail);

        if ($emailIsValid && TokenHelper::getTokenAccessLevel() == "User") {

            $dashboardRepository = new DashboardRepository();
            $data = [
                'accountUsername' => $dashboardRepository->getUsername($decryptedEmail),
                'accountBalance' => number_format($dashboardRepository->getBalance($decryptedEmail)),
                'accountIncome' => number_format($dashboardRepository->getMonthlyIncome($decryptedEmail)),
                'accountExpense' => number_format($dashboardRepository->getMonthlyExpense($decryptedEmail)),
                'accountSavings' => number_format($dashboardRepository->getSavings($decryptedEmail)),
                'recentIncome' => $dashboardRepository->getRecentIncome($decryptedEmail),
                'recentExpense' => $dashboardRepository->getRecentExpense($decryptedEmail),
            ];
            HomeController::display("dashboardView", "views", $data);
        } else {
            throw new IllegalArgumentException("Value must be non-negative");
        }
    }

    public function depositSaving()
    {

        $decryptedEmail = TokenHelper::getTokenEmail();
        $dashboardRepository = new DashboardRepository();

        $amount = $_POST['savingAmount'];

        $deposited = $dashboardRepository->depositSaving($amount, $decryptedEmail);
        if ($deposited) {
            $response = array(
                'status' => 'success',
                'message' => 'Deposit processed successfully'
            );

            http_response_code(200);
            echo json_encode($response);
        } else {
            $error = array(
                'status' => 'error',
                'message' => 'Failed to process withdrawal'
            );

            http_response_code(400);
            echo json_encode($error);
        }
    }
    public function withdrawSaving()
    {

        $decryptedEmail = TokenHelper::getTokenEmail();
        $dashboardRepository = new DashboardRepository();

        $amount = $_POST['savingAmount'];

        $withdrawn = $dashboardRepository->withdrawSaving($amount, $decryptedEmail);
        if ($withdrawn) {
            $response = array(
                'status' => 'success',
                'message' => 'Withdrawal processed successfully'
            );

            http_response_code(200);
            echo json_encode($response);
        } else {
            $error = array(
                'status' => 'error',
                'message' => 'Failed to process withdrawal'
            );

            http_response_code(400);
            echo json_encode($error);
        }
    }

}

?>