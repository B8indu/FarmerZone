<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view your products.";
    exit();
}

$farmer_id = $_SESSION['user_id'];

$sql = "SELECT * FROM products WHERE farmer_id = '$farmer_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='col-md-4'>";
        echo "<div class='card'>";
        echo "<img src='" . $row['image'] . "' alt='Product Image' class='card-img-top'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['name'] . "</h5>";
        echo "<p class='card-text'>" . $row['description'] . "</p>";
        echo "<p class='card-text'>Price: Rs" . $row['price'] . "/kg</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No products found";
}

$conn->close();
?>
