<?php
session_start();
include 'db.php';

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $product['name'] . "</h3>";
        echo "<img src='{$product['image']}' width = '100' height = '100' alt='Product Image'>";
        echo "<p>Price: $" . $product['price'] . "</p>";
        echo "<form action='cart.php' method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $product['id'] . "'>";
        echo "<input type='hidden' name='product_name' value='" . $product['name'] . "'>";
        echo "<input type='hidden' name='product_price' value='" . $product['price'] . "'>";
        echo "<input type='number' name='quantity' value='1' min='1'>";
        echo "<input type='submit' name='add_to_cart' value='Add to Cart'>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "No products available.";
}
$conn->close();
?>
