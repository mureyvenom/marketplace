<?php
session_start();
require_once('connect.php');

$merchant = mysqli_real_escape_string($connect, str_replace(" ", "" ,ucwords($_POST['merchant'])));


if(!$merchant){
    echo "Enter a merchant name to continue";
    exit;
}

$check = mysqli_query($connect, "select * from merchant where name = '$merchant'");
$ncheck = mysqli_num_rows($check);

if($ncheck > 0){
    echo "This merchant name is taken";
    exit;
}else{
    echo "success";
    exit;
}





?>