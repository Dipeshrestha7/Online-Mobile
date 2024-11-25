<?php
include './database/connect.php';
include './function/common_function.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - <?PHP echo $_SESSION['user_username'];?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo h1 {
            font-size: 1.5rem;
            margin-left: 10px;
        }
        nav ul {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            margin-left: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            display: inline-block;
        }
        nav ul li a:hover {
            background-color: #555;
        }
        .customer {
            background-color: #f0f0f0;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user {
            display: flex;
            align-items: center;
        }
        .user a {
            color: #333;
            text-decoration: none;
            padding: 5px 10px;
            display: inline-block;
        }
        .user a:hover {
            background-color: #ddd;
        }
        .container {
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table td img {
            width: 100px;
            height: 100px;
        }
        table th {
            background-color: #f2f2f2;
        }
        .submit {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .submit:hover {
            background-color: #555;
        }
        .submit a{
            color: #fff;
            text-decoration: none;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Mobile Mania</h1>
            </div>
            <ul>
                <li><a href=""><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="products.php">Product</a></li>
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

    <div class="container">
        <!-- <h2>Total Price: <?php total_cart_price()?></h2> -->
        <form action="" method="post">
            <?php 
            global $con;
            $get_ip_address = getIPAddress();
            $cart_query = "SELECT *
                           FROM `cart_details` 
                           WHERE ip_address = '$get_ip_address'";
            $result = mysqli_query($con, $cart_query);
            $result_count = mysqli_num_rows($result);
            
            if($result_count > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Remove</th>
                                <th colspan='2'>Operations</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($row = mysqli_fetch_array($result)) {
                    $product_id = $row['product_id'];
                    $select_product = "SELECT *
                                       FROM `product_details`
                                       WHERE product_id = $product_id ";
                    $result_product = mysqli_query($con, $select_product);
                    
                    while ($row_product_price = mysqli_fetch_array($result_product)) {
                        $product_price = $row_product_price['product_price'];
                        $product_name = $row_product_price['product_name'];
                        $product_image = $row_product_price['product_image'];
                ?>
                    <tr>
                        <td><?php echo $product_name ?></td>
                        <td><img src="./Admin/product_images/<?php echo $product_image ?>" alt=""></td>
                        <td><input type="text" name="qty" class="qty-input" value="<?php echo $row['quantity']; ?>"></td>
                        <td><?php echo $product_price ?>/-</td>
                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                        <td>
                            <input type="submit" class="submit" value="Update Cart" name="Update_Cart">
                            <input type="submit" class="submit" value="Remove Cart" name="Remove_Cart">
                        </td>
                    </tr>
                <?php
                    }  
                }
                echo "</tbody></table>";

                echo "<div>";
                if($result_count > 0) {
                    echo "<input type='submit' class='submit' value='Continue Shopping' name='continue_shopping'>
                          <button class='submit'><a href='./User_area/checkout.php'>Checkout</a></button>";
                } else {
                    echo "<input type='submit' class='submit' value='Continue Shopping' name='continue_shopping'>";
                }
                echo "</div>";
            } else {
                echo "<h2>Cart is empty</h2>";
            }
            ?>
        </form>
    </div>

    <?php 
    function remove_cart_item() {
        global $con;

        if(isset($_POST['Remove_Cart'])) {
            foreach ($_POST['removeitem'] as $remove_id) {
                $delete_query = "DELETE FROM `cart_details`
                                 WHERE product_id = $remove_id";
                
                $run_delete = mysqli_query($con, $delete_query);
                if ($run_delete) {
                    echo "<script> window.open('cart.php', '_self')</script>";
                }
            }
        }
    } 
    remove_cart_item();
    ?>

    <!-- <footer>
    <p>&copy; 2024 Mobile Mania. All rights reserved.</p>
    </footer> -->
    
</body>
</html>
