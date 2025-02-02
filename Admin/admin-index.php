<?php
session_start();

// Check if the admin session is active
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../admin-access.php"); // Redirect to access page
    exit();
}

$adminUsername = $_SESSION['admin_username']; // Retrieve the logged-in admin's username
?>
<?php
include '../connect.php'; // Include your database connection

// Fetch the number of users
$userCountQuery = "SELECT COUNT(*) AS user_count FROM users";
$userCountResult = $conn->query($userCountQuery);
$userCount = $userCountResult->fetch_assoc()['user_count'];

// Fetch the number of recipes
$recipeCountQuery = "SELECT COUNT(*) AS recipe_count FROM recipes";
$recipeCountResult = $conn->query($recipeCountQuery);
$recipeCount = $recipeCountResult->fetch_assoc()['recipe_count'];


$orderCountQuery = "SELECT COUNT(*) AS order_count FROM orders";
$orderCountResult = $conn->query($orderCountQuery);
$orderCount = $orderCountResult->fetch_assoc()['order_count'];

// Fetch the first 5 recipes
$recipesQuery = "SELECT id, r_name, image_path FROM recipes ";
$recipesResult = $conn->query($recipesQuery);


// Fetch the last 5 orders
$orderQuery = "SELECT order_id, username, food_name, quantity, total_amount, created_at,payment_status,status
               FROM orders 
               ORDER BY created_at DESC 
               LIMIT 5";
$orderResult = $conn->query($orderQuery);




// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="css-files/dashboard.css">

    <title>AdminHub</title>
    <style>
    .recipes-display {
    
    border-radius: 12px;
   
    padding: 15px;
    background-color: linear-gradient(145deg, #f7f7f7, #e6e6e6);
    box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1), -4px -4px 8px #ffffff;
    font-family: var(--poppins);
}

.recipes-display h2 {
    font-size: 26px;
    color: #444;
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
    color: var(--blue);
}

.recipes-scroll {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    padding: 10px;
    scrollbar-width: thin; /* For Firefox */
    scrollbar-color: #f28482 #fdfbfb; /* For Firefox */
}

/* Webkit-based browsers (Chrome, Edge, Safari) */
.recipes-scroll::-webkit-scrollbar {
    height: 10px; /* Set the height of the scrollbar */
}

.recipes-scroll::-webkit-scrollbar-track {
    background: #fdfbfb; /* Track background color */
    border-radius: 5px; /* Rounded corners for the track */
}

.recipes-scroll::-webkit-scrollbar-thumb {
    background-color: #f28482; /* Thumb color */
    border-radius: 5px; /* Rounded corners for the thumb */
    border: 2px solid #fdfbfb; /* Add a border for better visibility */
}

.recipes-scroll::-webkit-scrollbar-thumb:hover {
    background-color: #e76f51; /* Thumb color on hover */
}


.recipe-item {
    background: white;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 10px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s, box-shadow 0.3s;
    width: 200px;
}

.recipe-item img {
    width: 100%;
    height: 150px; 
    width: 180px;
    border-radius: 12px;
    object-fit: cover;
    transition: transform 0.3s, filter 0.3s;
}

.recipe-item:hover img {
    transform: scale(1.1); /* Slight zoom on hover */
    filter: brightness(1.1); /* Make the image slightly brighter */
}

