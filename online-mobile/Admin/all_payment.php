<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Payment</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            background-color: white;
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

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
    <h1>All Payment</h1>
    <table>
        <thead>

        <?php
        
        $get_payment = "SELECT * 
                       from `user_payment`";
        $result_payment= mysqli_query($con,$get_payment);
        $row_count = mysqli_num_rows($result_payment);

        

            if($row_count==0){
                echo"<h2>No paymnet received Yet</h2>";
            }
            else{
                echo "<tr>
                    <th>S No.</th>
                    <th>Invoice number</th>
                    <th>Amount</th>
                    <th>Payment Mode</th>
                    <th>Payment Date</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>";

                $numner =0;
                while($row_data=mysqli_fetch_assoc($result_payment)){
                    $order_id = $row_data['order_id'];
                    $payment_id = $row_data['payment_id'];
                    $amount = $row_data['amount'];
                    $payment_date = $row_data['payment_date'];
                    $payment_mode = $row_data['payment_mode'];
                    $invoice_number = $row_data['invoice_number'];
                    $numner++;

                    echo "  <tr>
                                <td>$numner</td>
                                <td>$invoice_number</td>
                                <td>$amount</td>
                                <td>$payment_mode</td>
                                <td>$payment_date</td>
                                <td><a href='admin.php?delete_payment=$payment_id'><i class='fa-solid fa-trash'></i></a></td>
                            </tr>";

                }


            }
        ?>
            
            
        </tbody>
    </table>
</body>
</html>