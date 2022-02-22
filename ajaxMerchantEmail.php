<?php
session_start();
require_once('connect.php');

$email = mysqli_real_escape_string($connect, $_POST['email']);

if(!$email){
    echo "Enter an email to continue";
    exit;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "Invalid email entered";
    exit;
}

$check = mysqli_query($connect, "select * from merchant where email  = '$email'");
$ncheck = mysqli_num_rows($check);

if($ncheck > 0){
    echo "This email has already been registered";
    exit;
}else{
    echo "success";
    exit;
}

?>