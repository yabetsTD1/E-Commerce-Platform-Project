<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['quantity'] as $id => $qty) {
        if ($qty > 0) {
            $_SESSION['cart'][$id]['quantity'] = $qty;
        } else {
            unset($_SESSION['cart'][$id]); // Remove if quantity is 0
        }
    }
}

header("Location: view_cart.php");
exit();
?>
