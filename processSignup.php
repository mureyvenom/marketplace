<?php
session_start();
require_once('connect.php');

$email = mysqli_real_escape_string($connect, $_POST['email']);
$merchant = mysqli_real_escape_string($connect, str_replace(" ", "", ucwords($_POST['merchant'])));
$category = mysqli_real_escape_string($connect, $_POST['category']);
$password = mysqli_real_escape_string($connect, $_POST['password']);
$confirm = mysqli_real_escape_string($connect, $_POST['confirm']);
$passhash = password_hash($password, PASSWORD_DEFAULT);
$date = date("ymd");
$time = date("his");
$d = strtoupper(substr($email, 0, 5));
$dd = intval($d);
$refercode = $d.$date.$time;
$forbiddenNames = array(".htaccess", "add-category", "add-products", "ajax-cart", "admin", "admin-dist", "admin-images", "ajax-cart-drop", "ajax-cart-price", "ajax-cart-quantity", "ajax-cart-reset", "ajax-clear", "ajax-minus-cart", "ajax-plus-cart", "ajax-remove", "ajax-sub-total", "ajaxMerchantEmail", "ajaxMerchantName", "balance", "balance_confirmed", "banner-images", "callback", "cart", "cart-drop", "catdel", "categories", "change-password", "checkout", "confirm", "confirmed-orders", "confirmed-payouts", "connect", "curl-init", "dashboard", "delete", "delete-image", "delivery-details", "disable", "doBanner", "doCategory", "doDelivery", "doEdit", "doEditBannerImage", "doEditCategory", "doEditImage", "doModal", "doPass", "doProduct", "doProductCompress", "doProfile", "edit", "edit-banner-image", "edit-category", "edit-delivery-details", "edit-image", "edit-proile", "enable", "fns", "footer", "functions", "header", "inc", "index", "initialize", "live-check", "logout", "market", "myjs", "pending-orders", "presearch", "processSigninn", "processSignup", "product-details", "products", "search", "sidebar", "signin", "signup", "terminate", "view-order",  "search");

if(!$email && !$merchant && !$category && !$password && !$confirm){
	$error = "All information is required";
	include('signup.php');
	exit;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$error = "Invalid email entered, kindly check and try again";
	include('signup.php');
	exit;
}

if(in_array($merchant, $forbiddenNames)){
    $error = "This name isn't valid, kindly select another merchant name";
    include('signup.php');
    exit;
}

$checkemail = mysqli_query($connect, "select * from merchant where email = '$email'");
$nemail = mysqli_num_rows($checkemail);

if($nemail > 0){
	$error = "This email has already been registered";
	include('signup.php');
	exit;
}

$checkname = mysqli_query($connect, "select * from merchant where name = '$merchant'");
$nmerchant = mysqli_num_rows($checkname);

if($nmerchant > 0){
	$error = "This merchant name is already taken";
	include('signup.php');
	exit;
}

if($password !== $confirm){
	$error = "Passwords do not match";
	include('signup.php');
	exit;
}

$insert = mysqli_query($connect, "insert into merchant set name = '$name', email = '$email', password = '$password', verified = 'No', balance = '0', referral = '$refercode', log_count = '0', business_category = '$business_cat'");

