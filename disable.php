<?php
require_once('connect.php');

$id = base64_decode($_GET['product']);
$name = base64_decode($_GET['n']);

if(!$id ){
    echo "Incorrect product parameters";
    exit;
}

$query = mysqli_query($connect, "update products set status = 'disabled' where id = $id ");

if($query){
    $message = base64_encode($name.' successfully disabled');
    header('Location: ./dashboard.php?message='.$message);
}else{
    echo "fatal error";
    exit;
}


?>