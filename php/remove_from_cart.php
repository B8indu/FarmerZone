<?php
session_start();
include 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['productId'];
$userId = $_SESSION['user_id'];

$sql = "DELETE FROM cart WHERE user_id = '$userId' AND product_id = '$productId'";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Product removed from cart']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to remove product from cart']);
}

$conn->close();
?>
