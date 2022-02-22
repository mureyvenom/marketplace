<?php

session_start();
require_once('connect.php');

$cart_id = $_POST['cart_id'];

$get_val = mysqli_query($connect, "select * from cart where id = '$cart_id'");
$getvalue = mysqli_fetch_assoc($get_val)['quantity'];

if($getvalue == 1){
    mysqli_query($connect, "delete from cart where id = '$cart_id'");
    echo "success";
    exit;
}else{
    mysqli_query($connect, "update cart set quantity = quantity-1 where id = '$cart_id'");
    echo "success";
    exit;
}



?>