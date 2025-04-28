<?php
$host = 'localhost';
$dbname = 'ecommerce';
$user = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=127.0.0.1;port=3306;dbname=ecommerce", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>