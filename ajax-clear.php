<?php
session_start();
require_once('connect.php');
$cart_id = $_POST['cart_id'];
$pr_id = $_POST['pr_id'];


if($cart_id){
	$query3 = "delete from cart where order_id = '".$_SESSION['order_id']."' and id = '$cart_id'";
}
else
{

	$query_cart = "select * from cart where order_id =  '".$_SESSION['order_id']."'";
	$result_cart = mysqli_query($connect, $query_cart);
	$num_cart = mysqli_num_rows($result_cart);
	for($i=0; $i<$num_cart; $i++)
	{
		$row_cart = mysqli_fetch_array($result_cart);
		$return = $row_cart['product_size']+1;
	}
	$query3 = "delete from cart where order_id = '".$_SESSION['order_id']."'";
}
$result3 = mysqli_query($connect, $query3);

if($result3){
    echo "success";
    exit;
}else{
    echo "Error encountered";
    exit;
}

?>