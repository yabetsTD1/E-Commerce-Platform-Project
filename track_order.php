<?php
session_start();
include 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = $_GET['order_id'] ?? '';

if (!$order_id) {
    echo "Invalid order ID.";
    exit();
}

// Fetch order status
$query = $conn->prepare("SELECT order_id, status, tracking_number, estimated_delivery FROM orders WHERE order_id = ? AND user_id = ?");
$query->bind_param("ii", $order_id, $user_id);
$query->execute();
$result = $query->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    echo "Order not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order</title>
</head>
<body>

    <h2>Track Your Order</h2>

    <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['order_id']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
    <p><strong>Tracking Number:</strong> <?php echo htmlspecialchars($order['tracking_number']); ?></p>
    <p><strong>Estimated Delivery:</strong> <?php echo htmlspecialchars($order['estimated_delivery']); ?></p>

</body>
</html>
