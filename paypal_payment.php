<?php
$amount = $_GET['amount'];
$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
$business_email = "your-paypal-business-email@example.com";
$return_url = "payment_success.php";
$cancel_url = "payment_cancel.php";
?>

<form action="<?php echo $paypal_url; ?>" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<?php echo $business_email; ?>">
    <input type="hidden" name="item_name" value="Order Payment">
    <input type="hidden" name="amount" value="<?php echo $amount; ?>">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="return" value="<?php echo $return_url; ?>">
    <input type="hidden" name="cancel_return" value="<?php echo $cancel_url; ?>">
    
    <input type="submit" value="Pay with PayPal">
</form>
