<?php
if(isset($_GET['delete_categories'])){
    $delete_id = $_GET['delete_categories'];

    $delete_category ="DELETE 
                      from `product_category`
                      where category_id =$delete_id";

    $result_delete = mysqli_query($con,$delete_category);

    if($result_delete){
        echo "<script>alert('Category deleted successfully')</script>";
    }

}

?>