<?php
session_start();
include 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch order history
$query = $conn->prepare("SELECT order_id, total_amount, status, created_at FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Your Order History</h2>
    
    <table>
        <tr>
            <th>Order ID</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
        
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['order_id']); ?></td>
            <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
        </tr>
        <?php } ?>

    </table>

</body>
</html>
