<?php
include('../database/connect.php');

if(isset($_POST['insert_cat'])){
    $category_name = $_POST['cat_name'];

    // accessing image
    $category_image = $_FILES['cat_image']['name'];

    //accessing image temp name
    $temp_image = $_FILES['cat_image']['tmp_name'];

    //checking empty
    if ($category_name==='' or $category_image==='') {
        echo " <script> alert('Please fill all available fields')</script>";
        exit;
    }
    else{
        //select data from database
        move_uploaded_file($temp_image, "./product_images/$category_image");
        $select_query ="Select * 
                        from product_category
                        where category_name = '$category_name'";
        $result_select= mysqli_query($con,$select_query);                
        $number = mysqli_num_rows($result_select);
        if($number>0){
            echo "This category is already exist";
        }
        else{
        $insert_query = "INSERT INTO `product_category` (`category_name`,`category_image`) VALUES ('$category_name','$category_image')";
        
        $result_query= mysqli_query($con,$insert_query);
        if ($result_query) {
            echo " Successfully inserted the category";
        }

    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insett Categories</title>
    <style>

        .container {
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input[type="text"], input[type="file"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: calc(100% - 22px); /* Account for padding and border */
        }

        button {
            padding: 10px;
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
    </style>
</head>
<body>
<h2>Insert Categories</h2>

<form action="" method="post" enctype="multipart/form-data">
    <div class="input-group">
        <input type="text" name="cat_name" placeholder="Category Name">
        <input type="file" name="cat_image" >
        <button type="submit" name="insert_cat" >Insert Category</button>
    </div>
</form>
</body>
</html>