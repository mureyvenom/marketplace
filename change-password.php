<?php
session_start();
require_once('connect.php');
$page = 'password';

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


$getcategories = "select * from categories where merchant = '$id'";
$categories = mysqli_query($connect, $getcategories);
$ncategories = mysqli_num_rows($categories);



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DemoName | Change Password</title>
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
                              
                              <div align="center"><h3>Change Password</h3></div>
                          
                          </div>
                      
                          <div class="card-body">
                          
                              <div class="edit-form" >

                                  <div class="col-md-1">&nbsp;</div>

                                  <div class="col-md-10">
                                  
                                      <form role="form" enctype="multipart/form-data" action="doPass" method="post">
                                  
                                          <div class="form-group">

                                              <label>Enter Old Password</label>
                                              
                                              <input type="password" class="form-control" required name="current">

                                          </div>
                                  
                                          <div class="form-group">

                                              <label>Enter New Password</label>
                                              
                                              <input value="" type="password" class="form-control" required name="new">

                                          </div>
                                  
                                          <div class="form-group">

                                              <label>Confirm New Password</label>
                                              
                                              <input value="" type="password" class="form-control" required name="confirm">

                                          </div>
                        
                                          <input type="hidden" name="merchant" value="<?php echo $row['id']; ?>">
                                  
                                          <div class="form-group">

                                              <button class="btn btn-primary">Change Password</button>

                                          </div>

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