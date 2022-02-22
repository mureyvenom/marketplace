<?php
require_once('connect.php');
$account = $_POST['account'];
$bank = $_POST['bank'];

if(!$account || !$bank){
    echo '<div class="alert alert-danger">Incomplete Data Sent</div>';
    exit;
}

if(strlen($account) < 10){
    echo '<div class="alert alert-danger">Invalid Account Number</div>';
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

if(!$accountname || !$accountnumber){
    echo '<div class="alert alert-danger">Unable to validate account details</div>';
    exit;
}else{
    echo '<div class="alert alert-success">Bank details for '.$accountname.' verified. Click on the submit button to continue</div>';
}

?>