<?php
session_start();
include('connect.php');
include('fns.php');
include('functions.php');

$merchant = $_GET['merchant'];
if($_SESSION['merchant']){
	if($_SESSION['merchant'] == $merchant){
		
	}else{
		session_destroy();
		$_SESSION['merchant'] = $merchant;
	}
}else{
	$_SESSION['merchant'] = $merchant;
}
 
if(cart($_SESSION['order_id']) == '0')
{
    header("Location: cart.php");
}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
    
<title>Shop | Checkout</title>
    
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="dist/css/bootstrap.css">

<link href="dist/font-awesome/css/all.css" rel="stylesheet" type="text/css">

<link rel="icon" href="images/favicon.ico" />

<link href="dist/css/animate.css" rel="stylesheet">





<link href="dist/css/toastr.css" rel="stylesheet">
    
<script src="dist/js/jquery.3.4.1.min.js"></script>
    
<script src="dist/js/popper.js" type="text/javascript"></script>
    
<script src="dist/js/bootstrap.js" type="text/javascript"></script>

<script src="dist/js/owl.carousel.js"></script>

<script src="dist/js/toastr.js"></script>


<!-- Main Stylesheet -->

<link href="dist/style.css" rel="stylesheet" type="text/css" media="all">
    
<script src="dist/js/wow.min.js"></script>
<script>
new WOW().init();
</script>


<style>
	#product {
		background: #FFF;
	}
.checkout_page {
	background: none;
	font-size: 15px;
	color: #333 !important;
	font-family: dFont;
}
.checkout_page h3 {
	margin-top: 0px;
	margin-bottom: 30px;
	background: #F5F5F5;
	padding: 13px 10px;
	font-size: 15px;
	font-family: dFont;
	color: #000;
}
.checkout_page h4 {
	color: #333;
	font-family: dFont;
	font-size: 23px;
	margin-top: 0px;
	margin-bottom: 5px;
}
.checkout_page h5 {
	color: #000;
	font-family: dFont;
	font-size: 18px;
	margin-top: 0px;
	margin-bottom: 25px;
}
.checkout_page table {
	background: #FFF;
}
.checkout_page table tr td {
	vertical-align: inherit;
}
/* #checkout-accordion {
	
} */
#checkout-accordion .panel {
	margin-bottom: 20px;
	background: #333;
	padding-top: 10px;
	padding-bottom: 10px;
	border: none;
	border-radius: 0px;
}
#checkout-accordion a {
	padding-left: 10px;
	color: #FFF;
}
#checkout-accordion a:hover {
	text-decoration: none;
}
#checkout-accordion .accordion-body {
	background: #f1f1f1;
	margin-bottom: -10px;
	margin-top: 10px;
	padding: 10px 15px;
	font-family: aFont;
}
#checkout-accordion .indicator .icon {
	height: 15px;
	margin-top: 0px;
	position: absolute;
	top: 0px;
	width: 15px;
	right: 10px;
}

#checkout-accordion .panel > .accordion-head .collapsed .indicator .icon .hr-line, .panel > .accordion-head .collapsed .indicator .icon .vr-line {
	background: url(../images/icon-plus.png) no-repeat top;
}
#checkout-accordion .indicator .icon .vr-line {
	display: block;
	transition: all 250ms ease 0s;
}
#checkout-accordion .indicator .icon .hr-line {
	background: url(../images/icon-minas.png) no-repeat top;
	display: block; 
	height: 15px;
	transition: all 250ms ease 0s;
	width: 15px;
}
.checkout_page .btn1 {
	font-family: dFont;
	background: #555;
	font-size: 14px !important;
	color: #FFF;
	border-radius: 0px;
	padding: 7px 38px;
	margin-top: 10px;
}
#checkout-accordion .panel > .accordion-head {
	color: #FFF;
	font-family: dFont;
	font-size: 15px;
}
#checkout-accordion .panel > .accordion-head.collapsed { color: #FFF;}
#checkout-accordion .panel > .accordion-head.collapsed .indicator .icon .hr-line, .panel > .accordion-head.collapsed .indicator .icon .vr-line {background:url(../images/icon-plus.png) no-repeat top;}
#checkout-accordion .indicator .icon .vr-line {  display:block; transition:all 250ms ease 0s; }
#checkout-accordion .indicator .icon .hr-line {background:url(../images/icon-minas.png) no-repeat top; display: block; height:15px;  transition: all 250ms ease 0s; width: 15px;}

