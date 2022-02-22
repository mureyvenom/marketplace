<?php
date_default_timezone_set('Africa/Lagos');

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

function host_name(){
return 'http://'.$_SERVER['HTTP_HOST'].'/';	
}

function company_name(){
  return 'Oando Coorporative';
}

function admin_name()
{
    return 'Oando Coorporative';
}

function admin_email()
{
    return 'info@oandocoop.com';
}

function domain(){
return $_SERVER['HTTP_HOST'];	
}

function host() {
	return 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']).'/';	
}


function session_user($fullname)
{
  if(!$fullname)
  {
    return 'Guest';
  }
  else
  {
    return $fullname;
  }
}

function today()
{
	return date('Y-m-d');
}


function mydate($date)
{
	$date = date('jS M, Y',strtotime($date));
	return 	$date;
}

function count_visit()
{	
	if(!isset($_SESSION['shopper']))
	{
		$_SESSION['shopper'] = getenv("REMOTE_ADDR");
		$query = "insert into counter set ip = '".$_SESSION['shopper']."'";
		include('connect.php'); 
		$result = mysqli_query($connect, $query);
		
	}
}


function sum_cart_totals($order_id)

{
	include('connect.php');
	$query = "select sum(price*quantity) from cart where order_id = '$order_id'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);	
	return $row['sum(price*quantity)'];
}




function now()
{
	return date('Y-m-d H:i:s');	
}


function time_stamp()
{
	return date('U');	
}


function cat_list()
{
	include('connect.php');
	$query = "select * from category order by category asc";
	$result = mysqli_query($connect, $query);
	$num = mysqli_num_rows($result);
	for($i=0; $i<$num; $i++)
	{
	$row = mysqli_fetch_array($result);
	echo '<option value="'.$row['id'].'">'.$row['category'].'</option>';
	
	}
}

function count_tab($tab)
{
	include('connect.php');
	$query = "select * from $tab";
	$result = mysqli_query($connect, $query);
	$num = mysqli_num_rows($result);
	return $num;
}

function count_tab_status($tab,$status)
{
	include('connect.php'); 
	$query = "select * from $tab where status = '$status'";
	$result = mysqli_query($connect, $query);
	$num = mysqli_num_rows($result);
	return $num;
}

function status_change($status)
{
  if($status == 'closed')
  {
    echo 'Pending';
  }
  else
  {
    echo 'Close';
  }
}


function cat_value($cat)
{
  $category = col_val('category', 'category', $cat);
  return $category;
}


function cat_list2($cat)
{
	include('connect.php'); 
	$query = "select * from category where id = '$cat'";
	$result = mysqli_query($connect, $query);
	$num = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
	
	return $row['category'];
}


function list_state()
{
	 echo '<option value="">Select State</option><option value="Abia">Abia </option><option value="Adamawa">Adamawa </option><option value="Akwa Ibom">Akwa Ibom </option><option value="Anambra">Anambra </option><option value="Bauchi">Bauchi </option><option value="Bayelsa">Bayelsa </option><option value="Benue">Benue </option><option value="Borno">Borno </option><option value="Cross River">Cross River </option><option value="Delta">Delta </option><option value="Ebonyi">Ebonyi </option><option value="Edo">Edo </option><option value="Ekiti">Ekiti </option><option value="Enugu">Enugu </option><option value="FCT">FCT</option><option value="Gombe">Gombe </option><option value="Imo">Imo </option><option value="Jigawa">Jigawa </option><option value="Kaduna">Kaduna </option><option value="Kano">Kano </option><option value="Katsina">Katsina </option><option value="Kebbi">Kebbi </option><option value="Kogi">Kogi </option><option value="Kwara">Kwara </option><option value="Lagos">Lagos </option><option value="Nasarawa">Nasarawa </option><option value="Niger">Niger </option><option value="Ogun">Ogun </option><option value="Ondo">Ondo </option><option value="Osun">Osun </option><option value="Oyo">Oyo </option><option value="Plateau">Plateau </option><option value="Rivers">Rivers </option><option value="Sokoto">Sokoto </option><option value="Taraba">Taraba </option><option value="Yobe">Yobe </option><option value="Zamfara">Zamfara </option><option value="others">others</option>';
}



