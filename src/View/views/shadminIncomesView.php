<?php

$incomesTable = '
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
            </thead><tbody id="incomeTableBody">';
foreach ($incomes as $income) {
    $incomesTable .= '
                    <tr>
                        <td>' . $income->getID() . '</td>
                        <td>' . $income->getOwner() . '</td>
                        <td>' . $income->getName() . '</td>
                        <td>' . $income->getAmount() . ' IQD</td>
                        <td>' . $income->getDate() . '</td>
                        <td>' . $income->getNote() . '</td>
                    </tr>';
}
$incomesTable .= '
        </tbody></table>
    </div>
    ';

return $incomesTable;
?>