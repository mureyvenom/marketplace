<?php
session_start();
require_once('connect.php');

$cart_id = $_POST['cart_id'];

if(!$cart_id){
    echo "No cart id";
    exit;
}

$delete = mysqli_query($connect, "delete from cart where id = '$cart_id'");

if($delete){
    echo "success";
    exit;
}else{
    echo "Fatal Error";
}

?>