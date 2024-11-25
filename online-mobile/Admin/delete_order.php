<?php
if(isset($_GET['delete_order'])){
    $delete_id = $_GET['delete_order'];

    $delete_order ="DELETE 
                    from `orders`
                    where order_id =$delete_id";

    $result_delete = mysqli_query($con,$delete_order);

    if($result_delete){
        echo "<script>alert('Order deleted successfully')</script>";
    }

}

?>