function ship_cost($state)
{
	
	if($state == 'FCT' || $state == 'Rivers' || $state == 'Delta' || $state == 'Oyo' || $state == 'Ogun' || $state == 'Edo' || $state == 'Enugu' || $state == 'Ondo' || $state == 'Ekiti' || $state == 'Osun' || $state == 'Kwara')
	{
		$ship_cost = '1500';
	}
	elseif($state == 'Lagos')
	{
		$ship_cost = '1000';
	}
	else
	{
		$ship_cost = '2000';
	}	
	
	return $ship_cost;
	
}




function get_shipping($state)
{
	if($state == 'FCT')
	{
		return number_format('500');
	}
	elseif($state == 'Lagos')
	{
		return number_format('1250');
	}
	else
	{
		return number_format('1500');
	}
}


function getdelivery($state)
{
	if($state == 'Lagos')
	{
		$date=date_create(today());
		date_add($date,date_interval_create_from_date_string("2 days"));
		return date_format($date,"D jS M. Y");
	}
	else
	{
		$date=date_create(today());
		date_add($date,date_interval_create_from_date_string("5 days"));
		return date_format($date,"D jS M. Y");
	}
}



function cart_pro($order_id)
{
	include('connect.php'); 
	$query = "select * from cart where order_id = '$order_id'";
	$result = mysqli_query($connect,$query);
	$num = mysqli_num_rows($result);
  	$row = mysqli_fetch_array($result);
	return $row['product_id'];
}

function checkout($order_id)
{
	include('connect.php'); 
	$query = "select * from cart where order_id = '$order_id'";
	$result = mysqli_query($connect,$query);
	$num = mysqli_num_rows($result);
  	$row = mysqli_fetch_array($result);
	return $num;
}

function cart($order_id)
{
	include('connect.php'); 
	$query = "select sum(quantity) from cart where order_id = '$order_id'";
	$result = mysqli_query($connect,$query);
	$row = mysqli_fetch_array($result);
	return $row[0];
}


function product_col($id,$col)
{
	include('connect.php'); 
	$query = "select * from products where id = '$id'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	return $row[$col];
}

function stock_status($id)
{
	include('connect.php'); 
  $query = "SELECT sum(quantity) FROM `size_tab` where product_id = '$id'";
  $result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
  if($row['sum(quantity)'] > 0)
  {
    return 'In Stock';
  }
  else{
    return '<font color="red">Out of Stock</font>';
  }
}

function item_status($id,$size)
{
	include('connect.php'); 
  $query = "SELECT * FROM `size_tab` where product_id = '$id' and size='$size'";
  $result = mysqli_query($connect,$query);
  $row = mysqli_fetch_array($result);
  if($row['quantity'] >= 0)
  {
    return $row['quantity'].' in Stock';
  }
  else{
    return '<font color="red">Exceeded stock</font>';
  }
}

function update_stock($id,$size,$type,$num)
{
   if($type=='add')
   {
      mysqli_query($connect,"update size_tab set quantity = quantity+$num where product_id = $id and size = '$size'");
   }
   else{

      mysqli_query($connect,"update size_tab set quantity = quantity-$num where product_id=$id and size = '$size'");
   }
}

function multiply($num1,$num2)
{
	$total = $num1*$num2;	
	return $total;
}

function sum($num1,$num2)
{
	$total = $num1+$num2;	
	return $total;
}



function sum_cart($order_id)
{
	include('connect.php');
	$query = "select sum(price*quantity) from cart where order_id = '$order_id'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);	
	return $row['sum(price*quantity)'];
}

function col_val($tab, $col_name, $id)
{
	include('connect.php'); 
  $query = "select * from $tab where id = '$id'";
  $result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
  return $row[$col_name];
}

function size_box($product_id)
{
	include('connect.php'); 
  $query = "select * from size_tab where product_id = '$product_id'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
  if($num>0)
  {
  		for($i=0; $i<$num; $i++)
  		{
			$row = mysqli_fetch_array($result);
      		echo '<div class="box_size">'.$row['size'].'</div>';
			}
  } 
  else{
    echo 'no size specified';
  } 
}

function size_dropdown($product_id)
{
	include('connect.php'); 
  $query = "select * from size_tab where product_id = '$product_id'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
  if($num>0)
  {
  		for($i=0; $i<$num; $i++)
  		{
			$row = mysqli_fetch_array($result);
      		echo '<option>'.$row['size'].'</option>';
			}
  } 
  else{
    echo 'no size specified';
  } 
}

function get_item_list($order_id)
{
	include('connect.php'); 
	$query = "select * from cart where order_id = '$order_id'";
	$result = mysqli_query($connect, $query);
	$num = mysqli_num_rows($result);
	for($i=0; $i<$num; $i++)
	{
		$row = mysqli_fetch_array($result);
		$item[] = col_val('product','product_name', $row['product_id']).' X '.$row['quantity'].' = N'.$row['price'];
	}
	$items = implode('<br>',$item);
	return $items;
}



