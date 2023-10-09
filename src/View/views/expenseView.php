<?php

$expensesTable = '
<div class="margined">
<div class="container d-flex justify-content-between">
    <h2>Expense</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
      Add Expense
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
            </thead><tbody id="expenseTableBody">';
foreach ($allExpense as $expense) {
  $expensesTable .= '
                    <tr>
                        <td class="hid">' . $expense->getID() . '</td>
                        <td>' . $expense->getName() . '</td>
                        <td>' . $expense->getAmount() . ' IQD</td>
                        <td>' . $expense->getDate() . '</td>
                        <td>' . $expense->getNote() . '</td>
                        <td>
                        <button type="button" class="btn btn-primary updateExpenseButton" data-bs-toggle="modal" data-bs-target="#updateExpenseModal">Update</button>
                        <button class="btn btn-danger deleteExpenseButton"><a class="text-light text-decoration-none">Delete</a></button>
                    </td>
                    </tr>';
}
$expensesTable .= '
        </tbody></table>
    </div>
<!-- Add Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addExpenseModalLabel">Add Expense</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="addExpenseForm">
  <div class="form-group mb-3">
    <label for="expenseNameInput">Expense Name</label>
    <input type="text" class="form-control" name="expenseNameInput" id="expenseNameInput" placeholder="Enter Expense Name">
  </div>
  
  <div class="form-group mb-3">
    <label for="expenseAmountInput">Expense Amount</label>
    <div class="input-group">
      <input type="text" class="form-control" name="expenseAmountInput" id="expenseAmountInput" placeholder="Enter Amount">
      <div class="input-group-append">
        <span class="input-group-text" id="iqd">IQD</span>
      </div>
    </div>    
  </div>
  <div class="form-group mb-3">
    <label for="expenseDateInput">Expense Date</label>
    <input type="datetime-local" class="form-control" name="expenseDateInput" id="expenseDateInput">
  </div>
  <div class="form-group mb-3">
    <label for="expenseNoteInput">Expense Notes</label>
    <input type="text" class="form-control" name="expenseNoteInput" id="expenseNoteInput" placeholder="Enter Notes">
  </div>
</form>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="addExpenseButton">Add</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="updateExpenseModal" tabindex="-1" aria-labelledby="updateExpenseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateExpenseModalLabel">Edit Expense</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="updateExpenseForm">
      <input style="display:none;" type="text" class="form-control" name="expenseIdInput" id="expenseIdInput">
  <div class="form-group mb-3">
    <label for="expenseNameInput">Expense Name</label>
    <input type="text" class="form-control" name="expenseNameInput" id="expenseNameInput" placeholder="Enter Expense Name">
  </div>
  
  <div class="form-group mb-3">
    <label for="expenseAmountInput">Expense Amount</label>
    <div class="input-group">
      <input type="text" class="form-control" name="expenseAmountInput" id="expenseAmountInput" placeholder="Enter Amount">
      <div class="input-group-append">
        <span class="input-group-text" id="iqd">IQD</span>
      </div>
    </div>    
  </div>
  <div class="form-group mb-3">
    <label for="expenseDateInput">Expense Date</label>
    <input type="datetime-local" class="form-control" name="expenseDateInput" id="expenseDateInput">
  </div>
  <div class="form-group mb-3">
    <label for="expenseNoteInput">Expense Notes</label>
    <input type="text" class="form-control" name="expenseNoteInput" id="expenseNoteInput" placeholder="Enter Notes">
  </div>
</form>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="updateExpenseButton">Update</button>
      </div>
    </div>
  </div>
</div>
<script src="public/assets/js/expense.js" defer></script>
    ';

return $expensesTable;
?>