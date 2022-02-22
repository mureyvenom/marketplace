<?php
session_start();
require_once('connect.php');
$page = 'edit-pro';

$crr = $_GET['crr'];
$correct = base64_decode($crr);

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
$nn = str_replace(" ", "%20", $row['name']);
$bank_name = $row['bank_name'];
$bank_code = $row['bank_code'];
$account_number = $row['account'];

$getproducts = "select * from products where merchant = '$id'";
$products = mysqli_query($connect, $getproducts);
$nproducts = mysqli_num_rows($products);
$id = $row['id'];


$flutter_bank_list = mysqli_query($connect, "select * from flutter_bank_list order by name asc");
$nbank = mysqli_num_rows($flutter_bank_list);

$getcategories = "select * from categories where merchant = '$id'";
$categories = mysqli_query($connect, $getcategories);
$ncategories = mysqli_num_rows($categories);



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DemoName | Edit Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="admin_images/favicon.ico">

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

<body>
<?php include('sidebar.php'); ?>
    
<div class="main-panel">
      <!-- Navbar -->
      <?php include('header.php'); ?>
      <!-- End Navbar -->
      <div class="content">
        
          <div id="profile">
          
              <div class="row">
                  
                  <?php if($correct){ ?>
                  
                  <div class="col-md-12">
                  
                      <div class="card">
                      
                          <div class="card-body" align="center">
                          
                              <p><div class="alert alert-success"><?php echo $correct ?></div></p>
                          
                          </div>
                      
                      </div>
                  
                  </div>
                  
                  <?php } ?>
                  
                  <?php if($error){ ?>
                  
                  <div class="col-md-12">
                  
                      <div class="card">
                      
                          <div class="card-body" align="center">
                          
                              <p><div class="alert alert-danger"><?php echo $error; ?></div></p>
                          
                          </div>
                      
                      </div>
                  
                  </div>
                  
                  <?php } ?>
                  
                  <div class="col-md-12">
                  
                      <div class="card">
                          
                          <div class="card-header">
                              
                              <div align="center"><h3>Edit Profile</h3></div>
                          
                          </div>
                      
                          <div class="card-body">
                          
                              <div class="edit-form" >

                                  <div class="col-md-1">&nbsp;</div>

                                  <div class="col-md-10">
                                      
                                      <p id="checking"></p>
                                  
                                      <form role="form" enctype="multipart/form-data" action="doProfile.php" method="post">
                                  
                                          <div class="form-group">

                                              <label>Merchant Name</label>
                                              
                                              <input value="<?php echo $row['name'] ?>" type="text" class="form-control" required name="name">

                                          </div>
                                  
                                          <div class="form-group">

                                              <label>Account Name</label>
                                              
                                              <input value="<?php echo $row['firstname'] ?>" type="text" class="form-control" required name="fname" readonly>

                                          </div>
                                  
<!--
                                          <div class="form-group">

                                              <label>Lastname</label>
                                              
                                              <input value="<?php echo $row['lastname'] ?>" type="text" class="form-control" required name="lname">

                                          </div>
-->
                                  
                                          <div class="form-group">

                                              <label>Phone Number</label>
                                              
                                              <input value="<?php echo $row['phone'] ?>" type="tel" class="form-control" required name="phone">

                                          </div>
                                  
                                          <div class="form-group">

                                              <label>Account Number</label>
                                              
                                              <input id="account" onKeyDown="restart()" value="<?php echo $row['account'] ?>" type="number" class="form-control" required name="account">

                                          </div>
                                  
                                          <div class="form-group">
                                              
                                              <label>Bank Name</label>

                                              <select onChange="restart()" id="bank" name="bank" required class="form-control">
                                                  
                                                <?php
                                                  
                                                if($bank_name){
                                                  
                                                ?>
                                                  
                                                  <option value="<?php echo $bank_code; ?>"><?php echo $bank_name; ?></option>
                                                  
                                                  <?php
                                                    
                                                  }
                                                
                                                  ?>
                                          
                                              <option value="">Select Bank</option>
                                              
                                              <?php
                                              
                                              for($b=0; $b<$nbank; $b++){
                                                  $brow = mysqli_fetch_assoc($flutter_bank_list);
                                              
                                              ?>
                                              
                                              <option value="<?php echo $brow['code']; ?>"><?php echo $brow['name']; ?></option>
                                              
                                              <?php } ?>
                                          
                                          </select>

                                        </div>
                        
                        <input type="hidden" name="merchant" value="<?php echo $row['id']; ?>">
                                  
                                          <div class="form-group">

                                              <button class="btn btn-success" type="submit" id="submit" style="display: none">Update Profile</button>
                                              <button onClick="checkAccount()" class="btn btn-primary" type="button" id="verify">Verify Bank Details</button>

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

                                  <div class="col-md-1"></div>

                              </div>
                          
                          </div>
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
      </div>
      <?php include('footer.php'); ?>
      </div>
    
</body>
</html>