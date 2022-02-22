<?php
session_start();
require_once('connect.php');

$page = 'dash';

if(!isset($_SESSION['user'])){
    $error = "No user session active";
    include('signin.php');
    exit;
}

$email = $_SESSION['user'];

$select = "select * from merchant where email = '$email'";
$doselect = mysqli_query($connect, $select);
$row = mysqli_fetch_assoc($doselect);
$id = $row['id'];

$account = $row['account'];

$nn = str_replace(" ", "%20", $row['name']);

$getproducts = "select * from products where merchant = '$id' order by id desc";
$products = mysqli_query($connect, $getproducts);
$nproducts = mysqli_num_rows($products);

$flutter_bank_list = mysqli_query($connect, "select * from flutter_bank_list order by name asc");
$nbank = mysqli_num_rows($flutter_bank_list);

$message = base64_decode($_GET['message']);

$crr = base64_decode($_GET['crr']);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DemoName | Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="admin_images/favicon.ico">
<!--  -->
<link href="admin_dist/bootstrap.css" rel="stylesheet" type="text/css">
<link href="admin_dist/paper-dashboard.css" rel="stylesheet" />
<link href="admin_dist/fontawesome.css" rel="stylesheet" />
<link href="admin_dist/all.css" rel="stylesheet" />
<link href="admin_dist/new.css" rel="stylesheet" />
<script src="admin_dist/bootstrap.min.js"></script>
<script src="admin_dist/perfect-scrollbar.jquery.min.js"></script>
<script src="admin_dist/jquery.3.4.1.min.js" type="text/javascript"></script>
<script src="admin_dist/popper.js" type="text/javascript"></script>
<script src="admin_dist/bootstrap.js" type="text/javascript"></script>
<script src="admin_dist/all.js" type="text/javascript"></script>
<script src="admin_dist/fontawesome.js" type="text/javascript"></script>
<!-- Chart JS -->
<script src="admin_dist/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="admin_dist/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="admin_dist/paper-dashboard.min.js" type="text/javascript"></script>
</head>

<body <?php if($row['log_count'] < 2 && $nproducts < 1 && !$account){ echo 'onLoad="showmodall3()"';} ?>  <?php if($errorx){ echo 'onLoad="showmodall3()"';} ?>>
<?php include('sidebar.php'); ?>
    
<div class="main-panel">
    
<div class="modal logmodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<!--
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
-->
      <div class="modal-body">
<!--        <p>Modal body text goes here.</p>-->
         
          <div class="total">
                  
              <div class="guide">
                      
                  Welcome to DemoName. Try these tips to get started
                      
              </div>
              <div class="host">
                  
              <div class="col-md-12">
                  
              <div class="row">
                      
                  <div class="col-md-4">
                          
                      <div class="row">
                              
                          <div class="tabs">
                                  
                              <div class="tab tab1">
                                      
                                  Setup Profile
                                      
                              </div>
                                  
<!--
                                      <div class="tab tab2">
                                      
                                          Add Products
                                      
                                      </div>
                                  
                                      <div class="tab tab3">
                                      
                                          Share Market Link
                                      
                                      </div>
