<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM recipes WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $recipe = $result->fetch_assoc();

        echo "<h3>" . htmlspecialchars($recipe['name']) . "</h3>";

        if (!empty($recipe['image_path'])) {
            echo "<img src='" . htmlspecialchars($recipe['image_path']) . "' alt='" . htmlspecialchars($recipe['name']) . "' class='img-fluid mb-3'>";
        } else {
            echo "<p>No image available</p>";
        }

        echo "<h4>Ingredients</h4><ul>";
        $ingredients = explode("\n", $recipe['ingredients']);
        foreach ($ingredients as $ingredient) {
            echo "<li>" . htmlspecialchars($ingredient) . "</li>";
        }
        echo "</ul>";

        echo "<h4>Instructions</h4><ol>";
        $instructions = explode("\n", $recipe['instructions']);
        foreach ($instructions as $step) {
            echo "<li>" . htmlspecialchars($step) . "</li>";
        }
        echo "</ol>";
    } else {
        echo "<p class='text-danger'>Recipe not found.</p>";
    }
} else {
    echo "<p class='text-danger'>Invalid request.</p>";
}
?>
