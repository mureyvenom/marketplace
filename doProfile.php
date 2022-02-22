<?php 
session_start();
require_once('connect.php');

$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$phone = $_POST['phone'];
$nam = $_POST['name'];
$name = str_replace(" ", "", ucwords($nam));
$account = $_POST['account'];
$bank = $_POST['bank'];
$id = $_POST['merchant'];
$getbank = mysqli_query($connect, "select * from flutter_bank_list where code = '$bank'");
$bankname = mysqli_fetch_assoc($getbank)['name'];

if(!$phone && !$name && !$account && !$bank){
    $error = "All information is required";
    include('edit-profile.php');
    exit;
}

if(strlen($account) != 10 ){
    $error = "Invalid account number";
    include('edit-profile.php');
    exit;
}

$check = mysqli_query($connect, "select * from merchant where name = '$name' and not id = '$id'");

if(mysqli_num_rows($check) > 0){
    $error = "This merchant name is not available";
    include('edit-profile.php');
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
    include('edit-profile.php');
    exit;
}

$query = "update merchant set firstname = '$accountname', phone = '$phone', name = '$name', account = '$account', bank_name = '$bankname', bank_code = '$bank' where id = '$id'";
$update = mysqli_query($connect, $query);

if($update){
    $crr = base64_encode('Profile successfully updated');
    header('Location: edit-profile.php?crr='.$crr);
    exit;
}else{
    echo 'fatal error<br>';
}



?>