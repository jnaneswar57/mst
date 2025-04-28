<?php
session_start();
include '../includes/db.php';

// Ensure admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Check if product ID is provided
if (!isset($_GET['id'])) {
    die("Invalid product ID.");
}

$product_id = $_GET['id'];

// Fetch product details
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Update product details
    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?");
    $stmt->execute([$name, $price, $description, $product_id]);

    // Redirect to manage products page
    header("Location: manage_products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']); ?>" required><br>

        <label>Price:</label>
        <input type="number" name="price" value="<?= htmlspecialchars($product['price']); ?>" required><br>

        <label>Description:</label>
        <textarea name="description" required><?= htmlspecialchars($product['description']); ?></textarea><br>

        <button type="submit">Update Product</button>
    </form>
</body>
</html>
