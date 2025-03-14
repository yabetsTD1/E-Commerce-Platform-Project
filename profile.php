<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
        .container {
    width: 40%;
    margin: 5em auto;
    padding: 2em;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}
    </style>
</head>
<body>
    <div class="container">
    <h2>Welcome, <?php echo $user['firstname'] . " " . $user['lastname']; ?></h2>
    <img src="<?php echo $user['profile_picture']; ?>" width="100" height="100" alt="Profile Picture">
    <p>Username: <?php echo $user['username']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Phone: <?php echo $user['phone']; ?></p>
    <p>Sex: <?php echo $user['sex']; ?></p>
    <p><a href="change_profile.php">Account Manage</a></p>
</div>
</body>
</html>
