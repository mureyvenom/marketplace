<?php 
session_start();
require_once('connect.php');

$state = $_POST['state'];
$days = $_POST['days'];
$fee = $_POST['fee'];
$otherdays = $_POST['otherdays'];
$otherfee = $_POST['otherfee'];
$id = $_POST['merchant'];

if(!$state && !$days && !$fee){
    $error = "All information is required";
    include('delivery-details.php');
    exit;
}
/*
$check = mysqli_query($connect, "select * from delivery where state = '$state' and merchant = '$id'");
$ncheck = mysqli_num_rows($check);

if($ncheck > 0){
    $error = "You have already set delivery details for this location, you can edit delilvery details in the table below";
    include('delivery-details.php');
    exit;
}
*/

if($otherdays){
    $dodays = mysqli_query($connect, "update delivery set days = '$otherdays' where state <> '$state' and merchant = '$id'");
}

if($otherfee){
    $dofee = mysqli_query($connect, "update delivery set fee = '$otherfee' where state <> '$state' and merchant = '$id'");
}

$query = "update delivery set days = '$days', fee = '$fee' where state = '$state' and merchant = '$id'";
$delivery = mysqli_query($connect, $query);

if($delivery){
    $correct = 'Delivery details for '.$state.' has been set';
    $crr = base64_encode($correct);
    header('Location: delivery-details?crr='.$crr);
    exit;
}else{
    echo 'Fatal error';
    exit;
}


?>