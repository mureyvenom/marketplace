<?php
session_start();
require_once('connect.php');

$email = mysqli_real_escape_string($connect, $_POST['email']);
$password = mysqli_real_escape_string($connect, $_POST['password']);

if(!$email && !$password){
	$error = "All information is required";
	include('signin.php');
	exit;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$error = "Invalid email entered, kindly check the email and try again";
	include('signin.php');
	exit;
}

$checkmerchant = mysqli_query($connect, "select * from merchant where email = '$email'");
$nmerchant = mysqli_num_rows($checkmerchant);

if($nmerchant > 0){
	$row = mysqli_fetch_assoc($checkmerchant);
	$verified = $row['verified'];
	if(password_verify($password, $row['password'])){
		if($verified == "Yes"){
			$_SESSION['user'] = $email;
			$update_log_count = mysqli_query($connect, "update merchant set log_count = log_count+1 where email = '$email'");
			header('Location: dashboard');
			exit;
		}else{
			$error = "This account has not been verified, kindly check your email inbox or spam box for your verification link";
			include('signin.php');
			exit;
		}
	}else{
		$error = "Incorrect password";
		include('signin.php');
		exit;
	}
	
}else{
	$error = "No user with this email found";
	include('signin.php');
	exit;
}




?>