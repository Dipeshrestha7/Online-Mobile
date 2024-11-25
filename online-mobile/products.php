<!-- <?php
include './database/connect.php';
include 'function/common_function.php';
session_start();
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Mobile Mania</title>
    <link rel="stylesheet" href="products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Mobile Mania</h1>
            </div>
            <ul>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php  cart_item();  ?></sup></a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="products.php">Products</a></li>
            </ul>
        </nav>
    </header>

    <div class="customer">
        <?php 
        if(!isset($_SESSION['user_username'])){
            echo " 
                <div class='user'>
                    <a href='./User_area/user_login.php'>Log In</a>
                    <a href='./User_area/user_reg_form.php'>Sign Up</a>
                    <a href=''>Welcome Guest</a>
                </div>";
        } else {
            echo "<div class='user'>
                    <a href='./User_area/profile.php'>Welcome ".$_SESSION['user_username']."</a>
                    <a href='./User_area/user_logout.php'>Logout</a>
                </div>";
        }
        ?>    
    </div>

    <!-- Call the cart function -->
    <?php
    cart();
    ?>

    <section id="search" class="search">
        <div class="search-container">
            <input type="text" id="myInput" placeholder="Search..." onkeyup="searchProducts()">
            <button onclick="searchButton()">Search</button>
        </div>
    </section>

    <section id="products" class="products">
        <h1>Mobile Brands</h1> 
        <div class="pCategory" id="pCategory">
            <?php
            getProductCategory();
            ?>
        </div>
        
        <div class="pdetails" id="pdetails">
            <!-- Fetching products -->
            <?php
            getProductDetails();
            getUniqueProduct();
            ?>
        </div>
    </section>
    
    <footer>
        <p>&copy; 2024 Mobile Mania. All rights reserved.</p>
    </footer>

    <script src="products.js"></script>
</body>
</html>
