<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>
            body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

h3 {
    text-align: center;
    margin-top: 20px;
    color: #333;
}

.container {
    max-width: 400px;
    margin: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

input[type="submit"] {
    background-color: #f44336;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    margin-bottom: 10px;
}

input[type="submit"]:hover {
    background-color: #da190b;
}

.input-dont-delete {
    background-color: #4CAF50;
    color: white;
}

.input-dont-delete:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <h3>Delete Your Account</h3>
    <div class="delete">
        <div class="container">
            <form action="" method="post">
                <div class="form-group">
                    <input type="submit" name="delete" value="Delete Account">
                </div>

                <div class="form-group">
                    <input type="submit" name="dont_delete" value="Don't Delete Account">
                </div>
            </form>
        </div>
    </div>

    <?php
        $username_session= $_SESSION['user_username'];
        if(isset($_POST['delete'])){
            $delete_query = "DELETE
                             FROM `customers`
                             where customer_name = '$username_session' ";
            $result = mysqli_query($con,$delete_query);
            if($result){
                session_destroy();
                echo "<script> alert('Account Deleted successfully')</script>";
                echo "<script>window.open('../products.php','_self')</script>";
            }
        }

        if(isset($_POST['dont_delete'])){
                echo "<script>window.open('profile.php','_self')</script>";
        }
    ?>
</body>
</html>