<?php
include 'connect.php';
session_start();

if (isset($_POST['signUP'])) {
    // Collect and sanitize input data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $mobile = trim($_POST['mobile']);

    // Validate password length
    if (strlen($password) < 8) {
        $_SESSION['message'] = "Password must be at least 8 characters long.";
        $_SESSION['message_type'] = "error";
        header("Location: sign-in-up.php");
        exit();
    }

    // Validate mobile number (11 digits)
    if (!preg_match('/^\d{11}$/', $mobile)) {
        $_SESSION['message'] = "Mobile number must be 11 digits.";
        $_SESSION['message_type'] = "error";
        header("Location: sign-in-up.php");
        exit();
    }

    // Hash the password using bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if the email already exists
    $checkEmailQuery = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmailQuery->bind_param("s", $email);
    $checkEmailQuery->execute();
    $result = $checkEmailQuery->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Email address already exists!";
        $_SESSION['message_type'] = "error";
        header("Location: sign-in-up.php");
        exit();
    }

    $checkEmailQuery->close();

    // Insert user data into the database
    $insertQuery = $conn->prepare("INSERT INTO users (name, email, password, address, mobile) VALUES (?, ?, ?, ?, ?)");
    $insertQuery->bind_param("sssss", $name, $email, $hashedPassword, $address, $mobile);

    if ($insertQuery->execute()) {
        // Log the user in immediately after successful registration
        $_SESSION['user_id'] = $conn->insert_id; // Get the inserted user ID
        $_SESSION['email'] = $email;
        $_SESSION['userName'] = $name;

        // Redirect to the homepage
        header("Location: sign-in-up.php");
        exit();
    } else {
        $_SESSION['message'] = "Error occurred during registration. Please try again.";
        $_SESSION['message_type'] = "error";
        header("Location: sign-in-up.php");
        exit();
    }

    $insertQuery->close();
}

$conn->close();
?>
