<?php
function checkPaymentStatus($transaction_id) {
    $api_url = "https://api.paymentgateway.com/status"; // Replace with actual URL
    $data = ['transaction_id' => $transaction_id];

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    return json_decode(curl_exec($ch), true);
}
?>