.recipe-item:hover {
    transform: translateY(-5px); /* Lift the item slightly */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.recipe-item p {
    margin: 10px 0 0;
    font-size: 16px;
    color: #555;
    font-weight: bold;
    transition: color 0.3s;
}

.recipe-item:hover p {
    color: #f28482; /* Change text color on hover */
}


    
    .orders-display {
   
    border-radius: 12px;
    background-color: linear-gradient(145deg, #f7f7f7, #e6e6e6);
    box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1), -4px -4px 8px #ffffff;
    padding: 25px;
    margin-top: 80px;
    font-family: var(--poppins);
}

.orders-display h2 {
    font-size: 26px;
    color: #444;
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
    
}

.orders-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.order-item {
    background: white;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
    position: relative;
    transition: transform 0.2s, box-shadow 0.2s;
}

.order-item p {
    margin: 8px 0;
    font-size: 16px;
    color: #555;
}

.order-item strong {
    color: #333;
}

.order-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.order-item::before {
    content: "";
    position: absolute;
    top: -5px;
    left: -5px;
    width: calc(100% + 10px);
    height: calc(100% + 10px);
    border-radius: 12px;
    background: linear-gradient(135deg, #f6d365, #fda085);
    z-index: -1;
    opacity: 0;
    transition: opacity 0.3s;
}

.order-item:hover::before {
    opacity: 1;
}

.orders-display h2 {
    color: #f28482;
}

.order-item strong {
    color: #5e6472;
    font-weight: bold;
}


.dashboard {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin: 10px 0;
}

/* Info Section: Vertical Boxes */
.info-section {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.info-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2px;
    background: linear-gradient(145deg, #f7f7f7, #e6e6e6);
    border-radius: 10px;
    box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1), -4px -4px 8px #ffffff;
    width: 140px;
    text-align: center;
    transition: transform 0.3s, background-color 0.3s;
}

.info-box:hover {
    transform: scale(1.05);
    background-color: #e8eefb;
}

.info-box i {
    font-size: 24px;
    color: #5a67d8;
    margin-bottom: 8px;
}

.info-box h3 {
    font-size: 18px;
    margin: 5px 0;
    color: #2d3748;
}

.info-box p {
    font-size: 12px;
    color: #718096;
}

/* Chart Section */
.chart-section {
    
    border-radius: 10px;
    padding: 15px;
    box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1), -4px -4px 8px #ffffff;
    max-width: 450px;
    width: 100%;
    height: 300px;
    background-color: linear-gradient(145deg, #f7f7f7, #e6e6e6);
}

.chart-section canvas {
    max-height: 300px;
    display: block;
    margin: auto;
}

/* Dashboard Image Section */
.dashboard-image img {
    max-width: 5300px;
    height: 300px;
    border-radius: 10px;
    box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1), -4px -4px 8px #ffffff;
}




</style>


</head>
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

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
       
		<h1 style="color: var(--dark);
	font-size: 15px;">Welcome, <?php echo htmlspecialchars($adminUsername); ?></h1>
       
      
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
            </div>
        </div>
        <div class="dashboard">
    <!-- Left Section: Vertical Boxes -->
    <div class="info-section">
        <div class="info-box"  >
            <i class='bx bxs-user-account' style="color:#36a2eb"></i>
            <span>
                <h3><?php echo $userCount; ?></h3>
                <p  style="color:#36a2eb;font-size:15px"  >Users</p>
            </span>
        </div>
        <div class="info-box">
            <i class='bx bxs-receipt' style="color:#ffcd56"></i>
            <span>
                <h3><?php echo $recipeCount; ?></h3>
                <p style="color:#ffcd56;font-size:15px">Recipes</p>
            </span>
        </div>
        <div class="info-box">
            <i class='bx bxs-category' style="color:#ff6384"></i>
            <span>
                <h3><?php echo $orderCount; ?></h3>
                <p style="color:#ff6384;font-size:15px">Orders</p>
            </span>
        </div>
    </div>

    <!-- Middle Section: Pie Chart -->
    <div class="chart-section">
        <canvas id="dashboardPieChart"></canvas>
    </div>

    <!-- Right Section: Image -->
    <div class="dashboard-image">
        <img src="images/Mealawe-vision.png" alt="Dashboard Vision">
    </div>
</div>


    </main>


    <div class="recipes-display">
    <h2>Recipes</h2>
    <div class="recipes-scroll">
        <?php 
        if ($recipesResult->num_rows > 0) {
            while ($recipe = $recipesResult->fetch_assoc()) {
                $imagePath = !empty($recipe['image_path']) && file_exists('../' . $recipe['image_path']) ? "../" . $recipe['image_path'] : "../uploads/default-image.jpg";
                echo "<div class='recipe-item'>";
                echo "<img src='$imagePath' alt='{$recipe['r_name']}' />";
                echo "<p>{$recipe['r_name']}</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No recipes available.</p>";
        }
        ?>
    </div>
</div>


<div class="orders-display ">
    <h2>Recent Orders</h2>
    <div class="orders-list">
        <?php 
        if ($orderResult->num_rows > 0) {
            while ($order = $orderResult->fetch_assoc()) {
                echo "<div class='order-item'>";
                echo "<p><strong>Order ID:</strong> {$order['order_id']}</p>";
                echo "<p><strong>User:</strong> {$order['username']}</p>";
                echo "<p><strong>Food:</strong> {$order['food_name']} ({$order['quantity']})</p>";
                echo "<p><strong>Total:</strong> $ {$order['total_amount']}</p>";
                echo "<p><strong>Payment status:</strong> {$order['payment_status']}</p>";
                echo "<p><strong>fFood status:</strong> {$order['status']}</p>";
                echo "<p><strong>Date:</strong> {$order['created_at']}</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No recent orders available.</p>";
        }
        ?>
    </div>
</div>


    <!-- MAIN -->
</section>
<!-- CONTENT -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('dashboardPieChart').getContext('2d');
    const data = {
        labels: ['Users', 'Recipes', 'Orders'],
        datasets: [{
            label: 'Dashboard Data',
            data: [<?php echo $userCount; ?>, <?php echo $recipeCount; ?>, <?php echo $orderCount; ?>],

            backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384'],
            hoverBackgroundColor: ['#2c81c4', '#d4a845', '#cc5171'],

            borderWidth: 1,
        }]
    };

    new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            },
            layout: {
                padding: 10
            }
        }
    });
</script>


<script src="js-files/deshboard.js"></script>
</body>
</html>
