<?php
include '../database/connect.php';
include '../function/common_function.php';

if(isset($_GET['customer_id'])){
    $user_id = $_GET['customer_id'];
    // echo $user_id;
}

//getting total price of all items
$get_ip_address = getIPAddress();
$cart_query_price = "SELECT * from `cart_details` 
                     where ip_address= '$get_ip_address'";
$result_cart_price= mysqli_query($con,$cart_query_price);  

$invoice_number = mt_rand();
$status = 'pending';

while($row_price = mysqli_fetch_array($result_cart_price)){
    $product_id = $row_price['product_id'];

    $select_product = "SELECT * from `product_details` 
                     where product_id = $product_id";

    $run_price= mysqli_query($con,$select_product);  
        while($row_product_price = mysqli_fetch_array($run_price)){
            $product_price = array($row_product_price['product_price']);
            $price_table = $row_product_price['product_price'];
        }
}   

//getting quantities from cart
$get_cart = "SELECT * from `cart_details`";
$run_cart = mysqli_query($con,$get_cart);
$get_item_quantities = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantities['quantity'];
if($quantity == 0){
    $quantity = 1;

}else{
    $quantity = $quantity;
}

$insert_order = "INSERT into `orders` (product_id,customer_id,order_amount,order_date,order_status,invoice_number)
                 values($product_id,$user_id,'$price_table',NOW(),'$status',$invoice_number)";
$result_query = mysqli_query($con,$insert_order);
if($result_query){
    echo "<script> alert('Orders are submitted successfully')</script>";
    echo "<script> window.open('profile.php','_self')</script>";

}

//orders pending
$insert_pending_order = "INSERT into `orders_pending` (customer_id,invoice_number,product_id,quantity,order_status)
                 values($user_id,$invoice_number,$product_id,$quantity,'$status')";
$result_pending_query = mysqli_query($con,$insert_pending_order);


//delete items from cart
$empty_cart = "DELETE 
               from `cart_details`
               where ip_address = '$get_ip_address'";

$result_empty_cart = mysqli_query($con,$empty_cart);

?>