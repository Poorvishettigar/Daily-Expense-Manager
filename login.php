<?php
// Include the database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form data
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Prepare and execute the query to fetch user data
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Start a session and store user data
            session_start();
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            $_SESSION['email'] = $user['email']; // Store email in session

            // Redirect to the expense tracker home page (eindex.php)
            header("Location: eindex.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with this email!";
    }
}
?>
