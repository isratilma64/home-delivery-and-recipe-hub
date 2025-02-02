<?php
include '../connect.php'; // Include database connection

// Fetch all recipes from the database

$query = "
    SELECT 
        recipes.id, 
        recipes.r_name, 
        recipes.image_path AS image, 
        recipes.ingredients, 
        recipes.instructions, 
        users.name 
    FROM recipes 
    JOIN users 
    ON recipes.user_id = users.id
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>recipe-info</title>
	<link rel="stylesheet" href="css-files/recipe-info.css">
</head>
<body>
    <!-- SIDEBAR -->
	<!-- SIDEBAR -->
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
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			
			
		</nav>


    <div class="container">
        <h1>Recipes Information</h1>
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search by recipe name or user email">
        </div>
        <div class="table-container">
            <table id="recipesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Ingredients</th>
                        <th>Instructions</th>
                        
                        <th>Submitted By</th>
                    </tr>
                </thead>
                <tbody>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['r_name']); ?></td>
                <td>
                    <?php if (!empty($row['image']) && file_exists('../' . $row['image'])): ?>
                        <img src="../<?php echo htmlspecialchars($row['image']); ?>" alt="Recipe Image" style="width: 100px; height: auto;">
                    <?php else: ?>
                        <img src="../uploads/default-image.jpg" alt="Default Image" style="width: 100px; height: auto;">
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($row['ingredients']); ?></td>
                <td><?php echo htmlspecialchars($row['instructions']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">No recipes found.</td>
        </tr>
    <?php endif; ?>
</tbody>

            </table>
        </div>
    </div>

    <script>
        // JavaScript for search functionality
        document.getElementById('searchInput').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#recipesTable tbody tr');

    rows.forEach(row => {
        const name = row.cells[1].textContent.toLowerCase(); // Recipe Name
        const submitter = row.cells[5].textContent.toLowerCase(); // Submitted By
        if (name.includes(searchValue) || submitter.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

    </script>
    <script src="js-files/deshboard.js"></script>
</body>
</html>

<?php $conn->close(); ?>
