<?php
 include('../database/connect.php');
 include('../function/common_function.php');
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mobile Mania</title>
    <link rel="stylesheet" href="user_login.css">
</head>
<body id="main">
    <header>
        <nav>
            <div class="logo">
                <h1>Mobile Mania</h1>
            </div>
            <ul>
                <li><a href="../home.php">Home</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="../services.php">Services</a></li>
                <li><a href="../products.php">Products</a></li>
            </ul>
        </nav>
    </header>

    <section class="login">
        <div class="container">
            <h2>Login</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="user_username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="user_password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Login</button>
                </div>
            </form>
            <p>Don't have an account? <a href="./user_reg_form.php">Register</a></p>
        </div>
    </section>
    

    <footer>
    <p>&copy; 2024 Mobile Mania. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
if(isset($_POST['submit'])){
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    $select_query = "SELECT *
                     from `customers` where customer_name = '$user_username'";

    $result= mysqli_query($con,$select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();

    //cart item
    $select_query_cart= "SELECT *
                     from `cart_details` where  ip_address = '$user_ip'";
    $select_cart = mysqli_query($con,$select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);

    if($row_count>0) {
        $_SESSION['user_username']= $user_username;
        if(password_verify($user_password,$row_data['customer_password'])) {
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['user_username'] = $user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            }else{
                $_SESSION['user_username'] = $user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        }
        else{
            echo "<script>alert('Incorrect Password')</script>";
        }
    }else{
        echo "<script>alert('Incorrect Username')</script>";
    }
}
?>