-->
                                  
                          </div>
                              
                      </div>
                          
                  </div>
                      
                  <div class="col-md-8">
                          
                      <div class="row">
                              
                          <div class="tab-cont tab-cont1 col-md-12">
                                      
                              <div class="numx">
                                      
                                  You can add your phone number and your account number to ensure you start getting paid
                                          
                                  <div class="form">
                                              
                                      <?php if($errorx){ ?><p><div class="alert alert-danger"><?php echo $errorx; ?></div></p><?php } ?>
                                              
                                      <p id="checking"></p>
                                          
                                  <form role="form" enctype="multipart/form-data" method="post" action="doModal.php"a>
                                              
                                      <div class="form-group">
                                                  
                                          <input type="tel" name="phone" required placeholder="Enter your phone number" class="form-control">
                                                 
                                      </div>
                                              
                                      <div class="form-group">
                                                  
                                          <input onKeyDown="restart()" type="number" name="account" id="account" required placeholder="Enter your account number" class="form-control">
                                                  
                                      </div>
                                                  
                                      <div class="form-group">
                            
                                          <select onChange="restart()" id="bank" name="bank" required class="form-control">
                                          
                                              <option value="">Select Bank</option>
                                              
                                              <?php
                                              
                                              for($b=0; $b<$nbank; $b++){
                                                  $brow = mysqli_fetch_assoc($flutter_bank_list);
                                              
                                              ?>
                                              
                                              <option value="<?php echo $brow['code']; ?>"><?php echo $brow['name']; ?></option>
                                              
                                              <?php } ?>
                                          
                                          </select>
                        
                                      </div>
                                              
                                      <div class="form-group">
                                                  
                                          <button onClick="checkAccount()" id="verify" type="button" class="btn1">Verify</button>
                                                  
                                          <button style="display: none" id="submit" type="submit" class="btn1">Submit</button>
                                                 
                                      </div>
                                      
                                      <script>
                                      
                                          function restart(){
                                              $('#submit').hide();
                                              $('#verify').show();
                                              document.getElementById("checking").innerHTML = '';
                                          }
                                      
                                      </script>
                                      
                                      <script>
                                          function checkAccount(){
                                            var account = $('#account').val();
                                            var bank = $('#bank').val();
                                          document.getElementById("checking").innerHTML = '<div align="center" class="spinload"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';
                                              
                                          $.post("live-check.php",

                                                 {

                                              account: account,
                                              bank: bank

                                          },

                                                 function(data,status){

                                              if(data=='<div class="alert alert-danger">Incomplete Data Sent</div>'){
                                                  document.getElementById("submit").style.display= "none";
                                                  document.getElementById("verify").style.display= "block";
                                              }
                                              else if(data=='<div class="alert alert-danger">Invalid Account Number</div>')
                                              {
                                                  document.getElementById("submit").style.display= "none";
                                                  document.getElementById("verify").style.display= "block";
                                              }
                                              else if(data=='<div class="alert alert-danger">Unable to validate account details</div>')
                                              {
                                                  document.getElementById("submit").style.display= "none";
                                                  document.getElementById("verify").style.display= "block";
                                              }else{
                                                  document.getElementById("submit").style.display= "block";
                                                  document.getElementById("verify").style.display= "none";
                                              }
                                              document.getElementById("checking").innerHTML = data;
                                          }

                                                );
                                          }
                                      
                                      </script>
                                              
                                  </form>
                                         
                              </div>
                                      
                          </div>
                                  
                      </div>
                              
                      <div class="tab-cont tab-cont2">
                                  
                          Click <a href="add-products">Here</a> to create product items and specify details such as name, description, price and more<br><br>
                                      
                          <div align="center"><i class="fa fa-shopping-bag"></i></div>
                                  
                      </div>
                              
                      <div class="tab-cont tab-cont3">
                                  
                          Click <a href="view-products">Here</a> to view all your available products and also copy and share your market link so people can access your Shop and start buying.<br><br>
                                      
                          <div align="center"><i class="fa fa fa-shopping-cart"></i></div>
                                  
                      </div>
                              
                  </div>
                          
              </div>
                      
          </div>
                      
          </div>
                      
          </div>
                  
        </div>
       
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
    
       
<script>

    function showmodall(){
    
        var modalbox = document.getElementById("logcountbox");
        
        $('.logcountbox').modal('show');
    }

    function showmodall2(){
    
        var modalbox = document.getElementById("logcountbox");
        
        $('.logcountbox2').modal('show');
    }

    function showmodall3(){
    
        var modalbox = document.getElementById("logcountbox");
        
        $('.logmodal').modal('show');
    }
    
</script>
    
