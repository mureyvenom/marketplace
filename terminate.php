<?php 
session_start();
require_once('connect.php');

$id  = base64_decode($_GET['id']);

if(!$id){
    echo "No order parameters received";
    exit;
}

$confirm = mysqli_query($connect, "update completed set status = 'terminated' where id = '$id'");

if($confirm){
    $message = base64_encode("Order terminated");
    header('Location: view-order.php?id='.$_GET['id'].'&message='.$message);
    exit;
}else{
    echo 'Fatal Error';
    exit;
}

?>