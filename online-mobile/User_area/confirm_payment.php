<?php
include '../database/connect.php';
session_start();

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];

    $select_data = "SELECT * 
                    from `orders`
                    where order_id=$order_id";
    $result = mysqli_query($con,$select_data);
    $row_fetch = mysqli_fetch_assoc($result);

    $invoice_number =$row_fetch['invoice_number'];
    $order_amount = $row_fetch['order_amount'];
}

if(isset($_POST['submit'])){
    $invoice_number =$_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    $insetr_query = "INSERT into `user_payment` (order_id,invoice_number,amount,payment_mode,payment_date)
                                        VALUES ($order_id,$invoice_number,'$amount','$payment_mode',NOW())";
    
    $result_payment = mysqli_query($con,$insetr_query);
    if($result_payment){
        echo "<script>alert('Successfully completed the payment')</script>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders = "UPDATE `orders`
                      set order_status = 'Complete'
                      where order_id = $order_id";
    $result_orders = mysqli_query($con,$update_orders);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="user_login.css">

</head>
<body>
<section class="login">
        <div class="container">
            <h2>Confirm Payment</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="invoice_number">Invoice Number:</label>
                    <input type="text" id="invoice_number" name="invoice_number"  value = "<?php echo $invoice_number?>" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="text" id="amount" name="amount" value =" <?php echo $order_amount?>" required>
                </div>
                <div class="form-group">
                    <select name="payment_mode" id="">
                        <option> Cash on Delivery</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Confirm Payment</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>