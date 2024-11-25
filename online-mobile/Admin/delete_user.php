<?php
if(isset($_GET['delete_user'])){
    $delete_id = $_GET['delete_user'];

    $delete_user="DELETE 
                      from `customers`
                      where customer_id =$delete_id";

    $result_delete = mysqli_query($con,$delete_user);

    if($result_delete){
        echo "<script>alert('Id deleted successfully')</script>";
    }

}

?>