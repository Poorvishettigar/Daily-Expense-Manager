<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estyle.css">
    <title>Expense Tracker App</title>
</head>
<body>
    <h1>Expense Tracker App</h1>
    
    <!-- Budget Section -->
    <div class="budget-section">
        <label for="budget-input">Set Budget:</label>
        <input type="number" id="budget-input" placeholder="Enter budget">
        <label for="start-date">Start Date:</label>
        <input type="date" id="start-date">
        <label for="end-date">End Date:</label>
        <input type="date" id="end-date">
        <button id="set-budget-btn">Set Budget</button>
    </div>
    
    <div id="budget-info"></div>
    <div id="remaining-budget-info"></div>
    
    <!-- Expense Input Section -->
    <div class="input-section">
        <label for="category-select">Category:</label>
        <select id="category-select">
            <option value="Food & Beverage">Food & Beverage</option>
            <option value="Rent">Rent</option>
            <option value="Transport">Transport</option>
            <option value="Relaxing">Relaxing</option>
        </select>
        <label for="amount-input">Amount:</label>
        <input type="number" id="amount-input">
        <label for="date-input">Date:</label>
        <input type="date" id="date-input">
        <label for="payment-method">Payment Method:</label>
        <select id="payment-method">
            <option value="Cash">Cash</option>
            <option value="Card">Card</option>
            <option value="Online">Online</option>
        </select>
        <button id="add-btn">Add</button>
    </div>
    
    <!-- Expenses List -->
    <div class="expenses-list">
        <h2>Expenses List</h2>
        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Payment Method</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="expense-table-body"></tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total:</td>
                    <td id="total-amount"></td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- JavaScript -->
    <script src="escript.js"></script>

</body>
</html>