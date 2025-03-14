<?php
session_start();
include 'db.php';

if (empty($_SESSION['cart'])) {
    echo "Your cart is empty. <a href='products.php'>Go Shopping</a>";
    exit();
}

$total = 0;
foreach ($_SESSION['cart'] as $id => $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<h2>Checkout</h2>
<p>Total Amount: <strong><?php echo $total; ?> Birr</strong></p>

<form action="process_checkout.php" method="POST">
    <label>Select Payment Method:</label><br>
    <input type="radio" name="payment_method" value="paypal" required> PayPal <br>
    <input type="radio" name="payment_method" value="telebirr" required> Telebirr <br>
    <input type="radio" name="payment_method" value="cbebirr" required> CbeBirr <br>
    
    <label>Enter Your Phone Number (for Telebirr/CbeBirr):</label>
    <input type="text" name="phone_number">

    <input type="hidden" name="amount" value="<?php echo $total; ?>">
    
    <br><br>
    <input type="submit" name="pay_now" value="Proceed to Pay">
</form>
