<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../../controllers/ProductController.php';

if (isset($_GET['id'])) {
    ProductController::deleteProduct($_GET['id']);
    header('Location: list.php');
    exit;
}
?>