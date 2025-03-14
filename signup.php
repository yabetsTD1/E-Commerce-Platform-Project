<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sex = $_POST['sex'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Handle file upload
    $profile_picture = "";
    if ($_FILES['profile_picture']['name']) {
        $target_dir = "uploads/";
        $profile_picture = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profile_picture);
    }

    $sql = "INSERT INTO users (firstname, lastname, username, email, phone, sex, profile_picture, password) 
            VALUES ('$firstname', '$lastname', '$username', '$email', '$phone', '$sex', '$profile_picture', '$password')";

    if ($conn->query($sql)) {
        header("location: login.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form id="signup" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="firstname" placeholder="First Name" required><br>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="lastname" placeholder="Last Name" required><br>
            </div>
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" name="username" placeholder="Username" required><br>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" required><br>
            </div>
            <div class="form-group">
                <label for="Phone">
                    <input type="text" name="phone" placeholder="Phone" required><br>
                </label>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="sex" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select><br>
            </div>
            <div class="form-group">
                <label for="profile_pic">Profile Picture</label>
                <input type="file" name="profile_picture" required><br>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required><br>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" required>
            </div>
            <div class="form-group">
                <button type="submit">Sign Up</button>
            </div>


        </form>
    </div>
    <script src="validation.js"></script>
</body>

</html>