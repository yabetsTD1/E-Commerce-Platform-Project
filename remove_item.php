<?php
session_start();

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    unset($_SESSION['cart'][$product_id]); // Remove product from cart
}

header("Location: view_cart.php");
exit();
?>
