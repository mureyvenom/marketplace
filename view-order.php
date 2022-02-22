<?php
session_start();
require_once('connect.php');

if(!isset($_SESSION['user'])){
    $error = "No user session active";
    include('signin.php');
    exit;
}

$order_ = base64_decode($_GET['id']);

$email = $_SESSION['user'];

$select = "select * from merchant where email = '$email'";
$doselect = mysqli_query($connect, $select);
$row = mysqli_fetch_assoc($doselect);
$id = $row['id'];

$nn = str_replace(" ", "%20", $row['name']);

$getproducts = "select * from products where merchant = '$id'";
$products = mysqli_query($connect, $getproducts);
$nproducts = mysqli_num_rows($products);

$getorders = "select * from completed where id = '$order_'";
$orders = mysqli_query($connect, $getorders);
$norders = mysqli_num_rows($orders);
$ord = mysqli_fetch_assoc($orders);
$order_id = $ord['order_id'];

$getitems = "select * from sales where order_id = '$order_id'";
$items = mysqli_query($connect, $getitems);
$nitems = mysqli_num_rows($items);

$message = base64_decode($_GET['message']);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DemoName | View Order</title>
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
                  
                  <?php if($message){ ?>
                  
                  <div class="col-md-12">
                  
                      <div class="card">
                      
                          <div class="card-body" align="center">
                          
                              <p><div class="alert alert-primary"><?php echo $message ?></div></p>
                          
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
                              
                              <div align="center"><h3>View Order</h3></div>
                          
                          </div>
                      
                      </div>
                  
                  </div>
                  
<!--
                  <div class="col-md-12">
                  
                      <div class="card">
                          
                          <div class="card-body">
                              
                              <div align="center"><h3><?php echo $row['name']; ?>'s <?php echo $ord['status'] ?> order</h3></div>
                          
                          </div>
                      
                      </div>
                  
                  </div>
-->
          
          <div class="col-md-6">
          
              <div class="card">
              
                  <div class="card-body">
                  
                      <div class="details">
                      
                          <h4>Name</h4>
                          
                          <?php echo $ord['firstname'].' '.$ord['lastname']; ?>
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
          <div class="col-md-6">
          
              <div class="card">
              
                  <div class="card-body">
                  
                      <div class="details">
                      
                          <h4>Email</h4>
                          
                          <?php echo $ord['email']; ?>
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
          <div class="col-md-6">
          
              <div class="card">
              
                  <div class="card-body">
                  
                      <div class="details">
                      
                          <h4>Phone</h4>
                          
                          <?php echo $ord['phone']; ?>
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
          <div class="col-md-6">
          
              <div class="card">
              
                  <div class="card-body">
                  
                      <div class="details">
                      
                          <h4>Address</h4>
                          
                          <?php echo $ord['address']; ?>
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
          <div class="col-md-6">
          
              <div class="card">
              
                  <div class="card-body">
                  
                      <div class="details">
                      
                          <h4>City</h4>
                          
                          <?php echo $ord['city']; ?> 
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
          <div class="col-md-6">
          
              <div class="card">
              
                  <div class="card-body">
                  
                      <div class="details">
                      
                          <h4>State</h4>
                          
                          <?php echo $ord['state']; ?> 
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
          <div class="col-md-6">
          
              <div class="card">
              
                  <div class="card-body">
                  
                      <div class="details">
                      
                          <h4>Total Amount</h4>
                          
                          <?php echo $ord['amount']; ?>
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
          <div class="col-md-6">
          
              <div class="card">
              
                  <div class="card-body">
                  
                      <div class="details">
                      
                          <h4>Status</h4>
                          
                          <?php echo $ord['status']; ?> 
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
          <div class="col-md-6">
          
              <div class="card">
              
                  <div class="card-body">
                  
                      <div class="details">
                      
                          <h4>Payment Status</h4>
                          
                          <?php echo $ord['payment_status']; ?> 
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
          <div class="col-md-12">
          <div class="card">
          <div class="card-body">
          
              <h3>Items Ordered</h3>
              
              <div id="dataTables-example">
              
                  <table class="table-bordered table">
                    
                        <thead>
                        
                            <tr>
                            
                                <th>No.</th>
                                
                                <th>Item</th>
                                
                                <th>Product Size</th>
                                
                                <th>Color</th>
                                
                                <th>Quantity</th>
                                
                                <th>Unit Amount</th>
                            
                            </tr>
                        
                        </thead>
                        
                        <tbody>
                            
                            <?php
                            
                            for($i=0; $i<$nitems; $i++){
                                $item = mysqli_fetch_assoc($items);
                                $pid = $item['product_id'];
                                $image = mysqli_query($connect, "select * from product_image where product = '$pid' order by rand() limit 1");
                                $rimage = mysqli_fetch_assoc($image);
                                $image_name = $rimage['name'];
                            
                            ?>
                        
                            <tr>
                            
                                <td><?php echo $i+1; ?></td>
                            
                                <td><?php echo $item['item_bought'] ?> <img src="uploads/products/<?php echo $image_name ?>" style="height: 40px; width: auto;"></td>
                            
                                <td><?php echo $item['size'] ?></td>
                            
                                <td><?php echo $item['color'] ?></td>
                            
                                <td><?php echo $item['quantity'] ?></td>
                            
                                <td><?php echo $item['amount']; ?></td>
                                
                                
                            
                            </tr>
                            
                            <?php } ?>
                            
                            <?php
                            
                            if($nitems < 1){
                                echo 'No data found';
                                
                            }
                            
                            ?>
                        
                        </tbody>
                    
                    </table>
              
              </div>
              
              <?php if($ord['status'] == 'pending'){
                
                ?>
                
                <div class="actions" align="center">
                
                    <div class="col-md-6"><a href="terminate.php?id=<?php echo base64_encode($ord['id']); ?>" class="btn btn-danger" style="border-radius: 0px;">Terminate Order <i class="fa fa-remove"></i></a> </div>
                    
                    <div class="col-md-6"><a href="confirm.php?id=<?php echo base64_encode($ord['id']); ?>" class="btn btn-success" style="border-radius: 0px;">Confirm Order <i class="fa fa-check"></i></a> </td></div>
                
                </div>
            <?php } ?>
          
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