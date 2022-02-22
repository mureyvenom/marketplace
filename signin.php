<?php
session_start();
require_once('functions.php');
$crr = base64_decode($_GET['crr']);

if($_SESSION['user']){
	header('Location: dashboard.php');
	exit;
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
    
<title>DemoName</title>
    
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
    
<?php include('inc/header2.php'); ?>
    
<div id="signup1">

    <div class="container">
    
        <div class="row">
        
            <div class="col-md-2"></div>
            
            <div class="col-md-8">
            
                <div id="detailholder">
                
                    <div id="detailbox">
                    
                        <div class="form">
							
							<?php if($crr){ ?><p><div class="alert alert-success"><?php echo $crr; ?></div></p><?php } ?>
							
							<?php if($error){ ?><p><div class="alert alert-danger"><?php echo $error; ?></div></p><?php } ?>
                    
                            <form method="post" action="processSignin.php">
                                                
                                <div class="form-group">
                                
                                    <div class="col-12">
                                    
                                        <div class="row">

                                            <div class="col-2" align="center">

                                                <i class="fa fa-envelope"></i>

                                            </div>

                                            <div class="col-10">

                                                <input id="email" type="email" placeholder="Enter your email" name="email" class="formfield">

                                            </div>

                                        </div>
                                    
                                    </div>
                                
                                </div>
                        
                                <div class="form-group">
                                
                                    <div class="col-12">
                                    
                                        <div class="row">

                                            <div class="col-2" align="center">

                                                <i class="fa fa-key"></i>

                                            </div>

                                            <div class="col-10">

                                                <input id="password" type="password" name="password" required placeholder="Enter your password" class="formfield">

                                            </div>

                                        </div>
                                    
                                    </div>
                                
                                </div>
                        
                                <div class="form-group">
                                
                                    <div class="col-12">
                                    
                                        <div class="row">

                                            <div class="col-12">

                                                <button class="btn1" type="submit">Signin</button>

                                            </div>

                                        </div>
                                    
                                    </div>
                                
                                </div>
                        
                            </form>
                        
                        </div>
                    
                    </div>
                
                </div>
            
            </div>
            
            <div class="col-md-2"></div>
        
        </div>
    
    </div>
    
</div>
    
<?php include('inc/footer.php'); ?>
    
</body>
</html>