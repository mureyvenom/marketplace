<?php
session_start();
require_once('connect.php');
$page = 'payouts';

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

$getproducts = "select * from products where merchant = '$id'";
$products = mysqli_query($connect, $getproducts);
$nproducts = mysqli_num_rows($products);

$getorders = "select * from payouts where merchant = '$id'";
$orders = mysqli_query($connect, $getorders);
$norders = mysqli_num_rows($orders);

$message = base64_decode($_GET['message']);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DemoName | Confirmed Payouts</title>
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
                              
                              <div align="center"><h3>Confirmed Payouts</h3></div>
                          
                          </div>
                      
                          <div class="card-body">
                          
                              <div id="dataTables-example">
                              <table class="table-bordered table" >
                    
                        <thead>
                        
                            <tr>
                            
                                <th>No.</th>
                                
                                <th>Order ID</th>
                                
                                <th>Reference</th>
                                
                                <th>Date Created</th>
                                
                                <th>Amount</th>
                            
                            </tr>
                        
                        </thead>
                        
                        <tbody>
                            
                            <?php
                            
                            for($i=0; $i<$norders; $i++){
                                $ord = mysqli_fetch_assoc($orders);
                            
                            ?>
                        
                            <tr>
                            
                                <td><?php echo $i+1; ?></td>
                            
                                <td><?php echo $ord['order_id']?></td>
                            
                                <td><?php echo $ord['reference']; ?></td>
                            
                                <td><?php echo $ord['date']; ?></td>
                            
                                <td><?php echo '₦'.$ord['amount']; ?></td>
                            
<!--                                <td><a href="view-order.php?id=<?php echo base64_encode($ord['id']); ?>" class="btn btn-warning" style="border-radius: 0px;">View Order</a> </td>-->
                                
<!--
                                <td>
                                    
                                    <a href="terminate.php?id=<?php echo base64_encode($ord['id']); ?>" class="btn btn-danger" style="border-radius: 0px;">Terminate Order <i class="fa fa-remove"></i></a> 
                                    
                                    <a href="view-order.php?id=<?php echo base64_encode($ord['id']); ?>" class="btn btn-warning" style="border-radius: 0px;">View Order</a> 
                                    
                                    <a href="confirm.php?id=<?php echo base64_encode($ord['id']); ?>" class="btn btn-success" style="border-radius: 0px;">Confirm Order <i class="fa fa-check"></i></a> </td>
-->
                            
                            </tr>
                            
                            <?php } ?>
                            
                            <?php
                            
                            if($norders < 1){
                                echo 'No data found';
                                
                            }
                            
                            ?>
                        
                        </tbody>
                    
                    </table>
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