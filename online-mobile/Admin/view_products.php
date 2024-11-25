

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <style>


        table {
            width: 100%;
            max-width: 1000px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }

        thead {
            background-color: #4CAF50;
            color: white;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th:first-child, td:first-child {
            padding-left: 20px;
        }

        th:last-child, td:last-child {
            padding-right: 20px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        a {
            color: #2196F3;
            text-decoration: none;
        }

        a:hover {
            color: #0b7dda;
        }

        .fa-pen-to-square, .fa-trash {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>All Products</h1>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Total Sold</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php
            
            $get_products= "SELECT * 
                            from `product_details`";
            $result = mysqli_query($con,$get_products);
            $number = 0;
            while($row = mysqli_fetch_assoc($result)){
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $product_image = $row['product_image'];
                $product_price = $row['product_price'];
                $number++;
             ?>   
                    <tr>
                        <td><?php echo $number?></td>
                        <td><?php echo $product_name?></td>
                        <td><img src='./product_images/<?php echo $product_image?>'></td>
                        <td><?php echo $product_price?></td>
                        <td><?php
                                $get_count = "SELECT * 
                                              from `orders_pending`
                                              where product_id =$product_id";
                                $result_count = mysqli_query($con,$get_count);
                                $rows_count =mysqli_num_rows($result_count);
                                echo $rows_count;

                            ?></td>
                        <td><a href='admin.php?edit_products=<?php echo $product_id?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
                        <td><a href='admin.php?delete_products=<?php echo $product_id?>'><i class='fa-solid fa-trash'></i></a></td>
                    </tr>
            <?php 
            } 
            ?>

            
        </tbody>
    </table>
</body>
</html>