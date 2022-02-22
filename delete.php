<?php
require_once('connect.php');

$id = base64_decode($_GET['product']);
$name = base64_decode($_GET['n']);

if(!$id){
    echo "Incorrect product parameters";
    exit;
}

$query = mysqli_query($connect, "delete from products where id = $id ");

$get_images = mysqli_query($connect, "select * from product_image where product = '$id'");
$nimagex = mysqli_num_rows($get_images);

for($del=0; $del<$nimagex; $del++ ){
    $delr = mysqli_fetch_assoc($get_images);
    $delimage = $delr['name'];
    unlink("uploads/products/$delimage");
    
}

$delete_images = mysqli_query($connect, "delete from product_image where product = '$id'");
$delete_size = mysqli_query($connect, "delete from product_size where product_id = '$id'");
$delete_colors = mysqli_query($connect, "delete from product_colors where product_id = '$id'");



if($query){
    $message = base64_encode($name.' successfully deleted');
    header('Location: ./dashboard.php?message='.$message);
}else{
    echo "fatal error";
    exit;
}


?>