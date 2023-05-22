<?php 
session_start();
unset($_SESSION['username']);
header('location:login.php');
session_destroy();

// header('location: login.php');
?>