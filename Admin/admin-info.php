<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css-files/admin-info.css">
    <style>
        /* Inline CSS for the page */
        .admin-card {
            max-width: 400px;
            max-height: 500px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 15px;
            text-align: center;
            background-color: rgb(222, 203, 164);;
        }.row {
            display: flex;
            justify-content: space-around; /* Ensures even spacing between cards */
            flex-wrap: wrap; /* Ensures responsiveness on smaller screens */
            gap: 0px; /* Adds space between cards */
        }
        .admin-card img {
            width: 350px;
            height: 280px;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #ddd;
        }
        .admin-card h3 {
            font-size: 1.5rem;
            margin: 0;
            color:var(--orange);
        }
        .admin-card h4 {
            font-size: 1.3rem;
            margin: 0;
            color:coral;
        }
        .admin-card p {
            font-size: 1rem;
            margin: 5px 0;
            color: #555;
        }
        .admin-card .phone {
            color:coral;
            font-weight: bold;
        }
    </style>
</head>
<body>
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
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="nav-link">Categories</a>
    </nav>
    <div class="container">
        <h1 class="text-center my-5">Admin and Moderator</h1>
        <div class="row">
            <!-- Admin 1 -->
            <div class="col-md-3">
                <div class="admin-card">
                    <img src="./images/admin.jpg" alt="Admin Image">
                    <h3>Admin </h3>
                    <h4>Ikra Humaiyun</h4>
                    <p>Phone: <span class="phone">123-456-7890</span></p>
                </div>
            </div>
            <!-- Admin 2 -->
            <div class="col-md-3">
                <div class="admin-card">
                <img src="./images/WhatsApp sa njuu.jpg" alt="Admin Image">
                    <h3>Moderator </h3>
                    <h4>Tasneem Sanji</h4>
                    <p>Phone: <span class="phone">987-654-3210</span></p>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js-files/deshboard.js"></script>
</body>
</html>
