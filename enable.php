<?php
require_once('connect.php');

$id = base64_decode($_GET['product']);
$name = base64_decode($_GET['n']);

if(!$id ){
    echo "Incorrect product parameters";
    exit;
}

$query = mysqli_query($connect, "update products set status = 'active' where id = $id ");

if($query){
    $message = base64_encode($name.' successfully enabled');
    header('Location: ./dashboard.php?message='.$message);
}else{
    echo "fatal error";
    exit;
}


?>