<?php 
session_start();
include 'connect.php'; // Include the database connection file

// Fetch all reviews
$query = "
    SELECT r.rating, r.comment, r.created_at, o.food_name, o.username 
    FROM reviews r
    JOIN orders o ON r.order_id = o.order_id
    ORDER BY r.created_at DESC
";
$result = $conn->query($query); // Use $conn defined in connect.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">All User Reviews</h1>
    <?php if ($result && $result->num_rows > 0): ?>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo htmlspecialchars($row['food_name']); ?>
                            </h5>
                            <h6 class="card-subtitle text-muted">
                                Reviewed by <?php echo htmlspecialchars($row['username']); ?>
                            </h6>
                            <p class="mt-2">
                                <?php echo htmlspecialchars($row['comment']); ?>
                            </p>
                            <div class="mt-2">
                                <strong>Rating:</strong> 
                                <?php echo str_repeat('⭐', $row['rating']); ?>
                            </div>
                            <small class="text-muted">
                                Reviewed on <?php echo date('F d, Y', strtotime($row['created_at'])); ?>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No reviews yet. Be the first to leave one!</p>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
