<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $tracking_number = $_POST['tracking_number'];
    $estimated_delivery = $_POST['estimated_delivery'];

    $query = $conn->prepare("UPDATE orders SET status = ?, tracking_number = ?, estimated_delivery = ? WHERE order_id = ?");
    $query->bind_param("sssi", $status, $tracking_number, $estimated_delivery, $order_id);
    
    if ($query->execute()) {
        echo "Order tracking updated successfully!";
    } else {
        echo "Error updating order tracking.";
    }
}
?>
