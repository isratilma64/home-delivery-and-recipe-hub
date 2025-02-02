<?php
session_start();
include 'connect.php'; // Include your database connection

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in as admin
    exit();
}

if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];

    // Update the order status in the database
    $updateQuery = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('si', $status, $orderId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Order status updated successfully!";
        $_SESSION['message_type'] = "success";
        header("Location: admin-orders.php"); // Redirect back to the admin orders page
        exit();
    } else {
        $_SESSION['message'] = "Error updating order status.";
        $_SESSION['message_type'] = "error";
        header("Location: admin-orders.php");
        exit();
    }
} else {
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['message_type'] = "error";
    header("Location: admin-orders.php");
    exit();
}
?>
