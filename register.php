<?php
// Include the database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form data
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = $conn->query($checkEmailQuery);

    if ($checkEmailResult->num_rows > 0) {
        // If email already exists, show an error
        echo "This email is already registered!";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (first_name, last_name, email, password) 
                VALUES ('$first_name', '$last_name', '$email', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
            header("Location: eindex.php"); // Redirect to login page after registration
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
