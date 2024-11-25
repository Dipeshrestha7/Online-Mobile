<?php 
if(isset($_GET['edit_account'])){
    $user_session_name = $_SESSION['user_username'];
    $select_query = "SELECT * 
                     from `customers`
                     where customer_name = '$user_session_name'";
    $result_query = mysqli_query($con,$select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id =$row_fetch['customer_id'];
    $user_name =$row_fetch['customer_name'];
    $user_email =$row_fetch['customer_email'];
    $user_address =$row_fetch['customer_address'];
    $user_number =$row_fetch['customer_number'];
}
        if(isset($_POST['update'])){
            $update_id = $user_id;
            $user_name =$_POST['username'];
            $user_email =$_POST['email'];
            $user_address =$_POST['address'];
            $user_number =$_POST['pnumber'];
            $user_image = $_FILES['image']['name'];
            $user_image_tmp = $_FILES['image']['tmp_name'];

            move_uploaded_file($user_image_tmp,"./user_images/$user_image");

            $update_data = "UPDATE `customers`
                            set customer_name = '$user_name', customer_email = '$user_email', customer_address = '$user_address',
                                customer_number ='$user_number', customer_image ='$user_image'
                            where customer_id =$update_id"; 
            $result_query_update = mysqli_query($con,$update_data);
            if($result_query_update){
                echo " <script>alert('Data Updated successfully')</script>";
                echo " <script>window.open('user-logout.php','_self')</script>";
            }
        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <style>

#main {
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.container {
    max-width: 600px;
    margin: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    display: block;
}

input[type="text"],
input[type="email"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="file"] {
    margin-top: 5px;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

img {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
    border-radius: 4px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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
<body id="main">
<h2>Edit Account</h2>
    <section class="signup">
        <div class="container">
            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $user_name?>" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user_email?>" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="email">Image</label>
                    <input type="file" id="image" name="image" required>
                    <img src="./user_images/<?php echo $user_image?>" alt="">
                </div>
                <div class="form-group">
                    <label for="pnumber">Phone Number:</label>
                    <input type="text" id="pnumber" name="pnumber" value="<?php echo $user_number?>" placeholder="Enter your Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $user_address?>" placeholder="Enter your Address" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="update">Update</button>
                </div>
               
            </form>
        </div>
    </section>
  
</body>
</html>