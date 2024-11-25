<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit-Products</title>
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

        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
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

if(isset($_GET['edit_products'])){
    $edit_id=$_GET['edit_products'];
    
    $get_products ="SELECT * 
                    from `product_details`
                    where product_id =$edit_id";
    $result =mysqli_query($con,$get_products);
    $row =mysqli_fetch_assoc($result);

    $product_name = $row['product_name'];
    $category_id=$row['category_id'];
    $product_image = $row['product_image'];
    $product_price = $row['product_price'];
    
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
    <h1>Edit Products</h1>
    <section class="signup">
        <div class="container">            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" id="product_name" name="product_name" value=<?php echo $product_name ?> required>
                </div>
                <div class="form-group">
                <select name="product_category" >
                        <option value="<?php echo $category_name;?>"><?php echo $category_name;?></option>
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
        </div>
                <div class="form-group">
                    <label for="product_image">Poductt Image:</label>
                    <input type="file" id="product_image" name="product_image" value= required>
                    <img src="./product_images/<?php echo $product_image ?>" alt="">
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price:</label>
                    <input type="text" id="product_price" name="product_price" value=<?php echo $product_price ?> required>
                </div>
                <div class="form-group">
                    <button type="submit" name="update_product">Update Product</button>
                </div>               
            </form>
        </div>
    </section>
</div>
        <?php
        if(isset($_POST['update_product'])){

            $product_name =$_POST['product_name'];
            $product_category =$_POST['product_category'];
            $product_image =$_FILES['product_image']['name'];
            $product_tmp_image =$_FILES['product_image']['tmp_name'];
            $product_price =$_POST['product_price'];

            if($product_name==''or $product_image=='' or $product_category=='' or $product_price==''){
                echo "<script>alert('Please fill all the fields')</script>";
            }
            else{
                move_uploaded_file($product_tmp_image,"./product_images/$product_image");

                $update_product ="UPDATE `product_details`
                             set category_id =$product_category, product_name='$product_name', product_image ='$product_image', product_price='$product_price'
                             where product_id =$edit_id";

                $result_update = mysqli_query($con,$update_product);
                if($result_update){
                    echo "<script>alert('Product updated successfully')</script>";
                    echo "<script>window.open('admin.php?view_products','_self')</script>";
            }
            }           
        }
        ?>
</body>
</html>