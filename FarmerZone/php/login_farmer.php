<?php
session_start();
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' AND type = 'farmer'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        echo "<script>
            alert('Login successful');
            window.location.href = '../farmer_dashboard.html';
        </script>";
    } else {
        echo "<script>
            alert('Invalid password');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('No user found');
        window.history.back();
    </script>";
}

$conn->close();
?>
