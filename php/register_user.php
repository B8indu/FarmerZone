<?php
session_start();
include 'config.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check if the username or email already exists
$check_sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    // User already exists, redirect to login page
    echo "<script>
        alert('Username or email already exists. Please log in.');
        window.location.href = '../login_user.html';
    </script>";
} else {
    // Username and email are unique, proceed with registration
    $sql = "INSERT INTO users (username, email, password, type) VALUES ('$username', '$email', '$password', 'consumer')";

    if ($conn->query($sql) === TRUE) {
        // Get the newly created user ID
        $user_id = $conn->insert_id;

        // Store user information in the session
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        echo "<script>
            alert('New user registered successfully');
            window.location.href = '../user_dashboard.html';
        </script>";
    } else {
        echo "<script>
            alert('Error: " . $sql . "<br>" . $conn->error . "');
            window.history.back();
        </script>";
    }
}

$conn->close();
?>
