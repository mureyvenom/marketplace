<?php
session_start();
require_once('functions.php');
$product_id = base64_decode($_GET['id']);
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
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
    
<title>Shop</title>
    
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
	
<script>

    sessionStorage.setItem("cartstatus", "closed");
    
</script>
	
</head>

<body>
	
<?php check_merchant($merchant); ?>
	
<div id="cart">

    <div class="container">
    
        <div class="row">
        
            <div class="col-12">
            
                <div class="table-responsive">
                
                    <table class="table table-bordered  customtable">
                    
                        <thead>
                        
                            <tr>
                            
                                <th>Product Name</th>
                            
                                <th>Product Size</th>
                            
                                <th>Product Color</th>
                            
                                <th>Quantity</th>
                            
                                <th>Unit Price</th>
                            
                                <th>Total</th>
                            
                                <th>Action</th>
                            
                            </tr>
                        
                        </thead>
                        
                        <tbody id="tbody">
                        
                            <?php get_cart(); ?>
                        
                        </tbody>
                        <?php
                        
                        $query = "select * from cart where order_id = '".$_SESSION['order_id']."'";
                        $run = mysqli_query($connect, $query);
                        $nrun = mysqli_num_rows($run);

                        if($nrun > 0){
                        
                        ?>
                        <tbody style="border: none;">
                        
                            <tr style="border:none">
                            
                                <td style="border:none;"></td>
                            
                                <td style="border:none;"></td>
                            
                                <td style="border:none;"></td>
                            
                                <td style="border:none;"></td>
                            
                                <td style="border: 1px solid #707070;"><strong>Sub Total</strong></td>
                            
                                <td style="border: 1px solid #707070;"><strong>&#8358;<span id="subtotal"><?php cart_subtotal() ?></span></strong></td>
                            
                                <td style="border:none;"></td>
                            
                            </tr>
                                                    
                        </tbody>
                        <?php
                            
                            
                        }
                        
                        ?>
                    
                    </table>
                    
                    <div class="row">
                        
                        <div class="col-md-6"></div>
                    
                        <div class="col-md-6">
                            
                            
                        
                        </div>
                    
<!--
                        <div class="col-md-6">
                            
                            <div class="form-group">
                        
                                <strong><label>How do you wish to get your order?</label></strong>
                            
                                <select onChange="deliveryType()" id="deltype" class="form-control">
                                
                                    <option value="">Select order type</option>
                                    
                                    <option value="pickup">Pickup</option>
                                    
                                    <option value="deliver">Delivered</option>
                                
                                </select>
                            
                            </div>
                        
                        </div>
-->
                    
                    </div>
                    
                    <div class="row">
                    
                        <div class="col-md-6"></div>
                    
                        <div class="col-md-6">
                            
                            <div class="row">
                            
                                <div class="col-6">
                                    
                                    <a href="/paycol_new/<?php echo $_SESSION['merchant']; ?>"><button class="btn11"><i class="fa fa-shopping-cart"></i> Continue Shopping</button></a>
                                
                                </div>
                            
                                <div class="col-6">
                                    
                                    <a href=" <?php if($nrun > 0){echo 'checkout?merchant='.$_SESSION['merchant']; }else{echo '#';} ?>"><button onClick="confirmOrder()" class="btn2"><i class="fa fa-check"></i> Checkout</button></a>
                                
                                </div>
                            
                            </div>
                            
                                                    
                        </div>
                    
                    </div>
                    
                    <p></p><br>
                
                </div>
            
            </div>
        
        </div>
    
    </div>
    
</div>

<?php include('myjs.php'); ?>
	
</body>
</html>