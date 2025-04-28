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

// Delete product
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$product_id]);

// Redirect back to manage products
header("Location: manage_products.php");
exit();
?>
