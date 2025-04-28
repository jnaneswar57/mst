<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Already logged in, go to index.php
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>

    <header class="hero-section">
        <nav class="navbar">
            <div class="logo">STATIONERY STORE</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="index.php">Shop</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>

        <div class="hero-content" id="home">
            <h1>STATIONERY</h1>
            <p>MULTIPURPOSE STORE</p>
            <a href="index.php" class="shop-button">SHOP NOW</a>
        </div>
    </header>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="about-container">
            <h2>About Us</h2>
            <p>Welcome to Stationery Store! We are your one-stop destination for premium quality stationery products. Whether you are a student, an artist, or a working professional, we have everything you need to fuel your creativity and productivity.</p>
            <p>Our mission is to provide the best products at affordable prices, ensuring customer satisfaction with every purchase.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="contact-container">
            <h2>Contact Us</h2>
            <p>Have questions or need assistance? We're here to help!</p>
            <div class="contact-info">
                <p><strong>Email:</strong> support@stationerystore.com</p>
                <p><strong>Phone:</strong> +91 98765 43210</p>
                <p><strong>Address:</strong> 123 Stationery Lane, Creativity City, India</p>
            </div>
        </div>
    </section>

</body>
</html>
