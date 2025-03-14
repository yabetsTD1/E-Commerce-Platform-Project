<?php
session_start();
include 'db.php';

// Check if user is admin
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT role FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($user['role'] != 'admin') {
    echo "Access denied. Only admins can edit products.";
    exit();
}

// Fetch product details
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id='$product_id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $product['image']; // Default to old image

    // Handle new image upload
    if ($_FILES['image']['name']) {
        $target_dir = "uploads/";
        $image = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    }

    // Update product details
    $sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$image' WHERE id='$product_id'";
    if ($conn->query($sql)) {
        echo "Product updated successfully. <a href='home.php'>View Products</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>
        <textarea name="description" required><?php echo $product['description']; ?></textarea><br>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" step="0.01" required><br>
        <p>Current Image:</p>
        <img src="<?php echo $product['image']; ?>" width="100"><br>
        <input type="file" name="image"><br>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
