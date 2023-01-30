<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['name']);
unset($_SESSION['role']);
header("location: index.php");
?>
