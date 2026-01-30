<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT username, email FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'User not found']);
}

$conn->close();
?>
