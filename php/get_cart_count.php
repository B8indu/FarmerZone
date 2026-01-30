<?php
session_start();
include 'config.php';

$userId = $_SESSION['user_id'];
$sql = "SELECT COUNT(*) as count FROM cart WHERE user_id = '$userId'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo json_encode(['count' => $row['count']]);

$conn->close();
?>
