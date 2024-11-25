<?php

// include ('./database/connect.php');


//getting function for product_category

    function getProductCategory(){
        global $con;

        $select_query = "SELECT *
                         FROM `product_category`";
                         $result_select = mysqli_query($con, $select_query);

                    // Check if there are categories to display
                    if(mysqli_num_rows($result_select) > 0) {
                        while ($category_data = mysqli_fetch_assoc($result_select)) {
                            $category_id = $category_data['category_id'];
                            $category_name = $category_data['category_name'];
                            $category_image = $category_data['category_image'];
                    
                            echo "
                            <div class='flex' id='flex'>             
                                <a href='products.php?product_category={$category_id}' id='product' class='product-1'>
                                    <img src='Admin/product_images/{$category_image}' alt=''>
                                    <p>{$category_name}</p>
                                </a>
                            </div>
                            ";
                        }
                    } else {
                        echo "No categories found.";
                    }
                  
}



//getting function for product_details

 //condition to check isset or not

function getProductDetails(){
    
    global $con;

        if (!isset($_GET['product_category'])) {
       
       
    $select_query = "SELECT *
                     from `product_details`";
                     $result_query = mysqli_query($con,$select_query);
                
                while($row = mysqli_fetch_assoc($result_query)){
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $product_image =$row['product_image'];
                    $product_price = $row['product_price'];
                
                    echo"  
                        <div class='pdetail'>
                            <img src='Admin/product_images/{$product_image}' alt=''>
                            <p>{$product_name}</p>
                            <p>{$product_price}</p>
                            <a href='products.php?add_to_cart=$product_id'><button>Add to cart</button></a>
                        </div>";
                }
                
                // Close the products container div outside of the loop
                echo "</div>";

}
}

//getting unique categories
function getUniqueProduct(){
    
    global $con;

        if (isset($_GET['product_category'])) {
            $category_id = $_GET['product_category'];
       
    $select_query = "SELECT *
                     from `product_details` where category_id= $category_id";
                     $result_query = mysqli_query($con,$select_query);

                    $num_of_rows =mysqli_num_rows(($result_query));
                    
                    if ($num_of_rows==0) {
                        echo"<h2> No stock for this category</h2>";
                    }
                    else{

                    
                        while($row = mysqli_fetch_assoc($result_query)){
                            $product_id = $row['product_id'];
                            $product_name = $row['product_name'];
                            $product_image =$row['product_image'];
                            $product_price = $row['product_price'];
                        
                            echo"  
                                <div class='pdetail'>
                                    <img src='Admin/product_images/{$product_image}' alt=''>
                                    <p>{$product_name}</p>
                                    <p>{$product_price}</p>
                                    <a href='products.php?add_to_cart=$product_id'><button>Add to cart</button></a>
                                </div>";
                        }
                        
                        // Close the products container div outside of the loop
                        echo "</div>";
            }
}
}


//Get ip address function
function getIPAddress() {  
    // Whether IP is from the shared internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
    }  
    // Whether IP is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    // Whether IP is from the remote address  
    else {  
        $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
}  


//cart function 

function cart(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip_address = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];

        $select_query = "SELECT * 
                        FROM `cart_details`
                        WHERE ip_address = '$get_ip_address' AND product_id = $get_product_id";
    
        $result_query = mysqli_query($con, $select_query);

        $num_of_rows = mysqli_num_rows($result_query);
                    
        if ($num_of_rows > 0) {
            echo "<script> alert('This item is already present inside cart') </script>";
            echo "<script>window.open('products.php','_self')</script>";
        } else {
            $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) 
                             VALUES ($get_product_id, '$get_ip_address', 0)";

            $result_query = mysqli_query($con, $insert_query);
            echo "<script> alert('This item is added to cart') </script>";
            echo "<script>window.open('products.php','_self')</script>";
        }
    }
}

//function to get cart item number

function cart_item(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip_address = getIPAddress();

        $select_query = "SELECT * 
                        FROM `cart_details`
                        WHERE ip_address = '$get_ip_address' ";
    
        $result_query = mysqli_query($con, $select_query);

        $count_cart_items = mysqli_num_rows($result_query);
                    
     } else {
            global $con;
        $get_ip_address = getIPAddress();

        $select_query = "SELECT * 
                        FROM `cart_details`
                        WHERE ip_address = '$get_ip_address' ";
    
        $result_query = mysqli_query($con, $select_query);

        $count_cart_items = mysqli_num_rows($result_query);
        }
        echo $count_cart_items;
    }


//Total price function

function total_cart_price(){
    global $con;
    $get_ip_address = getIPAddress();
    
    $total_price =0 ;
    
    $cart_query = "SELECT *
                   from `cart_details` 
                   where ip_address = '$get_ip_address'";
    $result = mysqli_query($con, $cart_query);

    while ($row = mysqli_fetch_array($result)) {
            $product_id = $row['product_id'];
            $select_product = "SELECT *
                            from `product_details`
                            where product_id = '$product_id' ";
            $result_product = mysqli_query($con, $select_product);
        
        while ($row_product_price = mysqli_fetch_array($result_product)) {
            $product_price =array($row_product_price['product_price']);
            $product_value =array_sum($product_price);
            $total_price += $product_value;

        }  
    }
     echo $total_price;
}


//get user order details
function get_order_details(){
    global $con;
    $username=$_SESSION['user_username'];
    $get_details = "SELECT *
                    from `customers`
                    where customer_name ='$username'";
    $result_query = mysqli_query($con,$get_details);
    while($row_query = mysqli_fetch_array($result_query)){
        $user_id = $row_query['customer_id'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){
                    $get_orders = "SELECT * 
                    from `orders`
                    where customer_id = $user_id and order_status = 'pending'";

                    $result_orders_query = mysqli_query($con,$get_orders);
                    $row_count = mysqli_num_rows($result_orders_query);
                    if($row_count>0){
                        echo"<h2> You have <span style '= color:red;'>$row_count</span> pending orders</h2>
                         <a href='profile.php'>Order Details</a>";

                    }else{
                        echo"<h2> You have 0 pending orders</h2>
                        <a href='../products.php'>Explore Products</a>";
                    }
                }   
            }  
        }
    }
}


?>