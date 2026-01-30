<?php
include 'config.php';

$sql = "SELECT * FROM products";
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
        echo '<button class="btn btn-primary add-to-cart" data-product-id="' . $row['id'] . '">Add to Cart</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No products available.";
}

$conn->close();
?>
