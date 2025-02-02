<?php
include 'connect.php';
session_start();

if (isset($_POST['signIN'])) {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = trim($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email'");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        if (password_verify($password, $row['password'])) {
            // Set session variables for logged-in user
            $_SESSION['user_id'] = $row['id']; // Assuming 'id' is the primary key in the users table
            $_SESSION['email'] = $row['email'];
            $_SESSION['userName'] = $row['name'];

            // Redirect to the homepage
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['message'] = "Invalid email or password!";
            $_SESSION['message_type'] = "error";
            header("Location: sign-in-up.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "No user found with that email!";
        $_SESSION['message_type'] = "error";
        header("Location: sign-in-up.php");
        exit();
    }
}
?>
