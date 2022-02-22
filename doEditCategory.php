<?php 
session_start();
require_once('connect.php');

$name = $_POST['name'];
$cat_id = $_POST['cat_id'];

if(!$name && !$cat_id){
    $error = "All information is required";
    include('edit-category.php');
    exit;
}

$add = "update categories set name = '$name' where id = '$cat_id'";
$doadd = mysqli_query($connect, $add);

if($doadd){
    $correct = "Category updated successfully";
    $crr = base64_encode($correct);
    header('Location: edit-category.php?crr='.$crr);
    exit;
}

?>