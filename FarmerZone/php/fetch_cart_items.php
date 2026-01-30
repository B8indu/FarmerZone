<?php
session_start();
include 'config.php';

$userId = $_SESSION['user_id'];
$sql = "SELECT c.id as cart_id, p.id as product_id, p.name, p.description, p.price, p.image, p.farmer_id FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = '$userId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4">';
        echo '<div class="card mb-4">';
        echo '<img src="' . $row['image'] . '" class="card-img-top" alt="' . $row['name'] . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['name'] . '</h5>';
        echo '<p class="card-text">' . $row['description'] . '</p>';
        echo '<p class="card-text">Price: Rs' . $row['price'] . '/Kg</p>';
        echo '<p class="card-text">Farmer ID: ' . $row['farmer_id'] . '</p>';
        echo '<button class="btn btn-danger remove-from-cart" data-product-id="' . $row['product_id'] . '">Remove</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "Your cart is empty.";
}

$conn->close();
?>
