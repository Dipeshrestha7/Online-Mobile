<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit-Categories</title>
    <style>
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            width: 50%;
            max-width: 500px;
            margin: 20px 0;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 4px;
        }

        .alert {
            color: #f44336;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php

if(isset($_GET['edit_categories'])){
    $edit_id=$_GET['edit_categories'];
    
    $get_category ="SELECT * 
                    from `product_category`
                    where category_id =$edit_id";
    $result =mysqli_query($con,$get_category);
    $row =mysqli_fetch_assoc($result);

    $category_name = $row['category_name'];
    $category_id=$row['category_id'];
    $category_image = $row['category_image'];
    
    // for category
    $select_category ="SELECT *
                       from `product_category`
                       where category_id =$category_id ";
    $result_category =mysqli_query($con,$select_category);
    $row_category =mysqli_fetch_assoc($result_category);
    $category_name =$row_category['category_name'];
}


?>
<div class="container">
    <h1>Edit Category</h1>
    <section class="signup">
        <div class="container">            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="category_name">Category Name:</label>
                    <input type="text" id="category_name" name="category_name" value=<?php echo $category_name ?> required>
                </div>
               
                <div class="form-group">
                    <label for="category_image">Category Image:</label>
                    <input type="file" id="category_image" name="category_image" value= required>
                    <img src="./product_images/<?php echo $category_image ?>" alt="">
                </div>
                <div class="form-group">
                    <button type="submit" name="update_category">Update Category</button>
                </div>               
            </form>
        </div>
    </section>
</div>
        <?php
        if(isset($_POST['update_category'])){

            $category_name =$_POST['category_name'];
            $category_image =$_FILES['category_image']['name'];
            $category_tmp_image =$_FILES['category_image']['tmp_name'];

            if($category_name==''or $category_image==''){
                echo "<script>alert('Please fill all the fields')</script>";
            }
            else{
                move_uploaded_file($category_tmp_image,"./product_images/$category_image");

                $update_category ="UPDATE `product_category`
                             set category_name='$category_name', category_image ='$category_image'
                             where category_id =$edit_id";

                $result_update = mysqli_query($con,$update_category);
                if($result_update){
                    echo "<script>alert('Category updated successfully')</script>";
                    echo "<script>window.open('admin.php?view_category','_self')</script>";
            }
            }           
        }
        ?>
</body>
</html>