<?php
session_start();
echo "Thank you! Your payment was successful.";
$_SESSION['cart'] = []; // Clear cart after successful payment
?>
