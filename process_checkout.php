<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pay_now'])) {
    $payment_method = $_POST['payment_method'];
    $phone_number = $_POST['phone_number'] ?? null;
    $amount = $_POST['amount'];

    if ($payment_method == "paypal") {
        header("Location: paypal_payment.php?amount=$amount");
        exit();
    } elseif ($payment_method == "telebirr") {
        $response = processTelebirrPayment($phone_number, $amount);
    } elseif ($payment_method == "cbebirr") {
        $response = processCbeBirrPayment($phone_number, $amount);
    }

    if (isset($response) && $response['status'] == "success") {
        echo "Payment Successful! Order Placed.";
        $_SESSION['cart'] = []; // Clear cart after successful payment
    } else {
        echo "Payment Failed: " . ($response['message'] ?? 'Unknown error');
    }
}

function processTelebirrPayment($phone, $amount) {
    $api_url = "https://api.telebirr.com/payment"; // Replace with actual API URL
    $data = [
        'phone' => $phone,
        'amount' => $amount,
        'merchant_id' => 'your_merchant_id',
        'transaction_id' => uniqid()
    ];

    return sendPaymentRequest($api_url, $data);
}

function processCbeBirrPayment($phone, $amount) {
    $api_url = "https://api.cbebirr.com/payment"; // Replace with actual API URL
    $data = [
        'phone' => $phone,
        'amount' => $amount,
        'merchant_id' => 'your_merchant_id',
        'transaction_id' => uniqid()
    ];

    return sendPaymentRequest($api_url, $data);
}

function sendPaymentRequest($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    return json_decode($response, true);
}
?>
