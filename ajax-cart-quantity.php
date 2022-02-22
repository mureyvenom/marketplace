<?php
require_once('connect.php');

$order_id_session = $_POST['order_id_session'];


$query = "select sum(quantity) from cart where order_id = '$order_id_session'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);	
if (!$row['sum(quantity)']){
    echo 0;
}else{
    echo $row['sum(quantity)'];
}


?>