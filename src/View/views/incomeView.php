<?php

$incomesTable = '
<div class="margined">
<div class="container d-flex justify-content-between">
    <h2>Income</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addIncomeModal">
      Add Income
    </button>
</div>
</div>
        <table class="tableu">
            <thead>
                <tr>
                    <th class="hid">ID</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date Received</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead><tbody id="incomeTableBody">';
foreach ($allIncome as $income) {
  $incomesTable .= '
                    <tr>
                        <td class="hid">' . $income->getID() . '</td>
                        <td>' . $income->getName() . '</td>
                        <td>' . $income->getAmount() . ' IQD</td>
                        <td>' . $income->getDate() . '</td>
                        <td>' . $income->getNote() . '</td>
                        <td>
                        <button type="button" class="btn btn-primary updateIncomeButton" data-bs-toggle="modal" data-bs-target="#updateIncomeModal">Update</button>
                        <button class="btn btn-danger deleteIncomeButton"><a class="text-light text-decoration-none">Delete</a></button>
                    </td>
                    </tr>';
}
$incomesTable .= '
        </tbody></table>
    </div>
<!-- Add Modal -->
<div class="modal fade" id="addIncomeModal" tabindex="-1" aria-labelledby="addIncomeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addIncomeModalLabel">Add Income</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="addIncomeForm">
  <div class="form-group mb-3">
    <label for="incomeNameInput">Income Name</label>
    <input type="text" class="form-control" name="incomeNameInput" id="incomeNameInput" placeholder="Enter Income Name">
  </div>
  
  <div class="form-group mb-3">
    <label for="incomeAmountInput">Income Amount</label>
    <div class="input-group">
      <input type="text" class="form-control" name="incomeAmountInput" id="incomeAmountInput" placeholder="Enter Amount">
      <div class="input-group-append">
        <span class="input-group-text" id="iqd">IQD</span>
      </div>
    </div>    
  </div>
  <div class="form-group mb-3">
    <label for="incomeDateInput">Income Date</label>
    <input type="datetime-local" class="form-control" name="incomeDateInput" id="incomeDateInput">
  </div>
  <div class="form-group mb-3">
    <label for="incomeNoteInput">Income Notes</label>
    <input type="text" class="form-control" name="incomeNoteInput" id="incomeNoteInput" placeholder="Enter Notes">
  </div>
</form>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="addIncomeButton">Add</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="updateIncomeModal" tabindex="-1" aria-labelledby="updateIncomeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateIncomeModalLabel">Edit Income</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="updateIncomeForm">
      <input style="display:none;" type="text" class="form-control" name="incomeIdInput" id="incomeIdInput">
  <div class="form-group mb-3">
    <label for="incomeNameInput">Income Name</label>
    <input type="text" class="form-control" name="incomeNameInput" id="incomeNameInput" placeholder="Enter Income Name">
  </div>
  
  <div class="form-group mb-3">
    <label for="incomeAmountInput">Income Amount</label>
    <div class="input-group">
      <input type="text" class="form-control" name="incomeAmountInput" id="incomeAmountInput" placeholder="Enter Amount">
      <div class="input-group-append">
        <span class="input-group-text" id="iqd">IQD</span>
      </div>
    </div>    
  </div>
  <div class="form-group mb-3">
    <label for="incomeDateInput">Income Date</label>
    <input type="datetime-local" class="form-control" name="incomeDateInput" id="incomeDateInput">
  </div>
  <div class="form-group mb-3">
    <label for="incomeNoteInput">Income Notes</label>
    <input type="text" class="form-control" name="incomeNoteInput" id="incomeNoteInput" placeholder="Enter Notes">
  </div>
</form>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="updateIncomeButton">Update</button>
      </div>
    </div>
  </div>
</div>
<script src="public/assets/js/income.js" defer></script>
    ';

return $incomesTable;
?>