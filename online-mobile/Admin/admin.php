<?php
include '../database/connect.php';
session_start();

if (!isset($_SESSION['admin_username'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-<?php echo $_SESSION['admin_username'];?></title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- headinh -->
    <div class="heading">
        <h1>Manage Details</h1>
    </div>

    <div class="conatainerCRUD">
        <!-- admin -->
        <div class="container2">
            <?php 
                    if (isset($_SESSION['admin_username'])) {
                        $username=$_SESSION['admin_username'];
                        $admin_image = "SELECT * 
                                from `admin`
                                where admin_name ='$username'";

                    $result_image = mysqli_query($con,$admin_image);
                    $row_image = mysqli_fetch_array($result_image);
                    $admin_image=$row_image['admin_image'];

                    echo "<a  href=''><img src='./admin_images/$admin_image' alt=''></a>";
                    echo "<p id='adminName'><strong>$username</strong></p>";
                    }
                    else{
                        echo "<a  href=''><img src='../images/Noprofile.jpg' alt=''></a>";
                        echo "<p id='adminName'>Username</p>";
                    }

            ?>           
        </div>
    </div>
    
    <div class="container4">
            <!-- CRUD btn -->
            <div class="btn">
            <button class="submit" ><a href="admin.php?Insert_Categories">Insert Categories</a></button>
            <button class="submit"><a href="admin.php?view_categories">View Categories</a></button>
            <button class="submit"><a href="admin.php?insert_product">Insert Product</a></button>
            <button class="submit"><a href="admin.php?view_products">View Product</a></button>       
            <button class="submit"><a href="admin.php?all_order">All Order</a></button>
            <button class="submit"><a href="admin.php?all_payment">All Payment</a></button>
            <button class="submit"><a href="admin.php?list_users">List Users</a></button>
            <button class="submit"><a href="admin_logout.php">Log Out</a></button>
        </div>

    

        <div class="container3">
            <?php 
            if(isset($_GET['Insert_Categories'])){
                include('Insert_Categories.php');
            }

            if(isset($_GET['view_categories'])){
                include('view_categories.php');
            }

            if(isset($_GET['edit_categories'])){
                include('edit_categories.php');
            }

            if(isset($_GET['delete_categories'])){
                include('delete_categories.php');
            }

            if(isset($_GET['insert_product'])){
                include('insert_product.php');
            }
            
            if(isset($_GET['view_products'])){
                include('view_products.php');
            }

            if(isset($_GET['edit_products'])){
                include('edit_products.php');
            }

            if(isset($_GET['delete_products'])){
                include('delete_products.php');
            }

            if(isset($_GET['all_order'])){
                include('all_order.php');
            }

            if(isset($_GET['delete_order'])){
                include('delete_order.php');
            }

            if(isset($_GET['all_payment'])){
                include('all_payment.php');
            }

            if(isset($_GET['delete_payment'])){
                include('delete_payment.php');
            }

            if(isset($_GET['list_users'])){
                include('list_users.php');
            }

            if(isset($_GET['delete_user'])){
                include('delete_user.php');
            }
    
            ?>
        </div>
    </div>
    
</body>
</html>