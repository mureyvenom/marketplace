<?php 
session_start();
require_once('connect.php');

$current1 = $_POST['current'];
$current = password_hash($current1, PASSWORD_DEFAULT);
$new = $_POST['new'];
$new1 = password_hash($new, PASSWORD_DEFAULT);
$confirm = $_POST['confirm'];
$confirm1 = password_hash($confirm, PASSWORD_DEFAULT);
$id = $_POST['merchant'];

if(!$current && !$new && !$confirm){
    $error = "All fields must be entered";
    include('change-password.php');
    exit;
}

$check1 = mysqli_query($connect, "select * from merchant where id = '$id'");
$check = mysqli_fetch_assoc($check1);

$password = $check['password'];

if(!password_verify($current1, $password)){
    $error = "Incorrect password";
    include('change-password.php');
    exit;
}

if($new !== $confirm){
    $error = "New passwords do not match";
    include('change-password.php');
    exit;
}

if($new == $current1){
    $error = "You can not use the same password";
    include('change-password.php');
    exit;
}

$change = mysqli_query($connect, "update merchant set password = '$new1' where id = '$id'");

if($change){
    session_destroy();
    $correct = "Password changed successfully. Login to access your dashboard";
    $crr = base64_encode($correct);
    header('Location: signin?crr='.$crr);
    exit;
}


?>
