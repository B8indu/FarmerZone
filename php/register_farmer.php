<?php
session_start();
include 'config.php'; // Include your database connection configuration

// Retrieve form data using POST method
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$address = $_POST['address'];
$phone = $_POST['phone'];

// Prepare SQL query to insert data into the users table
$sql = "INSERT INTO users (username, email, password, address, phone, type) VALUES ('$username', '$email', '$password', '$address', '$phone', 'farmer')";

if ($conn->query($sql) === TRUE) {
    // If insertion was successful, set session variables and redirect
    $user_id = $conn->insert_id;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;

    // Redirect to farmer dashboard or any other desired page
    header('Location: ../farmer_dashboard.html');
    exit();
} else {
    // If there was an error with the insertion, show an error message
    echo "<script>
            alert('Error: " . $sql . "<br>" . $conn->error . "');
            window.history.back();
        </script>";
}

$conn->close(); // Close the database connection
?>
