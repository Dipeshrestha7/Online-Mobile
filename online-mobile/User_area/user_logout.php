<?php 
include '../database/connect.php';
include '../function/common_function.php';

session_start();
    
session_unset();
session_destroy();


echo "<script> window.open('../products.php','_self')</script>";
?>