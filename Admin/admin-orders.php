<?php
// Start the session
session_start();

// Include the database connection
include '../connect.php';

// Update order status or payment_status if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'] ?? null;
    $payment_status = $_POST['payment_status'] ?? null;

    // Fetch the current status to ensure 'Cancelled' orders aren't updated
    $check_query = "SELECT status FROM orders WHERE order_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $order_id);
    $check_stmt->execute();
    $current_status = $check_stmt->get_result()->fetch_assoc()['status'];

    if ($current_status !== 'Cancelled') {
        $update_query = "UPDATE orders SET status = ?, payment_status = ? WHERE order_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssi", $status, $payment_status, $order_id);

        if ($stmt->execute()) {
            echo "<script>alert('Order updated successfully!'); window.location.href='admin-orders.php';</script>";
        } else {
            echo "Error updating order: " . $conn->error;
        }
    } else {
        echo "<script>alert('Cannot update a cancelled order!'); window.location.href='admin-orders.php';</script>";
    }
}

// Fetch all orders
$query = "SELECT * FROM orders";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Orders</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css-files/admin-order.css">
</head>
<style>.search-box {
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
}</style>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <ul class="side-menu top">
        <li class="active">
            <a href="admin-index.php">
                <i class='bx bxs-user-account'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="user-info.php">
                <i class='bx bxs-user-account'></i>
                <span class="text">Users</span>
            </a>
        </li>
        <li>
            <a href="recipe-info.php">
                <i class='bx bxs-receipt'></i>
                <span class="text">Recipes</span>
            </a>
        </li>
        <li>
            <a href="recipes-for-sale.php">
                <i class='bx bxs-food-menu'></i>
                <span class="text">Menu</span>
            </a>
        </li>
        <li>
            <a href="admin-products.php">
                <i class='bx bxs-food-menu'></i>
                <span class="text">Food Products</span>
            </a>
        </li>
        <li>
            <a href="admin-orders.php">
                <i class='bx bxs-category'></i>
                <span class="text">Orders</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
    <li>
            <a href="admin-info.php" >
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Adminastration</span>
            </a>
        </li>
        <li>
            <a href="admin-logout.php" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->

<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="nav-link">Categories</a>
    </nav>

    <div class="container">
        <h1>Manage Orders</h1>
        <div class="search-box">
    <input type="text" id="searchInput" placeholder="Search by Customer ">
</div>

        <!-- Orders Display Section -->
        <div class="table-container">
            <table id="ordersTable">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Bikash Number</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $isCancelled = ($row['status'] === 'Cancelled');
                            echo "<tr>";
                            echo "<td>{$row['username']}</td>";
                            echo "<td>{$row['food_name']}</td>";
                            echo "<td>{$row['quantity']}</td>";
                            echo "<td>{$row['address']}</td>";
                            echo "<td>{$row['phone_number']}</td>";
                            echo "<td>\${$row['total_amount']}</td>";
                            echo "<td>{$row['payment_method']}</td>";
                            echo "<td>{$row['bikash_number']}</td>";
                            echo "<td>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='order_id' value='{$row['order_id']}'>
                                        <select name='status' " . ($isCancelled ? "disabled" : "") . ">";
                            $statuses = ['Order Placed', 'Food Received', 'On the Way', 'Food Delivered', 'Cancelled'];
                            foreach ($statuses as $status_option) {
                                $selected = ($row['status'] === $status_option) ? "selected" : "";
                                echo "<option value='$status_option' $selected>$status_option</option>";
                            }
                            echo "</select>
                                  </td>";
                            echo "<td>
                                        <select name='payment_status'>
                                            <option value='Not Paid Yet'" . ($row['payment_status'] === 'Not Paid Yet' ? " selected" : "") . ">Not Paid Yet</option>
                                            <option value='Paid'" . ($row['payment_status'] === 'Paid' ? " selected" : "") . ">Paid</option>
                                        </select>
                                  </td>";
                            echo "<td>
                                        <button type='submit' " . ($isCancelled ? "disabled" : "") . ">Update</button>
                                  </form>
                                  </td>";
                            echo "<td>{$row['created_at']}</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12'>No orders found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let query = this.value.toLowerCase(); // Get the search query

        // Get all table rows except the header
        let rows = document.querySelectorAll('#ordersTable tbody tr');

        rows.forEach(row => {
            // Extract the text content from Customer and Product Name columns
            let customerName = row.cells[0].textContent.toLowerCase(); // Adjust index if needed
            let productName = row.cells[1].textContent.toLowerCase(); // Adjust index if needed

            // Check if the query matches either Customer or Product Name
            let match = customerName.includes(query) || productName.includes(query);

            // Show or hide the row based on the match
            row.style.display = match ? '' : 'none';
        });
    });
</script>



<script src="js-files/deshboard.js"></script>
</body>
</html>
