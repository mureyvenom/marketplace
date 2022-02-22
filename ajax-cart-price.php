<?php
require_once('connect.php');
$order_id_session = $_POST['order_id_session'];
$query = "select sum(price*quantity) from cart where order_id = '$order_id_session'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);	
echo  number_format($row['sum(price*quantity)']);
exit;

?>