<script>
    
    

        $('.tab1').addClass('active');
    
        $('.tab-cont1').addClass('active');
        
        $( '.tab1' ).click( function () {
            $( ".tab" ).removeClass( 'active' );
            $( ".tab.tab1" ).addClass( 'active' );
            $( ".tab-cont" ).removeClass('active');
            $( ".tab-cont1" ).addClass('active');
            
        } );
        
        $( '.tab2' ).click( function () {
            $( ".tab" ).removeClass( 'active' );
            $( ".tab.tab2" ).addClass( 'active' );
            $( ".tab-cont" ).removeClass('active');
            $( ".tab-cont2" ).addClass('active');
            
        } );
        
        $( '.tab3' ).click( function () {
            $( ".tab" ).removeClass( 'active' );
            $( ".tab.tab3" ).addClass( 'active' );
            $( ".tab-cont" ).removeClass('active');
            $( ".tab-cont3" ).addClass('active');
            
        } );
    
    
    
</script>
      <!-- Navbar -->
      <?php include('header.php'); ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="row top-cards">
            
          <div class="col-lg-3 col-md-3">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fa fa-shopping-bag text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Products</p>
                      <p class="card-title"><?php echo $nproducts; ?><p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <a href="#"><div class="stats">
                  <i class="fa fa-eye"></i>
                  View Products
                </div></a>
              </div>
            </div>
          </div>
            
          <div class="col-lg-3 col-md-3">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fa fa-money-bill text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Total Orders</p>
                      <p class="card-title"><?php $get1 = mysqli_query($connect, "select * from completed where merchant = '$id' and payment_status = 'confirmed'"); echo mysqli_num_rows($get1); ?>
<!--                        <?php $totalamount = mysqli_query($connect, "SELECT SUM(actual_amount) AS totalfee FROM completed where merchant = '$id' and status = 'confirmed' and payment_status = 'confirmed'"); $tfee = mysqli_fetch_assoc($totalamount)['totalfee']; echo '- ₦'.number_format($tfee) ?>-->
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <a href="#"><div class="stats">
                  <i class="fa fa-money-bill"></i>
                  Track
                </div></a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fa fa-exclamation text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Pending Orders</p>
                      <p class="card-title"><?php $get2 = mysqli_query($connect, "select * from completed where merchant = '$id' and status = 'pending' and payment_status = 'confirmed'"); echo mysqli_num_rows($get2); ?>
