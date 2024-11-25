

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View-Categories</title>
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
    <h1>All Categories</h1>
    <table>
        <thead>
            <tr>
                <th>S No.</th>
                <th>Category Name</th>
                <th>Category Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <?php
        $select_cat ="SELECT *
                      from `product_category`";
        $result_cat =mysqli_query($con,$select_cat);
        $number =0;
        while($row =mysqli_fetch_assoc($result_cat)){
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
            $category_image = $row['category_image'];
            $number++;
        
        ?>

        <tbody>
            <tr>
                <td><?php echo $number?></td>
                <td><?php echo $category_name?></td>
                <td><img src='./product_images/<?php echo $category_image?>'></td>
                <td><a href='admin.php?edit_categories=<?php echo $category_id?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='admin.php?delete_categories=<?php echo $category_id?>'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
        <?php
         }   
            ?>
        </tbody>
    </table>
</body>
</html>