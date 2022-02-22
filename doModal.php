<?php
session_start();
require_once('connect.php');

$phone = $_POST['phone'];
$account = $_POST['account'];
$bank = $_POST['bank'];
$email = $_SESSION['user'];

$getbank = mysqli_query($connect, "select * from flutter_bank_list where code = '$bank'");
$bankname = mysqli_fetch_assoc($getbank)['name'];

if(!$phone && !$account && !$bank){
    $errorx = "All information is required";
    include('./dashboard.php');
    exit;
}

if(strlen($account) != 10){
    $errorx = "Invalid account number";
    include('./dashboard.php');
    exit;
}


    $postdata = array('recipientaccount' => $_POST['account'], 
    'destbankcode'=>  $_POST['bank'], 
    'PBFPubKey'=>  "FLWPUBK-44b92b942bfab6b6f9b0f1720a44bf98-X");
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://api.ravepay.co/flwv3-pug/getpaidx/api/resolve_account");
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
        
        $accountname = $result['data']['data']['accountname'];
        $accountnumber = $result['data']['data']['accountnumber'];
    }else{
        if(curl_error($ch))
        {
            echo 'error:' . curl_error($ch);
        }
    }
    
    curl_close($ch);

if(!$accountname && !$accountnumber){
    $errorx = "Unable to validate bank details";
    include('./dashboard.php');
    exit;
}


$run = mysqli_query($connect, "update merchant set phone = '$phone', account = '$account', bank_name = '$bankname', bank_code = '$bank', firstname = '$accountname' where email = '$email'");

if($run){
    $crr = base64_encode("Account number added");
    header('Location: ./dashboard.php?crr='.$crr);
}else{
    echo "Fatal error";exit;
}

?>