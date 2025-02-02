<?php 
session_start();
include 'connect.php'; // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['userName'])) {
    header("Location: sign-in-up.php"); // Redirect to login page if not logged in
    exit();
}

if (isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];

    // Check if the order belongs to the logged-in user
    $username = $_SESSION['userName'];
    $query = "SELECT * FROM orders WHERE order_id = ? AND username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $orderId, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If order exists for the logged-in user
    if ($result->num_rows > 0) {
        // Update the order status to 'Canceled'
        $updateQuery = "UPDATE orders SET status = 'Cancelled' WHERE order_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param('i', $orderId);
        if ($updateStmt->execute()) {
            $_SESSION['message'] = "Order cancelled successfully!";
            $_SESSION['message_type'] = "success";
            header("Location: user-orders.php"); // PHP redirection
            exit();
        } else {
            $_SESSION['message'] = "Error canceling the order. Please try again!";
            $_SESSION['message_type'] = "error";
            header("Location: user-orders.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Order not found or you don't have permission to cancel this order.";
        $_SESSION['message_type'] = "error";
        header("Location: user-orders.php");
        exit();
    }
} else {
    // If no order_id is provided
    $_SESSION['message'] = "Invalid request. No order ID provided.";
    $_SESSION['message_type'] = "error";
    header("Location: user-orders.php");
    exit();
}
?>
