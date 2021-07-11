<?php
    // require_once "includes/header.php";
    // $query = mysqli_query($con, "SELECT * FROM products");
    // while($row = mysqli_fetch_array($query)){
    //     echo $row['name'] ."<br>";
    //     echo $row['price'] ."<br>";
    //     echo $row['image'] ."<br>";
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h4>Shoppee</h4>
        </div>
        <ul class="nav-links">
            <!-- <li><a href="index.html">Home</a></li> -->
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="register.php">Login</a></li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>
    <div class="portfolio">
        <!-- <img src="assets/images/beautiful.jpg" alt=""> -->
        <a href='home.php'><button>Shop</button></a>
    </div>
    <script src="assets/js/app.js"></script>
</body>
</html>