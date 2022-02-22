<?php
session_start();
include('connect.php');

function now(){
	return date('Y-m-d H:i:s');	
}

function time_stamp(){
	return date('U');	
}

$merchant = $_POST['merchant'];

$get_transax = mysqli_query($connect, "select * from completed where merchant = '$merchant' and payment_status = 'confirmed'");


$get_free_transactions = mysqli_query($connect, "select * from free_transactions where name = 'DemoName'");
$free_transactions = mysqli_fetch_assoc($get_free_transactions)['number'];

$getfee = mysqli_query($connect, "select * from fees where name = 'DemoName'");
$rfee = mysqli_fetch_assoc($getfee);

if(mysqli_num_rows($get_transax) >= $free_transactions){
    $percentage = $rfee['percentage'] / 100;
    $additional = $rfee['additional'];
}else{
    $percentage = 0;
    $additional = 0;
}


$firstname = addslashes($_POST['firstname']);
$lastname = addslashes($_POST['lastname']);
$email = addslashes($_POST['email']);
$tel = addslashes($_POST['tel']);
$address = addslashes($_POST['address']);
$iaddress = addslashes($_POST['iaddress']);
$city = addslashes($_POST['city']);
$country = addslashes($_POST['country']);
$state = addslashes($_POST['state']);
$amount = $_POST['final'];
$_SESSION['ref_id'] = $_POST['item_reference'];
$quantity = $_POST['quantity'];
$sales_method = $_POST['sales_method'];
$item_bought = addslashes($_POST['product']);
$_SESSION['order_id'];
$status = 'pending';
$_SESSION['entry_time'] = now();
$_SESSION['time_stamp'] = time_stamp();
$date = date("Y-m-d");
$time = date("h:i:s");
$d = strtoupper(substr($email, 0, 5));
$order_id = $d.$date.$time;
$payamount = $amount * 100;
$location = $_POST['location'];
$shipping = $_POST['checkprice'];
$commissionn = 0.028 * $amount;
$commission_sub = $percentage * $amount;
$commission = $commission_sub + $additional;
$cc = $commission_sub + $additional;
$amountt = $amount - $cc;
$txreff = "rave-".date("ymdhis");




if(!$firstname || !$lastname || !$email || !$tel)
{
   $error = 'All fields must be entered before submitting';
    include('checkout.php');
    exit;
}

if($location == 'inter'){
    
    if(!$iaddress || !$country){
        $error = 'All fields must be entered before submitting';
        include('checkout.php');
        exit;
    }
    
    $query = "insert into completed set
		  date = '".$_SESSION['entry_time']."',
		  firstname = '$firstname',
		  lastname = '$lastname',
		  email = '$email',
		  phone = '$tel',
		  address = '$iaddress',
		  order_id = '$order_id',
		  country = '$country',
		  amount = '$amountt',
		  status = 'pending',
          shipping_fee = '$shipping'";
}else{
    
    if(!$address || !$city){
        $error = 'All fields must be entered before submitting local';
        include('checkout.php');
        exit;
    }
    
    $query = "insert into completed set
		  date = '".$_SESSION['entry_time']."',
		  firstname = '$firstname',
		  lastname = '$lastname',
		  email = '$email',
		  phone = '$tel',
		  address = '$address',
		  order_id = '$order_id',
		  city = '$city',
		  state = '$state',
          country = 'Nigeria',
		  amount = '$amountt',
		  status = 'pending',
		  merchant = '$merchant',
          payment_status = 'pending',
          shipping_fee = '$shipping',
          commission = '$commission',
          txref = '$txreff',
          actual_amount = '$amount'";
}



//$delete = "delete from client_order where id = '".$_SESSION['order_id']."'";

        
$result = mysqli_query($connect, $query);
if($result){
    
/*	$_SESSION['pay_type'] = $payment_method;
    $_SESSION['cart_user'] = $email;
    $_SESSION['cart_user_name'] = $firstname.' '.$lastname;    
    $_SESSION['state'] = $state; 
    $_SESSION['firstname'] = $firstname;    
    $_SESSION['lastname'] = $lastname;
	*/


$sel_id = $_SESSION['order_id'];
$select = mysqli_query($connect, "select * from cart where order_id = '$sel_id'");
$nselect = mysqli_num_rows($select);
function itemplace($id,$col){
	include('connect.php'); 
	$query = "select * from products where id = '$id'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	return $row[$col];
}
    
    for($si=0; $si<$nselect; $si++){
        $selrow = mysqli_fetch_assoc($select);
	    $prodname = itemplace($selrow['product_id'], 'name');
        $prodquantity = $selrow['quantity'];
        $prodprice = $selrow['price'];
        $prodsize = $selrow['product_size'];
        $prodcolor = $selrow['color'];
        $prodid = $selrow['product_id'];
            
$sales = "insert into sales set
		  order_date = '".$_SESSION['entry_time']."',
		  firstname = '$firstname',
		  lastname = '$lastname',
		  email = '$email',
		  phone = '$tel',
		  address = '$address',
		  city = '$city',
		  state = '$state',
		  item_bought = '$prodname',
		  size = '$prodsize',
		  color = '$prodcolor',
		  amount = '$prodprice',
		  quantity = '$prodquantity',
		  order_id = '$order_id',
          product_id = '$prodid',
          payment_status = 'pending'";
	
$salesentry = mysqli_query($connect, $sales);
	
    }
 
    include('curl_init.php');
    
    
}


?>