#checkout-accordion .panel > .accordion-head {display: block; position: relative; text-decoration: none; transition: all 250ms ease 0s;}

.div-radius {
	border: thin #AAA solid;
	padding: 15px;
	margin-bottom: 35px;
}
.text-danger{
	color: red;
}
.review_page {
	text-align: left !important;
	font-size: 14px !important;
}
.review_page table {
	background: #FFF;
	text-align: left !important;
}
.review_page table tr td {
	vertical-align: inherit;
	text-align: left !important;
}
.review_page h4 {
	text-align: left !important;
}
.checkout {
	border: thin solid #666;
	padding: 15px;
	margin-top: 15px;
	font-family: dFont;
	font-size: 14px;
}
.wpb_wrapper tr td {
	font-size: 20px;
}

/*---------------Accordion------------------*/
.accordingpart .panel-group .panel + .panel {margin-top:0px; }
/* .accordingpart {} */
.accordingpart .indicator {height: auto; min-height: 100%; position: absolute; left: 0px; top: 0; width: 15px;}
.accordingpart .panel {box-shadow:none; }
.accordingpart .panel-group .panel {border-radius: 4px; margin-bottom: 0; overflow: hidden;}
.accordingpart .panel {border-bottom:1px solid #e7e7e7 !important;  margin-bottom:0px !important; background-color: #fff; }
.accordingpart .panel-heading {  padding: 10px 15px 10px 0px;}
.accordingpart .panel-body {  padding: 15px 15px 15px 0px; line-height:24px;}
.accordingpart .panel > .panel-heading {color: #ffffff; padding-left:30px;}
.accordingpart .panel > .panel-heading.collapsed { background-color: transparent; color: #313447;}
.accordingpart .panel > .panel-heading {color: #000; display: block; position: relative; text-decoration: none; transition: all 250ms ease 0s;}
.accordingpart .indicator .icon {height: 15px; margin-top:0px; position: absolute; top: 14px; width: 15px;}
.accordingpart .panel > .panel-heading.collapsed .indicator .icon .hr-line, .panel > .panel-heading.collapsed .indicator .icon .vr-line {background:url(../images/sicon-plus.png) no-repeat top;}
.accordingpart .indicator .icon .vr-line {  display:block; transition:all 250ms ease 0s; }
.accordingpart .indicator .icon .hr-line {background:url(../images/sicon-minas.png) no-repeat top; display: block; height:15px;  transition: all 250ms ease 0s; width: 15px;}

/*-------------Accordion-End-----------------*/
</style>
    
<script>

    sessionStorage.setItem("cartstatus", "closed");
    
</script>
	
</head>

<body>
    
<?php check_merchant($merchant); ?>
    
<div id="product">
	<div class="container">
		<div class="row">
		
            <p></p><br>
            <p></p><br>
			
			
			<div class="col-md-12">
    		<?php 
			if($error)
			{
				echo '<font color="#ff0000"><span class="fa fa-remove"></span> <strong>'.$error.'</strong></font>';
				echo '<br><br>';
			}
			?>
			
			<?php 
			if($correct)
			{
				echo '<font color="green"><span class="glyphicon glyphicon-ok"></span> <strong>'.$correct.'</strong></font>';
				echo '<br><br>';
			}
			
			if($loginmsg)
			{
				echo '<span class="text-success" style="font-size:20px;">
				<span class="glyphicon glyphicon-ok"></span> '.$loginmsg.'</span><p></p>';
			}
			?>
			
            </div>   
            
        	<div class="col-md-5">
            <form action="initialize" role="form" enctype="multipart/form-data" class="form-horizontal" method="post">  
                <!-- Checkout Accordion -->
				<div id="checkout-accordion" class="panel-group">
					
					<!-- Billing Method -->
					<div class="panel single-accordion">
						<a class="accordion-head collapsed" data-toggle="collapse">BILLING INFORMATION                                         
                        </a>
						<div id="billing-method" class="in">
							<div class="accordion-body billing-method">
                            
								
                            <div class="register_checkout">
                            <div class="form-group"> 
                            <div class="col-md-12">                  
                            <label>First Name:</label> 
                            <input name="firstname" class="form-control" required="required" value="<?php echo $firstname; ?>" type="text" placeholder="Enter your first name here">
                            </div>
                            </div>
                            
                            
                            <div class="form-group"> 
                            <div class="col-md-12">
                            <label>Last Name:</label> 
                            <input name="lastname" class="form-control" required="required" value="<?php echo $lastname; ?>" type="text" placeholder="Enter your last name here">
                            </div>
                            </div>
                            
                            
                            <div class="form-group"> 
                            <div class="col-md-12">
                            <label>Email Address:</label> 
                            <input name="email" class="form-control" required="required" value="<?php echo $email; ?>" type="email" placeholder="Enter your email address">
                            </div>
                            </div>
							
						                            
                            <div class="form-group"> 
                            <div class="col-md-12">
                            <label>Phone:</label> <input name="tel" class="form-control" required="required" type="text" value="<?php echo $tel; ?>" placeholder="Enter your phone number here">
                            </div>
                            </div>
                                
<!--
                            <div class="form-group">
                            <div class="col-md-12"><input name="location" type="checkbox" id="location" onClick="getLocation()" value="inter"> <span><strong>Click for international delivery</strong></span></div>    
                            </div>
-->
                                                      
                            <div id="local">
                            
                            <div class="form-group">
                            <div class="col-md-12"> 
                            <label>Address:</label> 
                            <textarea id="address" name="address" class="form-control"  placeholder="Enter your delivery address"><?php echo $address; ?></textarea>
                            </div>
                            </div>
                            
                            
                            <div class="form-group">
                            <div class="col-md-12">
                            <label>City:</label> 
                            <input id="city" name="city" class="form-control" type="text" value="<?php echo $city; ?>" placeholder="Enter your city here">
                            </div>
                            </div>
								
								
							<div class="form-group">   
							<div class="col-md-12">
							<label>State:</label> 
							<select name="state" class="form-control" id="state" required>
							<option value="">------- Select State -------</option>
							<?php if($state){echo '<option selected value="'.$state.'">'.$state.'</option>';} ?>
							<?php if($_POST['state'] != "") {?>
								<option selected="selected"><?php echo $_POST['state'];?></option>
								<?php } ?>
								<?php list_state(); ?>
							</select>
							</div>
							</div> 
								
								<div class="form-group">
								
									<div class="col-md-12">
									
										<label>Coupon Code</label>
										
										<input type="text" name="coupon" id="coupon" class="form-control" placeholder="Enter valid coupon code">
									
									</div>
								
								</div>
                                
                            </div>
  
                            
                            <p></p>
                            
                            </div>
                                
                                
                                
							</div>
						</div>
					</div>
					
					
						
				</div>
			</div>
               
            
        
        	<div class="col-md-7">
            	<h3>YOUR ORDER(S)</h3>
                
                  
			<?php
                $query = "select * from cart where order_id = '".$_SESSION['order_id']."'";
                $result = mysqli_query($connect, $query);
                $num = mysqli_num_rows($result);
            ?>
			<div class="table-responsive">
              <table id="check-table" class="table table-bordered table-striped">
               <thead>
                  <tr>
                    <th>PRODUCT</th>
                    <th>QUANTITY</th>
                    <th>SIZE</th>
                    <th>COLOR</th>
                    <th>PRICE</th>
                    <th>TOTAL</th>                      
                  </tr>
                </thead>
                    <?php
                        for($i=0; $i<$num; $i++)
                        {
                            $row = mysqli_fetch_array($result);
                    ?>
                <tbody>
                
                    <tr>
                        <td class="cart_description">
                            <h4><?php echo strtoupper(product_col($row['product_id'],'name')); ?> </h4> 
                            
                            <p></p>
                            <small>Product ID: &nbsp; <strong>#<?php echo $row['product_id']; ?></strong></small>
                        </td>
                        <td class="cart_price">
                            <?php echo $row['quantity']; ?> 
                        </td>
                        <td class="cart_price">
                            <?php echo $row['product_size']; ?> 
                        </td>
                        <td class="cart_price">
                            <?php echo $row['color']; ?> 
                        </td>
                        <td class="cart_price">
                            &#8358; <?php echo $row['price']; ?>
                        </td>
                        <td class="cart_total">
                            &#8358; <?php echo number_format(multiply($row['price'],$row['quantity']));?>
                        </td>
                    </tr>
                    <?php
                        }
                        ?>
                        
                        
                    <tr>
                        <td class="cart_description">
                        </td>
                        <td class="cart_price">
                        </td>
                        <td class="cart_total">
                        </td>
                        <td class="cart_total">
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="cart_description">
                            <strong>Cart Total</strong> 
                        </td>
                        <td class="cart_price">
                            
                        </td>
                        <td class="cart_price">
                            
                        </td>
                        <td class="cart_price">
                            
                        </td>
                        <td class="cart_price">
                            
                        </td>
                        <td class="cart_total">
                            <span>&#8358;<?php echo $_SESSION['total'] = number_format(sum_cart($_SESSION['order_id'])); ?></span>
                            <span id="final" style="display: none"><?php echo sum_cart($_SESSION['order_id']); ?></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="cart_description">
                            <strong>Shipping Fee</strong> 
                        </td>
                        <td class="cart_price">
                            
                        </td>
                        <td class="cart_price">
                            
                        </td>
                        <td class="cart_price">
                            
                        </td>
                        <td class="cart_price">
                            
                        </td>
                        <td class="cart_total">
                            <span>&#8358;</span><span id="shippingfinal" class=""></span>
                        </td>
                    </tr>
                        
					</tbody>
                                    
				</table>
				
				</div>
                
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 text-right">					
                    <input type="hidden" value="<?php echo $row['id']; ?>" name="item_reference">
					
                    <input type="hidden" value="<?php echo product_col($row['product_id'],'name'); ?>" name="product">
					
                    <input type="hidden" value="<?php echo $row['quantity']; ?>" name="quantity">
					
                    <input type="hidden" value="" name="final" id="end">
					
                    <input type="hidden" value="<?php echo base64_decode($merch); ?>" name="merchant">
                    

                    <div style="padding-bottom: 10px;"><h5>TOTAL + SHIPPING FEE</h5>&#8358;<span id="checkprice"></span><span id="checkprice2"></span></div>
                    
                    <div style="padding-bottom: 10px;"><h5>Days to deliver</h5><span id="checkdays"></span></div>
					
					<input name="checkprice" type="hidden" id="inputcheck">

					
                    <!--<button type="button" id="validateCoupon" class="btn btn-primary">Validate Coupon</button>--> <input type="submit" class="btn btn-dark btn1" value="Continue" onclick="return confirm('Are you sure you want to place this order?');">
                    <p>&nbsp;</p>
					<p></p>
<!--					<div>Note that any coupon discount will only be calculated upon submission</div>-->
                </div>
            </div>
                 
            </div> 
            
            </form>   
			
			<div id="checking"></div>
		</div>
	</div>
</div>
	
<script>
	
	$('#validateCoupon').click(function(){
		var code = $('#coupon').val();
		document.getElementById("validateCoupon").innerHTML = '<div class="spinner-border spinner-border-sm"></div>';
		
		if(!code){
			alert("No coupon code to validate");
			document.getElementById("validateCoupon").innerHTML = "Validate Coupon";
			return false;
		}
		
		$.post("validate-coupon.php", {
			code:code
		}).done(function(data){
			obj = JSON.parse(data);
			let status = obj.status;
			let message = obj.message;
			let percentOff = obj.percent;
			document.getElementById("validateCoupon").innerHTML = "Validate Coupon";
			if(status == "success"){
				alert(message);
				document.getElementById("validateCoupon").remove();
			}else{
				alert(message);
			}
		})
		
	})
	
</script>
    
<?php 
    
$merchh = base64_decode($merch);
$locations = mysqli_query($connect, "select * from delivery");
$nlocations = mysqli_num_rows($locations);
    
for($x=0; $x<$nlocations; $x++){
    $rl = mysqli_fetch_assoc($locations);
    
?>
    
<p>
<script>

    $('#state').on('change', function(){
        if('<?php echo $rl['state']; ?>' === this.value){
            
            
            
            $('#checkprice').html(<?php echo sum_cart($_SESSION['order_id']) + $rl['fee']; ?>);
            
            $('#shippingfinal').html(<?php echo $rl['fee']; ?>);
            
            $('#checkdays').html('<?php echo $rl['days']; ?>');
            
            $('#end').val(<?php echo sum_cart($_SESSION['order_id']) + $rl['fee']; ?>);
            
            $('#inputcheck').val(<?php echo $rl['fee']; ?>);
            
        }else{
            
        }
    })
    
</script>
</p>    
<?php } ?>
    
<?php include('inc/footer.php'); ?>
    
</body>
</html>