<?php
include '../includes/db.php'; // database connection

header('Content-Type: application/json');

$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products);
?>
