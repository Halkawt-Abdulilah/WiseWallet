<?php

require_once __DIR__ . '\vendor\autoload.php';

use Wisewallet\Application;
use Wisewallet\Config\Router;
use Wisewallet\Controller\AuthController;
use Wisewallet\Controller\HomeController;
use Wisewallet\Controller\DashboardController;
use Wisewallet\Controller\IncomeController;
use Wisewallet\Controller\ExpenseController;
use Wisewallet\Controller\AdminController;
use Wisewallet\Controller\LogoutController;

$router = new Router();

$router->get('/', [HomeController::class, 'entry']);

$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/signup', [AuthController::class, 'showSignup']);
$router->post('/signup', [AuthController::class, 'signup']);
$router->get('/logout', [LogoutController::class, 'logout']);
$router->get('/dashboard', [DashboardController::class, 'showDashboard']);
$router->post('/dashboard/deposit', [DashboardController::class, 'depositSaving']);
$router->post('/dashboard/withdraw', [DashboardController::class, 'withdrawSaving']);
$router->get('/income', [IncomeController::class, 'showIncome']);
$router->post('/income/add', [IncomeController::class, 'addIncome']);
$router->post('/income/update', [IncomeController::class, 'updateIncome']);
$router->post('/income/delete', [IncomeController::class, 'deleteIncome']);
$router->get('/expense', [ExpenseController::class, 'showExpense']);
$router->post('/expense/add', [ExpenseController::class, 'addExpense']);
$router->post('/expense/edit', [ExpenseController::class, 'editExpense']);
$router->post('/expense/delete', [ExpenseController::class, 'deleteExpense']);
$router->get('/accounts', [AdminController::class, 'showDashboard']);
$router->get('/incomes', [AdminController::class, 'showIncomes']);
$router->get('/expenses', [AdminController::class, 'showExpenses']);

$application = new Application($router);

$application->run();

?>