<?php

// Database connection parameters
$host = "localhost";
$user = "root";
$pass = "";
$db = "login";

// Establishing connection to the database
$conn = mysqli_connect($host, $user, $pass, $db);

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Optional: Display a success message (useful for debugging)
// echo "Database connected successfully.";

?>
