<?php
include('../includes/db.php');
session_start();

// Enable error reporting (for debugging only)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($email) || empty($password)) {
        $error_message = "All fields are required!";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $error_message = "Email is already registered!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user';

            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password, $role]);

            $_SESSION['user_id'] = $conn->lastInsertId();
            header("Location: ../index.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Online Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(120deg, #1f4037, #99f2c8);
            background-size: 300% 300%;
            animation: gradientShift 10s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .register-container {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            color: white;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 30px;
            color: #ffffffdd;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 40px 12px 14px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
        }

        .form-group i {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            color: #ffffff88;
        }

        .register-btn {
            width: 100%;
            padding: 14px;
            background: #00c9a7;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s;
        }

        .register-btn:hover {
            background: #00b89d;
            transform: translateY(-2px);
        }

        .error-message {
            color: #ff6b6b;
            font-size: 0.95rem;
            text-align: center;
            margin-top: 15px;
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 30px 20px;
            }

            h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Create Account ✨</h2>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
                <i class="fas fa-envelope"></i>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>
            <button class="register-btn" type="submit" name="register">Register</button>
        </form>

        <?php if (isset($error_message)): ?>
            <p class="error-message"><?= htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
