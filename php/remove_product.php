<?php
session_start();
include 'config.php'; // Assuming this file contains your database connection details

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve product name from POST data
    $productName = $_POST['productName'];

    // Retrieve current farmer's ID from session
    $farmerId = $_SESSION['user_id'];

    // Prepare SQL statement to delete product where product name matches and farmer ID matches
    $stmt = $conn->prepare("DELETE FROM products WHERE name = ? AND farmer_id = ?");
    $stmt->bind_param("si", $productName, $farmerId);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            echo "Product '$productName' removed successfully.";
        } else {
            echo "No product with name '$productName' found.";
        }
    } else {
        echo "Error executing SQL statement: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close connection
$conn->close();
?>
