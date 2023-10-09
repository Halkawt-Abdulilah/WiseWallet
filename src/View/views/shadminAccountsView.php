<?php

$accountsTable = '
<div class="margined">
<div class="container d-flex justify-content-between">
    <h2>Accounts</h2>
</div>
</div>
        <table class="tableu">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Balance</th>
                    <th>Savings</th>
                </tr>
            </thead><tbody id="accountTableBody">';
foreach ($accounts as $account) {
    $accountsTable .= '
                    <tr>
                        <td>' . $account->getID() . '</td>
                        <td>' . $account->getUsername() . '</td>
                        <td>' . $account->getEmail() . '</td>
                        <td>' . $account->getBalance() . ' IQD</td>
                        <td>' . $account->getSavings() . ' IQD</td>
                    </tr>';
}


return $accountsTable;
?>