function lu_ucwords($word)
{
	return ucwords(strtolower($word));
}

function checkfile($file, $file_type)
{
	$ext = get_extension($file);  
	
	if($file_type == 'pics')  
	{
		$compare = array('jpg','gif');
		if (!in_array(strtolower($ext), $compare))
		{
			return 'error';
		}
	}
}

function get_extension($file)
{
      $extension = explode('.',$file);
      $ext = array_reverse($extension); 
      return $ext[0];
}



function get_eventname($id)
{
	include('connect.php'); 
	$query = "select * from events where id = '$id'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	return $row['event_name'];
}

function get_eventbanner($id)
{
	include('connect.php'); 
	$query = "select * from events where id = '$id'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	return $row['banner_img'];
}

function get_content($id)
{
	include('connect.php'); 
	$query = "select * from events where id = '$id'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	return $row['content'];
}


function fulldate($date)
{
	$dt = strtotime($date);
	return date('F  d, Y',$dt);
}



function welcome_mail_cod($fname,$email,$amount,$items)
{
		
		$subject = 'Thanks For Ordering.';
		// News Letter Msg
		$mailcontent  = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
      <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:500,700,400,300" type="text/css">
      <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
</head>

<body style="font-family:Raleway;">
<div style="width:100%; background-color:#CCCCCC; padding:20px;">
	<div style="width:700; margin:auto; padding:20px; background:#FFFFFF;">
    	 <div style="float:left; margin-bottom:10px;"><img src="'.host().'admin_images/logo.png"></div>
    	 <div style="clear:both"></div>
         <div style="margin-bottom:10px;"></div>
         <div id="blue_area" style="background-color:#010E42; padding:15px; padding-bottom:20px;">
         	<div id="white_area" style="background-color:#FFFFFF; padding:20px;">
        		 <div style="font-size:30px; text-transform:uppercase; color:#FF3300; margin-top:20px; margin-bottom:10px; text-align:center;">ORDER RECEIVED!</div>
            	<div id="username" style="font-size:20px; color:#010E42;">Dear '.$fname.',</div>
         		<div style="font-size:20px; color:#010E42;">
                <div>
  <h2>Thank You for your order.<br />
    We hope you enjoyed shopping with us.</h2>
	<h3>
	<h3>Your Order ID is: #'.$_SESSION['ref_id'].' </h3>  
    <h3>Your Order Is:  '.$items.'</h3>
    <h3>Cost of items ordered: N'.$amount.'</h3>
    
	One of our agent will contact you shortly to confirm your order before shippment.    
	<p></p>

	</h3>
</div>

<div>
  <p>Thank you for choosing Oando Corporative...</p>
  <p>If you have any questions at all, send us an email <a href="mailto:info@oandocoop.com">info@oandocoop.com</a> </p>
</div>
<br>
       		  </div>
       	   </div><!-- White area ends here -->
    <div style="color:#FFF; margin-top:20px; margin-bottom:20px;">
    	<div style="text-align:center; font-size:36px;"></div>
    </div>
    
    <div style="clear:both;"></div>
         </div><!-- Blue area ends here -->
         <div id="copyright" style="font-size:10px; margin-top:5px;"></div>
    <div style="clear:both;"></div>
    </div>
</div>
</body>
</html>';


		$headers = "MIME-Version: 1.0" . "\n";
		$headers .= "Content-type:text/html" . "\n";
		// More headers
		$headers .= "From: ".company_name()." <noreply@".domain().".com>" . "\r\n";
		mail($email, $subject, $mailcontent, $headers); 
        return $mailcontent;
}




