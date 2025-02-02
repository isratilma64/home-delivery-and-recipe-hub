<?php
include '../connect.php';

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);

    // Fetch order details from the database
    $query = "SELECT o.order_id, o.food_name, o.created_at, o.status, o.payment_status, o.total_amount, u.name, u.address, u.mobile
              FROM orders o
              JOIN users u ON o.user_id = u.user_id
              WHERE o.order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        echo "<script>alert('Order not found!'); window.location.href='admin-orders.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid order ID!'); window.location.href='admin-orders.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css-files/admin-orders.css">
</head>
<style>
    .search-box {
    margin-bottom: 20px;
    display: flex;
    justify-content: flex-end;
}
.search-box input {
    padding: 18px 32px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 30px;
}
.search-box input:hover {
    
    border: 2px solid var(--blue);
    border-radius: 30px;
}
</style>
<body>
<section id="content">
    <nav>
        <a href="admin-orders.php" class="nav-link">Back to Orders</a>
    </nav>

    <div class="container">
        <h1>Order Details</h1>
        <table border="1">
            <tr>
                <th>Order ID</th>
                <td><?php echo $order['order_id']; ?></td>
            </tr>
            <tr>
                <th>User Name</th>
                <td><?php echo htmlspecialchars($order['name']); ?></td>
            </tr>
            <tr>
                <th>Food Name</th>
                <td><?php echo htmlspecialchars($order['food_name']); ?></td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td><?php echo $order['created_at']; ?></td>
            </tr>
            <tr>
                <th>Order Status</th>
                <td><?php echo $order['status']; ?></td>
            </tr>
            <tr>
                <th>Payment Status</th>
                <td><?php echo $order['payment_status']; ?></td>
            </tr>
            <tr>
                <th>Total Amount</th>
                <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo htmlspecialchars($order['address']); ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?php echo htmlspecialchars($order['mobile']); ?></td>
            </tr>
        </table>
    </div>
</section>
</body>
</html>
