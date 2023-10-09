<?php

$expensesTable = '
<div class="margined">
<div class="container d-flex justify-content-between">
    <h2>Incomes</h2>
</div>
</div>
        <table class="tableu">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Owner</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date Received</th>
                    <th>Note</th>
                </tr>
            </thead><tbody id="expenseTableBody">';
foreach ($expenses as $expense) {
    $expensesTable .= '
                    <tr>
                        <td>' . $expense->getID() . '</td>
                        <td>' . $expense->getOwner() . '</td>
                        <td>' . $expense->getName() . '</td>
                        <td>' . $expense->getAmount() . ' IQD</td>
                        <td>' . $expense->getDate() . '</td>
                        <td>' . $expense->getNote() . '</td>
                    </tr>';
}
$expensesTable .= '
        </tbody></table>
    </div>
    ';

return $expensesTable;
?>