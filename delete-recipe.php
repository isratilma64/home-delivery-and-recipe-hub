<?php 
include 'connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in-up.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$recipe_id = $_GET['id'];

// Fetch the recipe to ensure it belongs to the logged-in user
$sql = "SELECT * FROM recipes WHERE id = $recipe_id AND user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Delete the recipe
    $delete_sql = "DELETE FROM recipes WHERE id = $recipe_id AND user_id = $user_id";
    if ($conn->query($delete_sql)) {
        echo "Recipe deleted successfully!";
        header("Location: my-recipes.php");
        exit();
    } else {
        echo "Error deleting recipe: " . $conn->error;
    }
} else {
    echo "Recipe not found or you do not have permission to delete this recipe.";
}
?>