<!--                          <?php $pendingamount = mysqli_query($connect, "SELECT SUM(actual_amount) AS pendingfee FROM completed where merchant = '$id' and status = 'pending' and payment_status = 'confirmed'"); $pfee = mysqli_fetch_assoc($pendingamount)['pendingfee']; echo '- ₦'.number_format($pfee) ?>-->
                          <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <a href="pending-orders"><div class="stats">
                  <i class="fa fa-eye"></i>
                  View
                </div></a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fa fa-check text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Confirmed Orders</p>
                      <p class="card-title"><?php $get3 = mysqli_query($connect, "select * from completed where merchant = '$id' and status = 'confirmed' and payment_status = 'confirmed'"); echo mysqli_num_rows($get3); ?><p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                  <a href="confirmed-orders">
                <div class="stats">
                  <i class="fa fa-eye"></i>
                  View
                </div></a>
              </div>
            </div>
          </div>
        </div>
          
          
          <div class="row">
          
              <div class="body-title col-md-12" align="center"><h3>View Products</h3></div>
          
          </div>
          
          <div id="products">
          
              <div class="row">
                  
                  <?php if($crr){ ?>
                  
                  <div class="col-md-12">
                  
                      <div class="card">
                      
                          <div class="card-body" align="center">
                          
                              <p><div class="alert alert-success alert-dismissible"><?php echo $crr ?></div></p>
                          
                          </div>
                      
                      </div>
                  
                  </div>
                  
                  <?php } ?>
                  
                  <?php if($message){ ?>
                  
                  <div class="col-md-12">
                  
                      <div class="card">
                      
                          <div class="card-body" align="center">
                          
                              <p><div class="alert alert-success alert-dismissible"><?php echo $message; ?></div></p>
                          
                          </div>
                      
                      </div>
                  
                  </div>
                  
                  <?php } ?>
                  
                  <?php if($nproducts<1){ ?>
                  
                  <div class="col-md-12">
                  
                      <div class="card">
                      
                          <div class="card-body">
                          
                              <div class="add-prod" align="center">
                          
                                  <a href="add-products"><button class="btn btn-primary" title="Add your first product">ADD YOUR FIRST PRODUCT <i class="fa fa-plus"></i></button></a>

                              </div>
                          
                          </div>
                      
                      </div>
                  
                  </div>
                  
                  <?php } ?>
                  
                  <?php
                
                    for($i=0; $i<$nproducts; $i++){
                        $prod = mysqli_fetch_assoc($products);
                        $pid = $prod['id'];
                        $image = mysqli_query($connect, "select * from product_image where product = '$pid' order by rand() limit 1");
                        $rimage = mysqli_fetch_assoc($image);
                        $image_name = $rimage['name'];

                  ?>
              
                  <div class="col-md-6">
                  
                      <div class="card">
                          
                          <div class="card-header ">
                            <div class="prod-name"><?php echo $prod['name']; ?></div>
                          </div>
                          <div class="card-body ">
                            <div class="prod-image" align="center">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                  <div class="img-cont" style="background-image: url('uploads/products/<?php echo $image_name; ?>');"></div>
                                  <!-- <img src="uploads/products/<?php echo $image_name; ?>" class="img-cont"> -->
                                </div>
                                <div class="col-md-2"></div>
                                </div><br>
                              <div class="prod-description" align="center"><?php if(strlen($prod['description']) > 50){echo substr( $prod['description'], 0, 49).'...';}else{ echo  $prod['description'];} ?></div>
                              <div class="prod-price" align="center"><?php echo '₦'.number_format($prod['price']); ?></div>
                          </div>
                          <div class="card-footer ">
                            <hr>
                            <div class="stats">
                              <div class="prod-actions" align="center">
                                
                                  <div class="row">
                                  
                                      <div class="col-md-4 col-sm-4"><a href="edit?product=<?php echo base64_encode($prod['id']); ?>&n=<?php echo base64_encode($prod['name']); ?>"><button class="btn btn-primary">Edit<br><i class="fa fa-pencil-alt"></i></button></a></div>
                                
                                      <div class="col-md-4 col-sm-4"><a href="delete?product=<?php echo base64_encode($prod['id']); ?>&n=<?php echo base64_encode($prod['name']); ?>" onclick="return confirm('Are you sure you want to delete this product?');"><button class="btn btn-danger">Delete<br><i class="fa fa-trash"></i></button></a></div>
                                      
                                        <?php

                                        if($prod['status'] == 'active'){

                                        ?>
                                
                                      <div class="col-md-4 col-sm-4"><a href="disable?product=<?php echo base64_encode($prod['id']); ?>&n=<?php echo base64_encode($prod['name']); ?>"><button class="btn btn-warning">Disable<br><i class="fa fa-stop-circle"></i></button></a></div>
                                      
                                      <?php } ?>
                                      
                                        <?php

                                        if($prod['status'] == 'disabled'){

                                        ?>
                                
                                      <div class="col-md-4 col-sm-4"><a href="enable?product=<?php echo base64_encode($prod['id']); ?>&n=<?php echo base64_encode($prod['name']); ?>"><button class="btn btn-success">Enable<br><i class="fa fa-play-circle"></i></button></a></div>
                                      
                                      <?php } ?>
                                  
                                  </div>
                                
                                </div>
                            </div>
                          </div>
                        </div>
                  
                  </div>
                  
                  <?php } ?>
              
              </div>
          
          </div>
          
      </div>
      <?php include('footer.php'); ?>
    
</body>
</html>