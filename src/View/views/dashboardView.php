<?php
$dashboard = '
        <div class="main-content">
            <div class="box1">
                <div class="dash-title">
                    <h3>Welcome back, ' . $accountUsername . '!</h3>
                </div>
                <div class="dash-status">
                    <div class="box green-box">
                        <div class="box-text">Balance</div>
                        <div class="box-money" id="accountBalance">' . $accountBalance . ' IQD</div>
                    </div>
                    <div class="box green-box">
                        <div class="box-text">Monthly Income</div>
                        <div class="box-money">' . $accountIncome . ' IQD</div>
                    </div>
                    <div class="box red-box">
                        <div class="box-text">Monthly Expense</div>
                        <div class="box-money">' . $accountExpense . ' IQD</div>
                    </div>
                    <div class="box green-box">
                        <div class="box-text">Savings</div>
                        <div class="box-money" id="accountSavings">' . $accountSavings . ' IQD</div>
                    </div>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editSavingsModal">
                    Edit Savings
                  </button>
                </div>
            </div>
            <div>
                <h3>Recent Income</h3>
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Note</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>';
foreach ($recentIncome as $income) {
    $dashboard .= '
            <tr>
                <td>' . $income->getName() . '</td>
                <td>' . $income->getNote() . '</td>
                <td>' . $income->getAmount() . ' IQD</td>
                <td>' . $income->getDate() . '</td>
            </tr>';
}
$dashboard .= '
                    </tbody>
                </table>
            </div>
            <div>
                <h3>Recent Expense</h3>
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Note</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>';
foreach ($recentExpense as $expense) {
    $dashboard .= '
            <tr>
                <td>' . $expense->getName() . '</td>
                <td>' . $expense->getNote() . '</td>
                <td>' . $expense->getAmount() . ' IQD</td>
                <td>' . $expense->getDate() . '</td>
            </tr>';
}
$dashboard .= '
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editSavingsModal" tabindex="-1" aria-labelledby="editSavingsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editSavingsModalLabel">Edit Savings</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
              <form id="savingsForm">
      <div class="form-group input-group mb-3">
        <input type="text" class="form-control" name="savingAmount" placeholder="Saving Amount" aria-label="Saving Amount" aria-describedby="iqd">
        <div class="input-group-append">
          <span class="input-group-text" id="iqd">IQD</span>
        </div>
      </div>
      </form>
      
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="withdrawSavingsButton" data-bs-dismiss="modal">Withdraw</button>
              <button type="button" class="btn btn-primary" id="depositSavingsButton" data-bs-dismiss="modal">Deposit</button>
            </div>
          </div>
        </div>
      </div>
<script src="public/assets/js/dashboard.js" defer></script>';
return $dashboard;

?>