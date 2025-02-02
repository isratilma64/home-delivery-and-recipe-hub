<?php
// Disable caching
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start(); // Start the session

// Hardcoded admin credentials (use a database for better security)
$admins = [
    'Admin' => password_hash('pass123', PASSWORD_BCRYPT), // Replace with your hashed password
    'Modateror' => password_hash('pass456', PASSWORD_BCRYPT)  // Replace with your hashed password
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify username and password
    if (isset($admins[$username]) && password_verify($password, $admins[$username])) {
        $_SESSION['is_admin'] = true; // Set session variable for admin login
        $_SESSION['admin_username'] = $username; // Store admin username
        
        // Redirect to admin dashboard
        if (!headers_sent()) {
            header("Location: admin/admin-index.php");
            exit();
        } else {
            echo "<script>window.location.href='admin/admin-index.php';</script>";
            exit();
        }
    } else {
        $error = "Invalid username or password!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Gentium+Book+Plus:ital,wght@0,400;0,700;1,400;1,700&family=Gentium+Plus:ital,wght@0,400;0,700;1,400;1,700&display=swap');
       /* Global Styles */

       h1,h2,h3,h4,h5,h6{
    font-weight: 700;
   
    
}
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
   
}

/* Container for the layout */
.container {
    display: flex;
    flex-direction: row;
    height: 100vh;
    width: 100%;
}

/* Left section for the image */
.image-section {
    flex: 1;
    background-color: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-section img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Right section for the form */
.form-section {
    flex: 1;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #ffffff;
}

.form-section h1 {
    margin-bottom: 20px;
    font-size: 28px;
    color: #333;
}

.form-section form {
    width: 80%;
    max-width: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.form-section input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

.form-section button {
    width: 100%;
    padding: 10px;
    background-color:rgb(red, green, blue);
    color: #333;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

.form-section button:hover {
    background-color: rgb(0,0,0,0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .image-section {
        flex: none;
        height: 50%;
    }

    .form-section {
        flex: none;
        height: 50%;
    }
}
      
    </style>



</head>
<body>
<div class="container">
    <!-- Left Section for Image -->
    <div class="image-section">
        <img src="assets/images/delivery-service-with-mask-design_23-2148504209.avif" alt="Admin Panel">
    </div>

    <div class="form-section">
        <h1>Admin Login</h1>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Enter Admin Username" required>
            <input type="password" name="password" placeholder="Enter Admin Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
