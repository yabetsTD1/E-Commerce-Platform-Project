<?php
session_start();
include 'db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$query = $conn->prepare("SELECT firstname, lastname, username, email, phone, profile_picture FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        form {
            max-width: 400px;
            margin: auto;
        }
        img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h2>Your Profile</h2>
    
    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
        <img src="uploads/<?php echo $user['profile_picture'] ?: 'default.jpg'; ?>" alt="Profile Picture">
        <input type="file" name="profile_picture"><br>

        <label>First Name:</label>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['firstname']); ?>" readonly><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['lastname']); ?>" readonly><br>

        <label>Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required><br>

        <input type="submit" value="Update Profile">
    </form>

</body>
</html>
