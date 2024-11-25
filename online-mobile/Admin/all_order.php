<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All-Orders</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        td a {
            color: #f44336;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        h2 {
            color: #f44336;
        }

        .fa-trash {
            color: #f44336;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>All Orders</h1>
    <table>
        <thead>

        <?php
        
        $get_orders = "SELECT * 
                       from `orders`";
        $result= mysqli_query($con,$get_orders);
        $row_count = mysqli_num_rows($result);

        

            if($row_count==0){
                echo"<h2>No Orders Yet</h2>";
            }
            else{
                echo "<tr>
                    <th>S No.</th>
                    <th>View Amount</th>
                    <th>Invoice number</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>";

                $numner =0;
                while($row_data=mysqli_fetch_assoc($result)){
                    $order_id = $row_data['order_id'];
                    $product_id = $row_data['product_id'];
                    $customer_id = $row_data['customer_id'];
                    $order_amount = $row_data['order_amount'];
                    $order_date = $row_data['order_date'];
                    $order_status = $row_data['order_status'];
                    $invoice_number = $row_data['invoice_number'];
                    $numner++;

                    echo "  <tr>
                                <td>$numner</td>
                                <td>$order_amount</td>
                                <td>$invoice_number</td>
                                <td>$order_date</td>
                                <td>$order_status</td>
                                <td><a href='admin.php?delete_order=$order_id'><i class='fa-solid fa-trash'></i></a></td>
                            </tr>";

                }


            }
        ?>
            
            
        </tbody>
    </table>
</body>
</html>