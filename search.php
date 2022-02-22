<?php 
session_start();
include('functions.php');

$search = $_GET['find'];
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
</head>

<body class="wow fadeIn">
	
<?php check_merchant($merchant); ?>
	
<div id="products">

	<div class="container">
	
		<div class="row">
		
			<div class="col-12">
				
				<h3 style="text-align: center">Search Results</h3>
			
				<div id="productlist">
				
					<div class="row">
					
						<?php product_search($merchant, $search); ?>
					
					</div>
				
				</div>
			
			</div>
		
		</div>
	
	</div>
	
</div>
	
</body>
</html>