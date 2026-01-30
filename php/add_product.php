<?php
session_start();
include 'config.php';

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_POST['image'];
$farmer_id = $_SESSION['user_id'];

$sql = "INSERT INTO products (name, description, price, image, farmer_id) VALUES ('$name', '$description', '$price', '$image', '$farmer_id')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Product added successfully');
        window.location.href = '../farmer_dashboard.html';
    </script>";
} else {
    echo "<script>
        alert('Error: " . $conn->error . "');
        window.history.back();
    </script>";
}

$conn->close();
?>
