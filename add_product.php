
<?php
session_start();
include 'db.php';
// Ensure only logged-in users (admin) can add products
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $image = "";
    if ($_FILES['image']['name']) {
        $target_dir = "uploads/";
        $image = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    }

    $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
    if ($conn->query($sql)) {
        echo "Product added successfully. <a href='home.php'>View Products</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h2>Add a New Product</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required><br>
        <textarea name="description" placeholder="Product Description" required></textarea><br>
        <input type="number" name="price" placeholder="Price" step="0.01" required><br>
        <input type="file" name="image" required><br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
