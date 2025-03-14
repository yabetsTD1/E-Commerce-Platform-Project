<?php
session_start();
include 'db.php';

// Check if user is logged in
$isAdmin = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT role FROM users WHERE id='$user_id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
    $isAdmin = ($user['role'] == 'admin');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - E-Commerce</title>
    <style>
        .product {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            text-align: center;
            width: 250px;
        }
        .product img {
            width: 100px;
            height: 100px;
        }
        .admin-buttons {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Latest Products</h2>
    <?php if ($isAdmin) { ?>
        <p><a href="add_product.php">Add New Product</a></p>
    <?php } ?>
    <div>
        <?php
        $sql = "SELECT * FROM products ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>
                        <img src='{$row['image']}' alt='Product Image'>
                        <h3>{$row['name']}</h3>
                        <p>{$row['description']}</p>
                        <p>Price: $ {$row['price']}</p>";
                        
                if ($isAdmin) {
                    echo "<div class='admin-buttons'>
                            <a href='edit_product.php?id={$row['id']}'>Edit</a> |
                            <a href='delete_product.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
        
                          </div>";
                }
                

                echo "</div>";
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
    </div>
</body>
</html>