function welcome_mail_bf($fname,$email,$items)
{
		
		$subject = 'Thanks For Ordering on Black Friday Offers.';
		// News Letter Msg
		$mailcontent  = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
      <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:500,700,400,300" type="text/css">
      <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
</head>

<body style="font-family:Raleway;">
<div style="width:100%; background-color:#CCCCCC; padding:20px;">
	<div style="width:700; margin:auto; padding:20px; background:#FFFFFF;">
    	 <div style="float:left; margin-bottom:10px;"><img src="'.host().'admin_images/logo.png"></div>
    	 <div style="clear:both"></div>
         <div style="margin-bottom:10px;"></div>
         <div id="blue_area" style="background-color:#010E42; padding:15px; padding-bottom:20px;">
         	<div id="white_area" style="background-color:#FFFFFF; padding:20px;">
        		 <div style="font-size:30px; text-transform:uppercase; color:#FF3300; margin-top:20px; margin-bottom:10px; text-align:center;">ORDER RECEIVED!</div>
            	<div id="username" style="font-size:20px; color:#010E42;">Dear '.$fname.',</div>
         		<div style="font-size:20px; color:#010E42;">
                <div>
  <h2>Thank You for your order.<br />
    We hope you enjoyed shopping with us.</h2>
	<h3>
	<h3>Your Order ID is: #'.$_SESSION['ref_id'].' </h3>  
    <h3>Your Order Is:  '.$items.'</h3>
    
	One of our agent will contact you shortly to confirm your order before shippment.    
	<p></p>
	</h3>
</div>

<div>
  <p>Thank you for choosing Oando Corporative...</p>
  <p>If you have any questions at all, send us an email <a href="mailto:info@oandocoop.com">info@oandocoop.com</a> </p>
</div>
<br>
       		  </div>
       	   </div><!-- White area ends here -->
    <div style="color:#FFF; margin-top:20px; margin-bottom:20px;">
    	<div style="text-align:center; font-size:36px;"></div>
    </div>
    
    <div style="clear:both;"></div>
         </div><!-- Blue area ends here -->
         <div id="copyright" style="font-size:10px; margin-top:5px;"></div>
    <div style="clear:both;"></div>
    </div>
</div>
</body>
</html>';


		$headers = "MIME-Version: 1.0" . "\n";
		$headers .= "Content-type:text/html" . "\n";
		// More headers
		$headers .= "From: ".company_name()." <noreply@".domain().".com>" . "\r\n";
		mail($email, $subject, $mailcontent, $headers); 
        return $mailcontent;
}






function send_mail($to, $subject, $mail_heading, $content)
{
  
$mailcontent  = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>newsletter</title>
<style type="text/css">
body {
  margin: 0px;
  background-color: #F5F5F5;
}
#container {
  background-color: #fffff;
  width: 600px;
  margin-right: auto;
  margin-left: auto;
  border-top-width: 1px;
  border-right-width: 1px;
  border-bottom-width: 1px;
  border-left-width: 1px;
  border-top-color: #CCC;
  border-right-color: #CCC;
  border-bottom-color: #CCC;
  border-left-color: #CCC;
  background-repeat: repeat-x;
}
#banner {
  height: 93px;
  margin-top: 10px;
  margin-right: auto;
  margin-left: auto;
  background-color: #7DB701;
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  font-size: 36px;
  color: #FFF;
  padding-top: 45px;
  padding-left: 30px;
  background-image: url('.host().'/img/banner_bg.jpg);
  background-repeat: no-repeat;
  background-position: bottom;
}
#footer {
  font-family: "Tw Cen MT";
  font-size: 10px;
  color: #999;
  margin-top: 10px;
  margin-bottom: auto;
  background-color: #F5F5F5;
  padding-left: 10px;
}
#text {
  font-family: "Segoe UI", Tahoma;
  font-size: 13px;
  padding-top: 20px;
  padding-right: 20px;
  padding-bottom: 100px;
  padding-left: 20px;
  color: #333;
  background-color: #FFF;
}

.hi {
  font-family: "Tw Cen MT";
  font-size: 14px;
  font-weight: bold;
  color: #666;
}

.clear {
  clear:both;
}

#logo {
  position: relative;
  height: 58px;
  width: 176px;
  margin-right: auto;
  margin-top: 25px;
  margin-bottom: 0px;
  background-repeat: repeat-x;
  text-align: center;
}

</style>
</head>

<body>
<div id="container">
  <div id="logo"><img src="'.host().'/admin_images/logo.png" /></div>
  <div class="clear"></div>
  <div id="banner">'.$mail_heading.'</div>
  <div id="text">
    '.$content.'
  <br>
      <br>
    <br>
      Regards,<br />
      '.company_name().'
  </div>
  <div id="footer">Please do not reply to ths email. Email sent to this address will not be answered.<br />
  copyright '.date('Y').' '.domain().'. All Right Reserved</div>



</div>
</body>
</html>';


$headers = "MIME-Version: 1.0" . "\n";
$headers .= "Content-type:text/html" . "\n";
$headers .= "From: no_reply@".domain()."\r\n";
   
mail($to,$subject,$mailcontent,$headers); 
return $mailcontent;
}



?>