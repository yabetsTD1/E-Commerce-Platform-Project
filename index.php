<?php
   session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Platform</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f3f4f6;
            color: #333;
        }

        header {
            background: linear-gradient(90deg, #4CAF50, #45a049);
            padding: 10px 20px;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        header nav ul li {
            display: inline;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        header nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        iframe {
            width: 100%;
            height: 80vh;
            border: none;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
        }

        footer p {
            margin: 5px 0;
        }

        footer p:first-child {
            font-weight: bold;
        }

        footer p:last-child {
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>E-Commerce Platform</h1>
        <nav>
            <ul>
                <li><a href="home.php" target="content-frame">Home</a></li>
                <li><a href="products.php" target="content-frame">Products</a></li>
                <li><a href="view_cart.php" target="content-frame">View Carts</a></li>
                <li><a href="profile.php" target="content-frame">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Content Area with Iframe -->
    <main>
        <iframe name="content-frame" src="home.php"></iframe>
    </main>

    <!-- Footer -->
    <footer>
        <p>Contact Us: yabetstinsae@gmail.com | Phone: +251 912 9973 90</p>
        <p>&copy; <?php echo date("Y"); ?> E-Commerce Platform. All rights reserved.</p>
    </footer>

</body>
</html>
