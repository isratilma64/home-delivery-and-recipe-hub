<?php
include '../connect.php'; // Include database connection

// Fetch all users from the database
$query = "SELECT id, name, email, mobile, address FROM users";
$result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>user-info</title>
	<link rel="stylesheet" href="css-files/user-info.css">
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
			<li >
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
					<span class="text">Food products</span>
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
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
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
        <h1>User Information</h1>
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search by name or email">
        </div>
	
        <div class="table-container">
            <table id="userTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                                <td><?php echo htmlspecialchars($row['address']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
		</section>
		<script>
        // JavaScript for search functionality
        document.getElementById('searchInput').addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#userTable tbody tr');

            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const email = row.cells[2].textContent.toLowerCase();
                if (name.includes(searchValue) || email.includes(searchValue)) {
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