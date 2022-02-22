<?php 
session_start();
require_once('connect.php');

$name = $_POST['name'];
$merchant = $_POST['merchant'];

if(!$name && !$merchant){
    $error = "All information is required";
    include('add-category.php');
    exit;
}

$add = "insert into categories set name = '$name', merchant = '$merchant'";
$doadd = mysqli_query($connect, $add);

if($doadd){
    $correct = "Category added successfully";
    $crr = base64_encode($correct);
    header('Location: add-category.php?crr='.$crr);
    exit;
}

?>