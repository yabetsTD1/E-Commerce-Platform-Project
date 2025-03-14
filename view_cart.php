<?php
session_start();
echo "<h2>Shopping Cart</h2>";

if (!empty($_SESSION['cart'])) {
    echo "<form action='update_cart.php' method='POST'>";
    echo "<table border='1'>";
    echo "<tr><th>Product</th><th>Price(Birr)</th><th>Quantity</th><th>Total(Birr)</th><th>Action</th></tr>";

    $total = 0;
    foreach ($_SESSION['cart'] as $id => $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
        
        echo "<tr>";
        echo "<td>{$item['name']}</td>";
        echo "<td>{$item['price']}</td>";
        echo "<td><input type='number' name='quantity[$id]' value='{$item['quantity']}' min='1'></td>";
        echo "<td>$subtotal</td>";
        echo "<td><a href='remove_item.php?id=$id'>Remove</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<p><strong>Total: $total Birr</strong></p>";
    echo "<input type='submit' value='Update Cart'>";
    echo "</form>";
    echo "<a href='checkout.php'>Proceed to Checkout</a>";
} else {
    echo "Your cart is empty.";
}
?>
