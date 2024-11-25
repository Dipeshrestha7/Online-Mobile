<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

#main {
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.container {
    max-width: 1200px;
    margin: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
}

table th {
    background-color: #f0f0f0;
    color: #333;
}

table td {
    background-color: #fff;
    color: #666;
}

table tr:nth-child(even) td {
    background-color: #f9f9f9;
}

table tr:hover td {
    background-color: #f1f1f1;
}

table a {
    text-decoration: none;
    color: #007bff;
}

table a:hover {
    text-decoration: underline;
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

<?php
$username = $_SESSION['user_username'];
$get_user = "SELECT *
             from `customers`
             where customer_name = '$username'";
$result= mysqli_query($con,$get_user);
$row_fetch= mysqli_fetch_assoc($result);
$user_id = $row_fetch['customer_id'];


?>

<h2>All my Orders</h2>
    <section class="signup">
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>SI no</th>
                        <th>Amount</th>
                        <th>Products Id</th>
                        <th>Invoice Number</th>
                        <th>Date</th>
                        <th>Complete/Incomplete</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_order_details = "SELECT * 
                                          from `orders`
                                          where customer_id = $user_id";
                    $result_order= mysqli_query($con,$get_order_details);
                    $number = 1;
                    while($row_orders = mysqli_fetch_assoc($result_order)){
                        $order_id = $row_orders['order_id'];
                        $amount_due = $row_orders['order_amount'];
                        $product_id = $row_orders['product_id'];
                        $Invoice_Number = $row_orders['invoice_number'];
                        $order_id = $row_orders['order_id'];
                        $order_status = $row_orders['order_status'];
                            if($order_status=='pending'){
                                $order_status='Incomplete';
                            }else{
                                $order_status='Complete';
                            }
                        $order_date = $row_orders['order_date'];
                        echo "<tr>
                        <td>$number</td>
                        <td>$amount_due</td>
                        <td>$product_id</td>
                        <td>$Invoice_Number</td>
                        <td>$order_date</td>
                        <td>$order_status</td>";
                        ?>
                        <?php
                            if($order_status=='Complete'){
                                echo"<td>Paid</td>";
                            }
                            else{
                                echo "<td><a href ='confirm_payment.php?order_id=$order_id'>Confirm</a></td>
                                </tr>";
                            }
                        
                    
                    $number++;
                    }                      
                    ?>
                    
                </tbody>
            </table>
            
        </div>
    </section>
  
</body>
</html>