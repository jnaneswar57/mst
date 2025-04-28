<?php
session_start();
include 'includes/db.php'; 

// Handle logout functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

$user_logged_in = isset($_SESSION['user_id']);
$username = "";

if ($user_logged_in) {
    // Fetch user details
    $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $username = htmlspecialchars($user['username']);
    }
}

// Fetch products from the database
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery Store</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <h1> Stationery Store</h1>
            <nav>
                <?php if ($user_logged_in) : ?>
                    <span class="welcome-text">Hello, <?= $username; ?>!</span>
                    <a href="pages/cart.php" class="cart-link">
                        <img src="images/cart-icon.png" alt="Cart" class="cart-icon">
                        Cart
                    </a>
                    <form method="POST" style="display: inline;">
                        <button type="submit" name="logout" class="logout-button">Logout</button>
                    </form>
                <?php else : ?>
                    <a href="pages/login.php">Login</a>
                    <a href="pages/register.php">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- Main Section -->
    <main class="main-container">
        <section class="product-section">
            <h2 class="section-title">Our Products</h2>
            <div class="product-list">
                <?php if (empty($products)) : ?>
                    <p>No products available.</p>
                <?php else : ?>
                    <?php foreach ($products as $product) : ?>
                        <div class="product-card">
                            <?php if (!empty($product['image'])) : ?>
                                <img src="images/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="product-image">
                            <?php endif; ?>
                            <h3 class="product-name"><?= htmlspecialchars($product['name']); ?></h3>
                            <p class="product-description"><?= htmlspecialchars($product['description']); ?></p>
                            <p class="product-price">$<?= number_format($product['price'], 2); ?></p>
                            <form method="POST" action="pages/cart.php">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <button type="submit" name="add_to_cart" class="add-to-cart-button">Add to Cart</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date('Y'); ?> Stationery Store. All rights reserved.</p>
    </footer>
</body>
</html>
