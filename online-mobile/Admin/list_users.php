<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
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
            color: #f44336;
            text-decoration: none;
        }

        a:hover {
            color: #d32f2f;
        }

        .fa-trash {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>All Users</h1>
    <table>
        <thead>

        <?php
        
        $get_user = "SELECT * 
                       from `customers`";
        $result_users= mysqli_query($con,$get_user);
        $row_count = mysqli_num_rows($result_users);

        

            if($row_count==0){
                echo"<h2>No User Yet</h2>";
            }
            else{
                echo "<tr>
                    <th>S No.</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Customer Image </th>
                    <th>Customer Address</th>
                    <th>Customer Number</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>";

                $numner =0;
                while($row_data=mysqli_fetch_assoc($result_users)){
                    $user_id = $row_data['customer_id'];
                    $user_name = $row_data['customer_name'];
                    $user_image = $row_data['customer_image'];
                    $user_email = $row_data['customer_email'];
                    $user_address = $row_data['customer_address'];
                    $user_number = $row_data['customer_number'];
                    $numner++;

                    echo "  <tr>
                                <td>$numner</td>
                                <td>$user_name</td>
                                <td>$user_email</td>
                                <td><img src='../User_area/user_images/$user_image'</td>
                                <td>$user_address</td>
                                <td>$user_number</td>
                                <td><a href='admin.php?delete_user=$user_id'><i class='fa-solid fa-trash'></i></a></td>
                            </tr>";

                }


            }
        ?>
            
            
        </tbody>
    </table>
</body>
</html>