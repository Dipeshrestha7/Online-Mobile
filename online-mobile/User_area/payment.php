<?php
    include '../database/connect.php';
    include '../function/common_function.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Mobile Mania</title>
    <link rel="stylesheet" href="../products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body >
    <?php 
    $user_ip = getIPAddress();
    $get_user = "SELECT *
                 from `customers`
                 where customer_ip = '$user_ip'";
    $result = mysqli_query($con,$get_user);
    $run_query = mysqli_fetch_array($result);
    $user_id = $run_query['customer_id'];
    ?>

    <header>
        <nav>
            <div class="logo">
                <a href="home.php"><img src="../images/Logo.jpeg" alt="Startup Company Logo"></a>
                <h1>Cloth Craze</h1>
            </div>
            <ul>
                <li><a href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php  cart_item();  ?></sup></a></li>
                <li><a href="../home.php">Home</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="../services.php">Services</a></li>
                <li><a href="../products.php">Product</a></li>                
            </ul>
        </nav>
        
    </header>
    <div class="customer">
            <?php 
                if(!isset($_SESSION['user_username'])){
                    echo " 
                        <div class='user'>
                            <a href='user_login.php'>Log In</a>
                            <a href='user_reg_form.php'>Sign Up</a>
                            <a href=''>Welcome Guest</a>
                        </div>";
                }else{
                    echo "
                        <div class='user'>
                            <a href='profile.php'>Welcome ".$_SESSION['user_username']."</a>
                            <a href='user_logout.php'>Logout</a>
                        </div>";
                }            
            ?>    
    </div>

    <main>
          <a href="order.php?customer_id=<?php echo $user_id;?>"><h2>PAY OFFLINE</h2></a>
    </main>

</body>
</html>

    <!-- callinf cart function  -->
    <?php
        cart();
    ?>