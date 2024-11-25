<?php
include('../database/connect.php');
session_start();

if (isset($_SESSION['admin_username'])) {
    echo "<script>window.open('admin.php','_self')</script>";
}

if (isset($_POST['submit'])) {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    $select_query = "SELECT * FROM `admin` WHERE admin_name = '$admin_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if ($row_count > 0) {
        if (password_verify($admin_password, $row_data['admin_password'])) {
            $_SESSION['admin_username'] = $admin_username;
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('admin.php','_self')</script>";
        } else {
            echo "<script>alert('Incorrect Password')</script>";
        }
    } else {
        echo "<script>alert('Incorrect Username')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>

        .login{
            margin: 40px 20px;
        }
         body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group button[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .form-group button[type="submit"]:hover {
            background-color: #555;
        }
        p {
            text-align: center;
            margin-top: 10px;
        }
        p a {
            color: #333;
            text-decoration: none;
        }
        p a:hover {
            text-decoration: underline;
        }
        footer {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body id="main">
    <section class="login">
        <div class="container">
            <h2>Admin Login</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="admin_username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="admin_password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Login</button>
                </div>
            </form>
            <p>Don't have an account? <a href="admin_reg_form.php">Register</a></p>
        </div>
    </section>
    <footer>
    <p>&copy; 2024 Mobile Mania. All rights reserved.</p>
    </footer>
</body>
</html>
