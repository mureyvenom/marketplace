<?php
session_start();
require_once('connect.php');

$order_id = $_POST['order_id'];

$query = "select sum(price*quantity) from cart where order_id = '".$_SESSION['order_id']."'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);	
echo number_format($row['sum(price*quantity)']);
exit;

?>