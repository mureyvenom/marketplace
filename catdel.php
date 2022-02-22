<?php
session_start();
require_once('connect.php');

$id =  base64_decode($_GET['id']);

$del = "delete from categories where id = '$id'";
$delete = mysqli_query($connect, $del);

if($delete){
    $correct = "Category deleted";
    $crr = base64_encode($correct);
    header('Location: add-category.php?crr='.$crr);
    exit;
}else{
    echo 'Fatal error';
    exit;
}


?>