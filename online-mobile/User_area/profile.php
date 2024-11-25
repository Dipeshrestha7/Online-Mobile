<?php
include '../database/connect.php';
include '../function/common_function.php';
session_start();

if (!isset($_SESSION['user_username'])) {
    echo "<script>window.open('user_login.php','_self')</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['user_username'];?></title>
    <link rel="stylesheet" href="../products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
               integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
               crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
          /* Reset default margin and padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styles */
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f0f0f0;
}

/* Header styles */
header {
    background-color: #333;
    color: #fff;
    padding: 10px 0;
    text-align: center;
}

.logo {
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo a {
    display: inline-block;
    margin-right: 10px;
}

.logo h1 {
    font-size: 1.5rem;
    font-weight: bold;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align: center;
}

nav ul li {
    display: inline-block;
    margin-right: 20px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 1rem;
}

nav ul li a:hover {
    text-decoration: underline;
}

/* Container styles */
.container {
    display: flex;
    justify-content: space-between;
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.profile ul {
    list-style-type: none;
    padding: 0;
}

.profile ul li {
    margin-bottom: 10px;
}

.profile img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #333;
}

.profile h3 {
    font-size: 1.5rem;
    margin-top: 10px;
    text-align: center;
}

.describe {
    flex: 1;
    margin-left: 20px;
}

.describe ul {
    list-style-type: none;
}

.describe ul li {
    margin-bottom: 10px;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 5px;
}

.describe ul li a {
    text-decoration: none;
    color: #333;
}

.describe ul li a:hover {
    text-decoration: underline;
}

/* Footer styles */
.footer {
    text-align: center;
    margin-top: 20px;
    padding: 10px;
    background-color: #333;
    color: #fff;
    width: 100%;
}

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Mobile Mania</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a></li>
                <li><a href="../home.php">Home</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="../services.php">Services</a></li>
                <li><a href="../products.php">Products</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="profile">
            <ul>
                <?php 
                $username = $_SESSION['user_username'];
                $user_image_query = "SELECT * 
                                     FROM `customers`
                                     WHERE customer_name = '$username'";
                $result_image = mysqli_query($con, $user_image_query);
                $row_image = mysqli_fetch_array($result_image);
                $user_image = $row_image['customer_image'];
                ?>
                <li><img src="./user_images/<?php echo $user_image; ?>" alt=""></li>
                <li><h3><?php echo $username; ?></h3></li>
                <li><a href="profile.php">Pending Orders</a></li>
                <li><a href="profile.php?edit_account">Edit Account</a></li>
                <li><a href="profile.php?my_orders">My Orders</a></li>
                <li><a href="profile.php?delete_account">Delete Account</a></li>
                <li><a href="user_logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="describe">
            <ul>
                <li>
                    <?php 
                    get_order_details();
                    
                    if(isset($_GET['edit_account'])) {
                        include('edit_account.php');
                    }
                    if(isset($_GET['my_orders'])) {
                        include('my_orders.php');
                    }
                    if(isset($_GET['delete_account'])) {
                        include('delete_account.php');
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Mobile Mania. All rights reserved.</p>
    </footer>
</body>
</html>
