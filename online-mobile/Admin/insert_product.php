<?php 
include('../database/connect.php');

if(isset($_POST['insert_button'])){
    $product_name =$_POST['product_name'];
    $product_category =$_POST['product_category'];
    //accessing images
    $product_image=$_FILES['product_image']['name'];
    //accessing image temp name
    $temp_image=$_FILES['product_image']['tmp_name'];

    $product_price =$_POST['product_price'];
    
    //checking empty condition
    if ($product_name =='' or $product_category=='' or $product_image=='' or $product_price=='') {
        echo " <script> alert('Please fill all available fields')</script>";
        exit;
    } else{
        move_uploaded_file($temp_image, "./product_images/$product_image");  
        //insert query 
        $insert_product = "INSERT INTO `product_details` (`category_id`, `product_name`, `product_image`, `product_price`) VALUES 
                                            ('$product_category', '$product_name', '$product_image', '$product_price')";
        $result_query = mysqli_query($con,$insert_product);
        if ($result_query) {
            echo " <script> alert('Successfully inserted the product')</script>";
        }
        
    }

}
?>

<html>
    <head>
    <link rel="stylesheet" href="signup.css">
    <title>Insert Product -Admin Dashboard</title>


    <style>

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }


        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="file"], select {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #28a745;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        .form-group select {
            width: 100%;
        }
    </style>
    </head>

    <body>
        <h1>Insert Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="form-group">
        <Label>Product Name</Label>
        <input type="text" name="product_name" placeholder="Enter product name">
        </div> <br>
        <div class="form-group">
        <select name="product_category" >

            <option value="">Select a Category</option>
            <?php
            $selecty_query="select * from `product_category`";
            $result_query =mysqli_query($con,$selecty_query);

            while($row= mysqli_fetch_assoc($result_query)){
                $category_title=$row['category_name'];
                $category_id=$row['category_id'];
                echo "<option value='$category_id'>$category_title </option>";
            }
            
            ?> 

        </select>
        </div> <br>
        <div class="form-group">
            <label for="">Insert Image</label>
            <input type="file" name="product_image" placeholder="Product Name">
        </div><br>
        <div class="form-group">
        <label for="">Product Price</label>
        <input type="text" name="product_price" placeholder="Enter product price">
        </div><br>
        
        <button type="submit" name="insert_button" >Insert Product</button>

    </div>

</form>
    </body>
</html>