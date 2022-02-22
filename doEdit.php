<?php
session_start();
require_once('connect.php');

$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$description = $_POST['description'];
$id = $_POST['id'];
$file = $_POST['file'];
$image = $_FILES['image']['tmp_name'];
$image_name = $_FILES['image']['name'];
$image_size = round(filesize($image) / 512, 0).' KB';

if(!$name && !$category && !$price && !$id){
    $error = "All information is required";
    include('edit.php');
    exit;
}

if($file == 'yes'){
    $dbImage = $id.'.'.'jpg';
    $upfile = 'uploads/products/'.$dbImage;
    if (move_uploaded_file($image, $upfile)){
        $update = mysqli_query($connect, "update products set name = '$name', category = '$category', price = '$price', description = '$description', image = '$dbImage' where id = '$id'");
        if($update){
            $correct = "Product successfully updated";
            $crr = base64_encode($correct);
            header('Location: edit.php?crr='.$crr);
        }else{
            echo 'Fatal Error 1';
            exit;
        }        
    }
}else{
    $update = mysqli_query($connect, "update products set name = '$name', category = '$category', price = '$price', description = '$description' where id = '$id'");
    exit;
    
    if($update){    
    $correct = "Product successfully updated";
    $crr = base64_encode($correct);
    header('Location: edit?crr='.$crr);
    exit;
    }else{
        $error = "Fatal error";
        include('edit.php');
        exit;
    }
}

/*$update = mysqli_query($connect, "update products set name = '$name', category = '$category', price = '$price', description = '$description' where id = '$id'");

if($update){    
    $correct = "Product successfully updated";
    $crr = base64_encode($correct);
    header('Location: edit.php?crr='.$crr);
    exit;
}else{
    $error = "Fatal error";
    include('edit.php');
    exit;
}*/



?>