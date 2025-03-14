<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Handle Profile Picture Upload
    if (!empty($_FILES["profile_picture"]["name"])) {
        $profile_picture = time() . "_" . $_FILES["profile_picture"]["name"];
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], "uploads/" . $profile_picture);

        // Update profile picture in database
        $query = $conn->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
        $query->bind_param("si", $profile_picture, $user_id);
        $query->execute();
    }

    // Update user details in database
    $query = $conn->prepare("UPDATE users SET username = ?, email = ?, phone = ? WHERE id = ?");
    $query->bind_param("sssi", $username, $email, $phone, $user_id);
    $query->execute();

    echo "Profile updated successfully!";
    header("Location: profile.php");
}
?>
