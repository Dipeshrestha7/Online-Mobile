<?php
if(isset($_GET['delete_payment'])){
    $delete_id = $_GET['delete_payment'];

    $delete_payment ="DELETE 
                    from `user_payment`
                    where payment_id =$delete_id";

    $result_delete = mysqli_query($con,$delete_payment);

    if($result_delete){
        echo "<script>alert('Payment deleted successfully')</script>";
    }

}

?>