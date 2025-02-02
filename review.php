<?php
session_start();
include 'connect.php'; // Database connection

// Get the order_id from the URL
$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Redirect to user orders if no valid order ID is provided
if ($orderId === 0) {
    header('Location: user-orders.php');
    exit;
}

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = intval($_POST['rating']);
    $comment = $_POST['comment'];

    $query = "INSERT INTO reviews (order_id, rating, comment) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $orderId, $rating, $comment);

    if ($stmt->execute()) {
        echo "<script>
            alert('Thank you for your review!');
            window.location.href = 'user-orders.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to submit your review. Please try again.');
        </script>";
    }
}
?>
<?php 

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['userName'] : "Account";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="assets/css/review-form.css" >
</head>
<style>
  section{
    padding: 80px 0px;
  }
 </style>
<body>
    <!-- Navbar -->
    <section id="submit-review">
    <div class="container-info"  data-aos="fade-up" >
        <div class="left">
            <h1 class="heading">Submit Your Review</h1>
            <p class="text">Your feedback helps us improve. Please rate your experience and leave a comment!</p>
            <form action="review.php?order_id=<?php echo $orderId; ?>" method="POST">
                <div class="inputbox">
                    <label for="rating" class="form-label">Rating (1-5 Stars)</label>
                    <select name="rating" id="rating" class="form-select" required>
                        <option value="">Select Rating</option>
                        <option value="1">⭐</option>
                        <option value="2">⭐⭐</option>
                        <option value="3">⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="5">⭐⭐⭐⭐⭐</option>
                    </select>
                </div>
                <div class="inputbox">
                    <label for="comment" class="form-label">Comment</label>
                    <textarea name="comment" id="comment" rows="4" required></textarea>
                </div>
                <div class="button-container">
                    <button type="submit" class="btn-2">Submit Review</button>
                    <a href="user-orders.php" class="btn btn-brand-2">Skip</a>
                </div>
            </form>
        </div>
        <div class="right">
            <!-- You can leave this empty or put some content here -->
        </div>
    </div>
</section>






    <!-- Footer -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html>
