<?php

session_start();
require_once('connect.php');

$cart_id = $_POST['cart_id'];
mysqli_query($connect, "update cart set quantity = quantity+1 where id = '$cart_id'");
echo "success";
exit;

?>