if($insert){
	$correct = 'Signup successful. Kindly check your email for your account verification link';
    $crr = base64_encode($correct);
    $getid = mysqli_query($connect, "select * from merchant where email = '$email'");
    $rget = mysqli_fetch_assoc($getid);
    $id = $rget['id'];

	mysqli_query($connect, "insert into delivery set state = 'Abia', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Adamawa', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Akwa Ibom', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Anambra', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Bauchi', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Bayelsa', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Benue', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Borno', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Cross River', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Delta', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Ebonyi', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Edo', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Ekiti', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Enugu', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'FCT', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Gombe', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Imo', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Jigawa', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Kaduna', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Kano', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Katsina', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Kebbi', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Kogi', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Kwara', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Lagos', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Nasarawa', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Niger', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Ogun', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Ondo', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Osun', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Oyo', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Plateau', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Rivers', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Sokoto', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Taraba', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Yobe', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'Zamfara', days = '1-3 days', fee = '0', merchant = '$id'");
	mysqli_query($connect, "insert into delivery set state = 'others', days = '1-3 days', fee = '0', merchant = '$id'");
	
	$en_email = base64_encode($email);
    $en_name = base64_encode($name);
    $subject = 'Complete your registration';
    $body = '

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	  <meta name="viewport" content="width=device-width, initial-scale=1" />

	<link href="https://DemoName.com/dist/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
	  <title>Oxygen Welcome</title>

	  <style type="text/css">
		/* Take care of image borders and formatting, client hacks */
		img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
		a img { border: none; }
		table { border-collapse: collapse !important;}
		#outlook a { padding:0; }
		.ReadMsgBody { width: 100%; }
		.ExternalClass { width: 100%; }
		.backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
		table td { border-collapse: collapse; }
		.ExternalClass * { line-height: 115%; }
		.container-for-gmail-android { min-width: 600px; }


		/* General styling */
		* {
		  font-family: Helvetica, Arial, sans-serif;
		}

		body {
		  -webkit-font-smoothing: antialiased;
		  -webkit-text-size-adjust: none;
		  width: 100% !important;
		  margin: 0 !important;
		  height: 100%;
		  color: #676767;
		}

		td {
		  font-family: Helvetica, Arial, sans-serif;
		  font-size: 14px;
		  color: #777777;
		  text-align: center;
		  line-height: 21px;
		}

		a {
		  color: #676767;
		  text-decoration: none !important;
		}

		.pull-left {
		  text-align: left;
		}

		.pull-right {
		  text-align: right;
		}

		.header-lg,
		.header-md,
		.header-sm {
		  font-size: 32px;
		  font-weight: 700;
		  line-height: normal;
		  padding: 35px 0 0;
		  color: #4d4d4d;
		}

		.header-md {
		  font-size: 24px;
		}

		.header-sm {
		  padding: 5px 0;
		  font-size: 18px;
		  line-height: 1.3;
		}

		.content-padding {
		  padding: 20px 0 30px;
		}

		.mobile-header-padding-right {
		  width: 290px;
		  text-align: right;
		  padding-left: 10px;
		}

		.mobile-header-padding-left {
		  width: 290px;
		  text-align: left;
		  padding-left: 10px;
		}

		.free-text {
		  width: 100% !important;
		  padding: 10px 60px 0px;
		}

		.block-rounded {
		  border-radius: 5px;
		  border: 1px solid #e5e5e5;
		  vertical-align: top;
		}

		.button {
		  padding: 30px 0;
		}

		.info-block {
		  padding: 0 20px;
		  width: 260px;
		}

		.block-rounded {
		  width: 260px;
		}

		.info-img {
		  width: 258px;
		  border-radius: 5px 5px 0 0;
		}

		.force-width-gmail {
		  min-width:600px;
		  height: 0px !important;
		  line-height: 1px !important;
		  font-size: 1px !important;
		}

		.button-width {
		  width: 228px;
		}

	  </style>

	  <style type="text/css" media="screen">
		@import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
	  </style>

	  <style type="text/css" media="screen">
		@media screen {
		  /* Thanks Outlook 2013! */
		  * {
			font-family: '.'Oxygen'.', '.'Helvetica Neue'.', '.'Arial'.', '.'sans-serif'.' !important;
		  }
		}
	  </style>

	  <style type="text/css" media="only screen and (max-width: 480px)">
		/* Mobile styles */
		@media only screen and (max-width: 480px) {

		  table[class*="container-for-gmail-android"] {
			min-width: 290px !important;
			width: 100% !important;
		  }

		  table[class="w320"] {
			width: 320px !important;
		  }

		  img[class="force-width-gmail"] {
			display: none !important;
			width: 0 !important;
			height: 0 !important;
		  }

		  a[class="button-width"],
		  a[class="button-mobile"] {
			width: 248px !important;
		  }

		  td[class*="mobile-header-padding-left"] {
			width: 160px !important;
			padding-left: 0 !important;
		  }

		  td[class*="mobile-header-padding-right"] {
			width: 160px !important;
			padding-right: 0 !important;
		  }

		  td[class="header-lg"] {
			font-size: 24px !important;
			padding-bottom: 5px !important;
		  }

		  td[class="header-md"] {
			font-size: 18px !important;
			padding-bottom: 5px !important;
		  }

		  td[class="content-padding"] {
			padding: 5px 0 30px !important;
		  }

		   td[class="button"] {
			padding: 5px !important;
		  }

		  td[class*="free-text"] {
			padding: 10px 18px 30px !important;
		  }

		  td[class="info-block"] {
			display: block !important;
			width: 280px !important;
			padding-bottom: 40px !important;
		  }

		  td[class="info-img"],
		  img[class="info-img"] {
			width: 278px !important;
		  }
		}
	  </style>
	</head>

	<body bgcolor="#f7f7f7">
	<table align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%">
	  <tr>
		<td align="left" valign="top" width="100%" style="background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;">
		  <center>
		  <img src="http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png" class="force-width-gmail">
			<table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff" background="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" style="background-color:transparent">
			  <tr>
				<td width="100%" height="80" valign="top" style="text-align: center; vertical-align:middle;">
				<!--[if gte mso 9]>
				<v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:80px; v-text-anchor:middle;">
				  <v:fill type="tile" src="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" color="#ffffff" />
				  <v:textbox inset="0,0,0,0">
				<![endif]-->
				  <center>
					<table cellpadding="0" cellspacing="0" width="600" class="w320">
					  <tr>
						<td class="pull-left mobile-header-padding-left" style="vertical-align: middle;">
						  <a href=""><img style="width: auto; height: 50px;" src="https://DemoName.com/images/logo.png" alt="logo"></a>
						</td>
						<td class="pull-right mobile-header-padding-right" style="color: #4d4d4d;">
						  <a href="https://twitter.com/DemoName?s=20"><img width="44" height="47" src="http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif" alt="twitter" /></a>
						  <a href="https://web.facebook.com/DemoName-110066434078482"><img width="38" height="47" src="http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif" alt="facebook" /></a>

						</td>
					  </tr>
					</table>
				  </center>
				  <!--[if gte mso 9]>
				  </v:textbox>
				</v:rect>
				<![endif]-->
				</td>
			  </tr>
			</table>
		  </center>
		</td>
	  </tr>
	  <tr>
		<td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
		  <center>
			<table cellspacing="0" cellpadding="0" width="600" class="w320">
			  <tr>
				<td class="header-lg">
				  Welcome to DemoName!
				</td>
			  </tr>
			  <tr>
				<td class="free-text">
				  Thank you for signing up with DemoName. We hope you enjoy your time with us. Verify your account by clicking on the button below.
				</td>
			  </tr>
			  <tr>
				<td class="button">
				  <div><!--[if mso]>
					<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:45px;v-text-anchor:middle;width:155px;" arcsize="15%" strokecolor="#ffffff" fillcolor="#b666d2 ">
					  <w:anchorlock/>
					  <center style="color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;">Verify Account</center>
					</v:roundrect>
				  <![endif]--><a class="button-mobile" href="https://DemoName.com/verify.php?en_email='.$en_email.'&en_name='.$en_name.'"
				  style="background-color:#b666d2 ;border-radius:5px;color:#ffffff;display:inline-block;font-family:'.'Cabin'.', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Verify Account</a></div>
				</td>
			  </tr>
			</table>
		  </center>
		</td>
	  </tr>
	  <tr>
		<td align="center" valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
		  <center>
			<table cellspacing="0" cellpadding="0" width="600" class="w320">
			  <tr>
				<td style="padding: 25px 0 25px">
				  <strong>DemoName</strong><br />
				  Plot 6 Akiogun Road<br>
					Victoria Island,<br>
					Lagos..<br>
				</td>
			  </tr>
			</table>
		  </center>
		</td>
	  </tr>
	</table>
	</body>
	</html>';


    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // More headers
    $headers .= 'From: <noreply@DemoName.com>' . "\r\n";
    mail($email,$subject,$body,$headers);
    header('Location: signin?crr='.$crr);
    exit;
	
	
	
}else{
	$error = "Fatal error";
	include('signup.php');
	exit;
}




?>