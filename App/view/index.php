<?php
session_start(); 
require_once(__DIR__ . '../../config/config.php');

if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('User not logged in.');
            window.location.href = '../login.php';
        </script>";
    exit();
}
?>
<div>
<?php include "../model/header.php";?>
<h1> this admin role </h1>  
</div>