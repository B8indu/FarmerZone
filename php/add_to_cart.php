<?php
session_start();
include 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['productId'];
$userId = $_SESSION['user_id'];

// Check if product is already in the cart
$sql = "SELECT * FROM cart WHERE user_id = '$userId' AND product_id = '$productId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Product already in cart']);
} else {
    $sql = "INSERT INTO cart (user_id, product_id) VALUES ('$userId', '$productId')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Product added to cart']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add product to cart']);
    }
}

$conn->close();
?>
