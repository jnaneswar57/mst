<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        h2 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 30px;
            font-weight: bold;
        }
        nav {
            display: flex;
            justify-content: space-around;
            gap: 30px;
            margin-top: 40px;
        }
        nav a {
            text-decoration: none;
            padding: 15px 30px;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        nav a:hover {
            background-color: #45a049;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }
        .logout {
            background-color: #f44336;
        }
        .logout:hover {
            background-color: #e53935;
        }
        footer {
            text-align: center;
            margin-top: 60px;
            font-size: 14px;
            color: #777;
        }
        footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Admin Dashboard</h2>
        <nav>
            <a href="add_product.php">Add Product</a>
            <a href="manage_products.php">Manage Products</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
    </div>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Admin Dashboard | <a href="terms.php">Terms & Conditions</a></p>
    </footer>
</body>
</html>
