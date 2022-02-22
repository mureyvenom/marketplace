<?php
session_start();
require_once('connect.php');

$order_id = base64_decode($_GET['oid']);

$get_order = mysqli_query($connect, "select * from completed where order_id = '$order_id'");
$nrow = mysqli_num_rows($get_order);

if($nrow < 1){
    echo "No order found";
    exit;
}

$row = mysqli_fetch_assoc($get_order);

$amount = $row['amount'];
$merchant = $row['merchant'];
$balance_confirmed = $row['balance_confirmed'];
$date = date("Y-m-d");

$pull = mysqli_query($connect, "select * from merchant where id = '$merchant'");
$prow = mysqli_fetch_assoc($pull);
$account = $prow['account'];
$account_bank = $prow['bank_code'];
$merchmail = $prow['email'];
$reference = "Payout for order with order id: ".$order_id;
$seckey = "FLWSECK-XX-X";
$beneficiary_name = $prow['firstname'];
$currency = "NGN";

if($balance_confirmed == 'Yes'){
    echo 'This delivery has been previously confirmed';
    exit;
}


$postdata = array(
    'account_bank' => $account_bank, 
    'account_number' =>  $account, 
    'amount' =>  $amount, 
    'currency' =>  $currency, 
    'account_number' =>  $account, 
    'narration' =>  $reference, 
    'reference' =>  "rave-DemoName-payout-to-".$beneficiary_name.date("ymdhis"), 
    'seckey' =>  $seckey);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.ravepay.co/v2/gpx/transfers/create");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); //Post Fields
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
curl_setopt($ch, CURLOPT_TIMEOUT, 200);


$headers = array('Content-Type: application/json');

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$request = curl_exec($ch);

if ($request) {
    $result = json_decode($request, true);
    //echo "<pre>";
    //print_r($result);
    $status = $result['status'];
    $message = $result['message'];
    $ref = $result['data']['reference'];
    $date_created = $result['data']['date_created'];
    $fee = $result['data']['fee'];
}else{
    if(curl_error($ch))
    {
        echo 'error:' . curl_error($ch);
    }
}

curl_close($ch);

$log = "insert into payouts set order_id = '$order_id', date = '$date_created', message = '$message', reference = '$ref', merchant = '$merchant', status = '$status', amount = '$amount', fee = '$fee'";

if($status == 'success' || $message == 'TRANSFER-CREATED'){
    
    $dolog = mysqli_query($connect, $log);
    
    $confirm = mysqli_query($connect, "update completed set balance_confirmed = 'Yes' where order_id = '$order_id'");
}else{
    echo 'An Error Occurred<br>'.$beneficiary_name.'<br>';
    
    print_r($result);
    
    exit;
}

//$update_balance = mysqli_query($connect, "update merchant set balance = balance+$amount where id = '$merchant'");

header('Location: balance_confirmed');
//if($update_balance){
//    
//    exit;
//}else{
//    echo 'An error occurred';
//}


?>
