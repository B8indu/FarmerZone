<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to FarmerZone</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        /* Custom styles specific to this page */
        .hero {
    height: 100vh;
    background-image: url('https://plus.unsplash.com/premium_photo-1661963981438-a139811fe1b2?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    position: relative;
    
}


        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .navbar {
            background-color: #343a40 !important;
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: white !important;
        }

        .navbar-nav .dropdown-menu {
            background-color: #343a40;
            border: none;
        }

        .navbar-nav .dropdown-menu .dropdown-item {
            color: white;
        }

        .navbar-nav .dropdown-menu .dropdown-item:hover {
            background-color: #292e32;
        }

        .section {
            padding: 20px 0;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .footer a {
            color: white;
        }

        /* Styling for Product Listing */
        .card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">FarmerZone</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Register
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="register_farmer.html">Farmer</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="register_user.html">Consumers</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="login_farmer.html">Farmer</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="login_user.html">Consumer</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Project.html">Project Info</a>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="container text-center">
            <h1>Welcome to FarmerZone</h1>
            <p class="lead">Connecting Farmers and Consumers</p>
        </div>
    </section>

    <!-- Product Listing Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <?php
                include 'php/config.php';

                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4 mb-4'>";
                        echo "<div class='card h-100'>";
                        echo "<img src='" . $row['image'] . "' class='card-img-top' alt='Product Image'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $row['name'] . "</h5>";
                        echo "<p class='card-text'>" . $row['description'] . "</p>";
                        echo "<p class='card-text'>Price: Rs" . $row['price'] . "/kg</p>";
                        echo "<a href='login_user.html' class='btn btn-primary'>Buy Now</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No products found.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2>About FarmerZone</h2>
                    <p class="lead">FarmerZone is a platform that connects local farmers directly with consumers, enabling farmers to sell their produce and products efficiently.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 FarmerZone. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
