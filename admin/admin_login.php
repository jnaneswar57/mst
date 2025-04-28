<?php
include '../includes/db.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email belongs to an admin
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Start admin session and redirect to dashboard
        $_SESSION['admin_id'] = $user['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Invalid credentials or not an admin.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color:rgb(247, 202, 202);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
        }
        .login-container {
            width: 100%;
            max-width: 450px;
            background-color:rgb(158, 191, 140);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.98); }
            to { opacity: 1; transform: scale(1); }
        }
        h2 {
            font-size: 1.8rem;
            margin-bottom: 30px;
            color: #333;
        }
        label {
            font-weight: 600;
            color: #555;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border-radius: 6px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            font-size: 1rem;
            background-color: #f9f9f9;
            color: #333;
            transition: border 0.3s ease;
        }
        input:focus {
            border-color: #5cb85c;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #218838;
        }
        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 20px;
            padding: 10px;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            border-radius: 6px;
        }
        .forgot-password {
            display: block;
            margin-top: 15px;
            font-size: 0.9rem;
            color: #007bff;
            text-decoration: none;
        }
        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Admin Login</h2>

        <!-- Display error message if any -->
        <?php if (isset($error_message)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Enter your email">
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="Enter your password">
            </div>

            <button type="submit" name="login">Login</button>
        </form>

        <a href="#" class="forgot-password">Forgot password?</a>
    </div>

</body>
</html>
