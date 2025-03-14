<?php
session_start();
include 'db.php';

// Check if user is admin
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT role FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($user['role'] != 'admin') {
    echo "Access denied. Only admins can delete products.";
    exit();
}

// Delete product
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product image to delete it from the server
    $sql = "SELECT image FROM products WHERE id='$product_id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
    if ($product['image']) {
        unlink($product['image']); // Delete image file
    }

    // Delete from database
    $sql = "DELETE FROM products WHERE id='$product_id'";
    if ($conn->query($sql)) {
        echo "Product deleted successfully. <a href='home.php'>View Products</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
