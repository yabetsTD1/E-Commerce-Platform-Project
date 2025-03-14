<?php
session_start();
include 'db.php';

// Fetch all users from the database
$query = "SELECT firstname, lastname, username, email, phone, profile_picture FROM users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
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
        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <h2>All Registered Users</h2>
    <table>
        <tr>
            <th>Profile Picture</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
        
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td>
                <?php if ($row['profile_picture']) { ?>
                    <img src="<?php echo $row['profile_picture']; ?>" alt="Profile Picture">
                <?php } else { ?>
                    <img src="uploads/default.jpg" alt="Default Profile">
                <?php } ?>
            </td>
            <td><?php echo htmlspecialchars($row['firstname']); ?></td>
            <td><?php echo htmlspecialchars($row['lastname']); ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
        </tr>
        <?php } ?>

    </table>

</body>
</html>
