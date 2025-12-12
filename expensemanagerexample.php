<?
require_once 'db_connection.php';

// Get action from request
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if (!$action) {
    echo json_encode(['error' => 'Action is required.']);
    exit;
}

// Handle actions
switch ($action) {
    case 'add':
        addExpense($conn);
        break;

    case 'delete':
        deleteExpense($conn);
        break;

    case 'get':
        getExpenses($conn);
        break;

    case 'set_budget':
        setBudget($conn);
        break;

    case 'get_remaining_budget':
        getRemainingBudget($conn);
        break;

    default:
        echo json_encode(['error' => 'Invalid action.']);
}

// Close the connection
$conn->close();

/**
 * Add a new expense
 */
function addExpense($conn) {
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
    $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $payment_method = filter_input(INPUT_POST, 'payment_method', FILTER_SANITIZE_STRING);

    if (!$category || !$amount || !$date || !$payment_method) {
        echo json_encode(['error' => 'All fields are required.']);
        exit;
    }

    if ($amount <= 0) {
        echo json_encode(['error' => 'Amount must be greater than zero.']);
        exit;
    }

    if (!strtotime($date)) {
        echo json_encode(['error' => 'Invalid date format.']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO expenses (category, amount, expense_date, payment_method) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['error' => 'SQL Error: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("sdss", $category, $amount, $date, $payment_method);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Expense added successfully']);
    } else {
        echo json_encode(['error' => 'Error adding expense: ' . $stmt->error]);
    }

    $stmt->close();
}

/**
 * Delete an expense
 */
function deleteExpense($conn) {
    $expense_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if (!$expense_id) {
        echo json_encode(['error' => 'Expense ID is required and must be an integer.']);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM expenses WHERE id = ?");
    if (!$stmt) {
        echo json_encode(['error' => 'SQL Error: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("i", $expense_id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Expense deleted successfully']);
    } else {
        echo json_encode(['error' => 'Error deleting expense: ' . $stmt->error]);
    }

    $stmt->close();
}

/**
 * Get all expenses
 */
function getExpenses($conn) {
    $result = $conn->query("SELECT * FROM expenses");

    if (!$result) {
        echo json_encode(['error' => 'SQL Error: ' . $conn->error]);
        exit;
    }

    $expenses = [];
    while ($row = $result->fetch_assoc()) {
        $expenses[] = $row;
    }

    echo json_encode($expenses);
}

/**
 * Set a budget
 */
function setBudget($conn) {
    $budget_amount = filter_input(INPUT_POST, 'budget_amount', FILTER_VALIDATE_FLOAT);
    $start_date = filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING);
    $end_date = filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING);

    if (!$budget_amount || !$start_date || !$end_date) {
        echo json_encode(['error' => 'All fields are required.']);
        exit;
    }

    if ($budget_amount <= 0) {
        echo json_encode(['error' => 'Budget amount must be greater than zero.']);
        exit;
    }

    if (strtotime($start_date) > strtotime($end_date)) {
        echo json_encode(['error' => 'Start date cannot be later than end date.']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO budgets (budget_amount, start_date, end_date) VALUES (?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['error' => 'SQL Error: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("dss", $budget_amount, $start_date, $end_date);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Budget set successfully']);
    } else {
        echo json_encode(['error' => 'Error setting budget: ' . $stmt->error]);
    }

    $stmt->close();
}

/**
 * Get remaining budget
 */
function getRemainingBudget($conn) {
    $budget_result = $conn->query("SELECT * FROM budgets ORDER BY id DESC LIMIT 1");

    if (!$budget_result) {
        echo json_encode(['error' => 'SQL Error: ' . $conn->error]);
        exit;
    }

    $budget = $budget_result->fetch_assoc();
    if (!$budget) {
        echo json_encode(['error' => 'No budget set.']);
        exit;
    }

    $expenses_result = $conn->query("SELECT SUM(amount) as total_expenses FROM expenses");

    if (!$expenses_result) {
        echo json_encode(['error' => 'SQL Error: ' . $conn->error]);
        exit;
    }

    $expenses = $expenses_result->fetch_assoc();
    $total_expenses = $expenses['total_expenses'] ?? 0;

    $remaining_budget = $budget['budget_amount'] - $total_expenses;

    echo json_encode([
        'budget_amount' => $budget['budget_amount'],
        'total_expenses' => $total_expenses,
        'remaining_budget' => $remaining_budget,
    ]);
}
?>