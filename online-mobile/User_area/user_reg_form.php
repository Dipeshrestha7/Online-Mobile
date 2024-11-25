<?php
 include('../database/connect.php');
 include('../function/common_function.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Mobile Mania</title>
    <link rel="stylesheet" href="user_reg_form.css">
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

    <section class="signup">
        <div class="container">
            <h2>Sign Up</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="email">Image</label>
                    <input type="file" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="pnumber">Phone Number:</label>
                    <input type="text" id="pnumber" name="pnumber" placeholder="Enter your Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" placeholder="Enter your Address" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your new password"required>
                </div>
                <div class="form-group">
                    <label for="cpassword">Conform Password:</label>
                    <input type="password" id="cpassword" name="cpassword" placeholder="Conform your password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Register</button>
                </div>
                <p>Already have an account? <a href="user_login.php">Login</a></p>
            </form>
        </div>
    </section>


    <script>
        function validateForm() {
            const password = document.getElementById('password').value;
            const cpassword = document.getElementById('cpassword').value;
            const phoneNumber = document.getElementById('pnumber').value;
            const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
            const phoneNumberRegex = /^(98|97)\d{8}$/;

            if (!passwordRegex.test(password)) {
                alert('Password must be at least 8 characters long and contain at least one letter, one number, and one special character.');
                return false;
            }

            if (password !== cpassword) {
                alert('Passwords do not match.');
                return false;
            }

            if (!phoneNumberRegex.test(phoneNumber)) {
                alert('Phone number must be exactly 10 digits long and start with 98 or 97.');
                return false;
            }

            return true;
        }
    </script>


    <footer>
    <p>&copy; 2024 Mobile Mania. All rights reserved.</p>
    </footer>

    
</body>
</html>



<!-- php code -->

<?php

if (isset($_POST['submit'])) {
    $user_username = $_POST['username'];
    $user_email = $_POST['email'];
    $user_pnumber = $_POST['pnumber'];
    $user_password = $_POST['password'];
    $user_cpassword = $_POST['cpassword'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $user_address = $_POST['address'];

    
    $user_image = $_FILES['image']['name'];
    $user_image_tmp = $_FILES['image']['tmp_name'];
    $user_ip = getIPAddress();

    // Phone number validation
    if (!preg_match('/^(98|97)\d{8}$/', $user_pnumber)) {
        echo "<script>alert('Phone number must be exactly 10 digits long and start with 98 or 97.')</script>";
        exit();
    }

    // Password validation
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $user_password)) {
        echo "<script>alert('Password must be at least 8 characters long and contain at least one letter, one number, and one special character.')</script>";
        exit();
    }

    // Check if email or phone number already exists
    $select_query = "SELECT * FROM `customers` WHERE customer_email = '$user_email' OR customer_number = '$user_pnumber'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('Email or phone number already exists.')</script>";
    } else if ($user_password != $user_cpassword) {
        echo "<script>alert('Passwords do not match.')</script>";
    } else {
        // Move uploaded file and insert into database
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "INSERT INTO `customers` (customer_name, customer_email, customer_address, customer_password, customer_number, customer_image, customer_ip) VALUES ('$user_username', '$user_email', '$user_address', '$hash_password', '$user_pnumber', '$user_image', '$user_ip')";

        $sql_execute = mysqli_query($con, $insert_query);

        if ($sql_execute) {
            echo "<script>alert('ID created successfully')</script>";
        } else {
            die(mysqli_error($con));
        }
    }

    // Selecting cart items
    $select_cart_item = "SELECT * FROM `cart_details` WHERE ip_address ='$user_ip'";
    $result_cart = mysqli_query($con, $select_cart_item);
    $rows_count = mysqli_num_rows($result_cart);

    if ($rows_count > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>alert('You have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('../products.php','_self')</script>";
    }
}

?>