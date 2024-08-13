<?php
include 'config.php'; 
session_name("AdminSession");

session_start(); 



setcookie('admins_name' ,$_SESSION['admins_name'],60); 
session_unset();
session_destroy();
header("Location: admin_login.php");
exit;
?>