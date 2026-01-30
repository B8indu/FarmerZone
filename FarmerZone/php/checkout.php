<?php
session_start();
include 'config.php';

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Fetch farmer details based on the products in the cart
$query = "
    SELECT p.name AS product_name, u.address, u.phone 
    FROM cart c 
    JOIN products p ON c.product_id = p.id 
    JOIN users u ON p.farmer_id = u.id 
    WHERE c.user_id = '$user_id'
";
$result = $conn->query($query);

$farmers = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $farmers[] = $row;
    }
}

// Clear the cart
$clearCartQuery = "DELETE FROM cart WHERE user_id = '$user_id'";
$conn->query($clearCartQuery);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1647427017067-8f33ccbae493?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }
        nav.navbar {
            background-color: rgba(0, 0, 0, 0.7);
        }
        nav.navbar a.navbar-brand {
            color: white;
            font-weight: bold;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Display the body after a delay
            setTimeout(function () {
                document.body.style.display = 'block';
            }, 4000);

            // Alert on page reload/refresh
            window.onbeforeunload = function() {
                return "Warning: Cart items will be deleted if you reload or leave the page.";
            };

            // Download farmer details as a text file
            document.getElementById('download-btn').addEventListener('click', function () {
                const details = `<?php foreach ($farmers as $farmer) { echo "Product: " . $farmer['product_name'] . "\nFarmer Address: " . $farmer['address'] . "\nPhone Number: " . $farmer['phone'] . "\n\n"; } ?>`;
                const blob = new Blob([details], { type: 'text/plain' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'farmer_details.txt';
                a.click();
                URL.revokeObjectURL(url);
            });
        });
    </script>
</head>
<body style="display: none;">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">FarmZone</a>
    </nav>
    <div class="container">
        <h2>Checkout Farmer Details</h2>
        <?php if (!empty($farmers)): ?>
            <?php foreach ($farmers as $farmer): ?>
                <p><strong>Product:</strong> <?= $farmer['product_name']; ?></p>
                <p><strong>Farmer Address:</strong> <?= $farmer['address']; ?></p>
                <p><strong>Phone Number:</strong> <?= $farmer['phone']; ?></p>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No items in the cart.</p>
        <?php endif; ?>
        <a href="http://localhost/Farmer/user_dashboard.html" class="btn btn-primary mt-3">Back to Dashboard</a>
        <button id="download-btn" class="btn btn-secondary mt-3">Download Details</button>
    </div>
</body>
</html>
