<?
require_once 'db_connection.php';



// Create tables if not exist
$sql_budget = "CREATE TABLE IF NOT EXISTS budgets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    budget_amount DECIMAL(10, 2) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL
);";

$sql_expenses = "CREATE TABLE IF NOT EXISTS expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    expense_date DATE NOT NULL
);";

$conn->query($sql_budget);
$conn->query($sql_expenses);

// Handle incoming requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'set_budget') {
        // Set a new budget
        $budget_amount = $_POST['budget_amount'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $stmt = $conn->prepare("INSERT INTO budgets (budget_amount, start_date, end_date) VALUES (?, ?, ?)");
        $stmt->bind_param('dss', $budget_amount, $start_date, $end_date);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Budget set successfully"]);
        } else {
            echo json_encode(["error" => "Failed to set budget"]);
        }
        $stmt->close();
    } elseif ($action === 'get_budget') {
        // Get the latest budget
        $result = $conn->query("SELECT * FROM budgets ORDER BY id DESC LIMIT 1");
        $budget = $result->fetch_assoc();
        echo json_encode($budget);
    } elseif ($action === 'get_remaining_budget') {
        // Calculate the remaining budget
        $budget_result = $conn->query("SELECT * FROM budgets ORDER BY id DESC LIMIT 1");
        $budget = $budget_result->fetch_assoc();

        if ($budget) {
            $start_date = $budget['start_date'];
            $end_date = $budget['end_date'];
            $budget_amount = $budget['budget_amount'];

            // Calculate total expenses within the budget's date range
            $expense_result = $conn->query("SELECT SUM(amount) AS total_expenses FROM expenses WHERE expense_date BETWEEN '$start_date' AND '$end_date'");
            $expense_data = $expense_result->fetch_assoc();
            $total_expenses = $expense_data['total_expenses'] ?? 0;

            // Calculate remaining budget
            $remaining_budget = $budget_amount - $total_expenses;

            echo json_encode([
                "budget_amount" => $budget_amount,
                "total_expenses" => $total_expenses,
                "remaining_budget" => $remaining_budget
            ]);
        } else {
            echo json_encode(["error" => "No budget found"]);
        }
    }
}

// Close the connection
$conn->close();
?>
