<?php
/**
 * Example database connection file for the Expense Manager project.
 * 
 * COPY this file as db_connection.php and update the credentials 
 * based on your local environment (XAMPP / phpMyAdmin).
 */

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = ''; // Leave empty for XAMPP default
$DB_NAME = 'your-db-name';

// Create connection
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check connection
if ($mysqli->connect_errno) {
    die("Database connection failed. Please check credentials.");
}

$mysqli->set_charset("utf8mb4");
?>
