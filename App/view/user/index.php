<?php
session_start(); 
require_once(__DIR__ . '../../../config/config.php');

if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('User not logged in.');
            window.location.href = '../login.php';
        </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    im user role
     <a href="logout.php">logout</a>
</body>
</html>