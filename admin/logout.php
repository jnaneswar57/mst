<?php
session_start();
session_destroy(); // Destroy all sessions
header("Location: admin_login.php"); // Redirect to admin login page
exit();
?>
