// JavaScript for Expense Tracker App

let budget = 0;
let totalAmount = 0;

const budgetInput = document.getElementById('budget-input');
const startDateInput = document.getElementById('start-date');
const endDateInput = document.getElementById('end-date');
const setBudgetBtn = document.getElementById('set-budget-btn');
const budgetInfo = document.getElementById('budget-info');
const remainingBudgetInfo = document.getElementById('remaining-budget-info');

const categorySelect = document.getElementById('category-select');
const paymentMethodSelect = document.getElementById('payment-method');
const amountInput = document.getElementById('amount-input');
const dateInput = document.getElementById('date-input');
const addBtn = document.getElementById('add-btn');
const expensesTableBody = document.getElementById('expense-table-body');
const totalAmountCell = document.getElementById('total-amount');

const apiUrl = 'expense_manager.php'; // Ensure the PHP file path is correct

// Utility function to show alerts for errors and messages
function showAlert(message) {
    alert(message);
}

// Fetch and display the remaining budget
function fetchRemainingBudget() {
    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action: 'get_remaining_budget' }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                remainingBudgetInfo.textContent = data.error;
            } else {
                budgetInfo.textContent = `Budget: ${parseFloat(data.budget_amount).toFixed(2)}`;
                remainingBudgetInfo.textContent = `Remaining Budget: ${parseFloat(data.remaining_budget).toFixed(2)}`;
                totalAmountCell.textContent = parseFloat(data.total_expenses).toFixed(2);
            }
        })
        .catch(error => console.error('Error fetching remaining budget:', error));
}

// Fetch and display all expenses
function fetchExpenses() {
    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action: 'get' }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.error || data.length === 0) {
                expensesTableBody.innerHTML = '<tr><td colspan="5">No expenses found.</td></tr>';
            } else {
                expensesTableBody.innerHTML = data.map(expense => `
                    <tr>
                        <td>${expense.category}</td>
                        <td>${expense.amount}</td>
                        <td>${expense.expense_date}</td>
                        <td>${expense.payment_method}</td>
                        <td><button class="delete-btn" data-id="${expense.id}">Delete</button></td>
                    </tr>
                `).join('');
                totalAmount = data.reduce((sum, expense) => sum + parseFloat(expense.amount), 0);
                totalAmountCell.textContent = totalAmount.toFixed(2);
            }
        })
        .catch(error => console.error('Error fetching expenses:', error));
}

// Add event listener for setting the budget
setBudgetBtn.addEventListener('click', function () {
    const budgetValue = parseFloat(budgetInput.value);
    const startDate = startDateInput.value;
    const endDate = endDateInput.value;

    if (isNaN(budgetValue) || budgetValue <= 0 || !startDate || !endDate) {
        showAlert('Please fill all budget fields correctly.');
        return;
    }

    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'set_budget',
            budget_amount: budgetValue,
            start_date: startDate,
            end_date: endDate,
        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                fetchRemainingBudget();
                showAlert(data.message);
            } else {
                showAlert(data.error || 'Error setting budget.');
            }
        })
        .catch(error => console.error('Error setting budget:', error));
});

// Add event listener for adding expenses
addBtn.addEventListener('click', function () {
    const category = categorySelect.value;
    const amount = parseFloat(amountInput.value);
    const date = dateInput.value;
    const paymentMethod = paymentMethodSelect.value;

    if (!category || isNaN(amount) || amount <= 0 || !date || !paymentMethod) {
        showAlert('Please fill in all fields correctly.');
        return;
    }

    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'add',
            category: category,
            amount: amount,
            date: date,
            payment_method: paymentMethod,
        }),
    })
        .then(response => response.text())
        .then(data => {
            if (data === "New expense added successfully") {
                fetchExpenses();
                fetchRemainingBudget();
                showAlert('Expense added successfully!');
            } else {
                showAlert(data);
            }
        })
        .catch(error => console.error('Error adding expense:', error));
});

// Handle expense deletion
document.addEventListener('click', function (event) {
    if (event.target && event.target.classList.contains('delete-btn')) {
        const expenseId = event.target.getAttribute('data-id');

        fetch(apiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ action: 'delete', id: expenseId }),
        })
            .then(response => response.text())
            .then(data => {
                if (data === "Expense deleted successfully") {
                    fetchExpenses();
                    fetchRemainingBudget();
                    showAlert(data);
                } else {
                    showAlert(data);
                }
            })
            .catch(error => console.error('Error deleting expense:', error));
    }
});

// Initialize the app
window.onload = function () {
    fetchExpenses();
    fetchRemainingBudget();
};
