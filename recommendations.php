<?php
session_start();
include 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch previously ordered product categories
$query = $conn->prepare("
    SELECT DISTINCT p.category 
    FROM orders o 
    JOIN order_items oi ON o.order_id = oi.order_id 
    JOIN products p ON oi.product_id = p.id 
    WHERE o.user_id = ? 
    LIMIT 3
");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row['category'];
}

// Fetch recommended products
if (!empty($categories)) {
    $category_list = "'" . implode("','", $categories) . "'";
    $recommend_query = "
        SELECT * FROM products 
        WHERE category IN ($category_list) 
        ORDER BY RAND() 
        LIMIT 5
    ";
    $recommend_result = $conn->query($recommend_query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Products</title>
</head>
<body>

    <h2>Recommended Products for You</h2>

    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <?php while ($product = $recommend_result->fetch_assoc()) { ?>
            <div style="border: 1px solid #ccc; padding: 10px; width: 200px;">
                <img src="uploads/<?php echo $product['image']; ?>" alt="Product Image" width="100%">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p>$<?php echo number_format($product['price'], 2); ?></p>
                <a href="product.php?id=<?php echo $product['id']; ?>">View Product</a>
            </div>
        <?php } ?>
    </div>

</body>
</html>
