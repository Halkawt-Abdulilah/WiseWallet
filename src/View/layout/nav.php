<?php
use Wisewallet\Config\TokenHelper;
use Wisewallet\Repository\AuthRepository;

$authRepository = new AuthRepository();
if (isset($_COOKIE['jwt'])) {
    if (TokenHelper::getTokenAccessLevel() == "User" && $authRepository->checkEmailExistence(TokenHelper::getTokenEmail())) {
        return '
        <div class="sidebar">
        <h2>WiseWallet</h2>
        <ul>
            <li><a href="dashboard"><span>Dashboard</span></a></li>
            <li><a href="income"><span>Income</span></a></li>
            <li><a href="expense"><span>Expense</span></a></li>
            <li><a href="logout"><span>Logout</span></a></li>
        </ul>
    </div>
        ';

    } else if (TokenHelper::getTokenAccessLevel() == "Shadmin" && $authRepository->checkEmailExistence(TokenHelper::getTokenEmail())) {
        return '
        <div class="sidebar">
        <h2>WiseWallet</h2>
        <ul>
            <li><a href="accounts"><span>Users</span></a></li>
            <li><a href="incomes"><span>Incomes</span></a></li>
            <li><a href="expenses"><span>Expenses</span></a></li>
            <li><a href="logout"><span>Logout</span></a></li>
        </ul>
    </div>';

    }
} else {
    return
        '
    <nav class="navbar navbar-expand-lg public-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">
            <img src="" alt="" width="30" height="24"
                class="d-inline-block align-text-top">
            WiseWallet
        </a>
        <div class="collapse navbar-collapse nav justify-content-end">
            <ul class="navbar-nav">
                <li class="navbar-item">
                    <a id="navbar-login" class="nav-link" href="./login">Login</a>
                </li>
                <li class="navbar-item">
                    <a id="navbar-signup" class="nav-link" href="./signup">Signup</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    ';
}

?>