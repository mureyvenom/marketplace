<?php
session_start();
require_once('connect.php');

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


$getproducts = "select * from products where merchant = '$id'";
$products = mysqli_query($connect, $getproducts);
$nproducts = mysqli_num_rows($products);
$id = $row['id'];


$business_category = $row['business_category'];

if($business_category == 5){
    $getcategories = "select * from category order by name asc";
    $categories = mysqli_query($connect, $getcategories);
    $ncategories = mysqli_num_rows($categories);
}else{
    $getcategories = "select * from category where business_category = '$business_category' order by name asc";
    $categories = mysqli_query($connect, $getcategories);
    $ncategories = mysqli_num_rows($categories);
}





$pid = base64_decode($_GET['product']);
$pselect = mysqli_query($connect, "select * from products where id = '$pid'");
$prow = mysqli_fetch_assoc($pselect);

$getsizes = mysqli_query($connect, "select * from product_size where product_id = '$pid'");
$nsize = mysqli_num_rows($getsizes);

$getcolors = mysqli_query($connect, "select * from product_colors where product_id = '$pid'");
$ncolor = mysqli_num_rows($getcolors);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DemoName | Edit Product</title>
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
                              
                              <div align="center"><h3>Edit Product</h3></div>
                          
                          </div>
                      
                          <div class="card-body">
                          
                              <div class="edit-form" >

                                  <div class="col-md-1">&nbsp;</div>

                                  <div class="col-md-10">
                                  
                                      <form role="form" enctype="multipart/form-data" action="doEdit" method="post">
                                  
                                          <div class="form-group">

                                              <label>Edit Product Name</label>
                                              
                                              <input value="<?php echo $prow['name']; ?>" type="text" class="form-control" required name="name">

                                          </div>
                                          
                                          <div class="form-group">
                                              
                                              <label>Edit Category</label>
                            
                                            <select class="form-control" required name="category">

                                                <option value="">Select categrory</option>

                                                <?php

                                                for($x=0; $x<$ncategories; $x++){
                                                    $cat = mysqli_fetch_assoc($categories);

                                                ?>

                                                <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>

                                                <?php } ?>

                                            </select>

                                        </div>
                                          
                                          <?php if($nsize > 0){ ?>
                                          
                                          <div class="form-group">
                                          
                                              <label>Edit Colors</label>
                                              
                                              <div class="row">
                                                  
                                                  <?php for($ic=0;$ic<$ncolor; $ic++){ $crow = mysqli_fetch_assoc($getcolors);?>
                                              
                                                  <div class="col-md-4 form-group">
                                                  
                                                      <input class="form-control" type="text" name="size[]" required value="<?php echo $crow['name']; ?>">
                                                  
                                                  </div>
                                                  
                                                  <?php } ?>
                                              
                                              </div>
                                                                                        
                                          </div>
                                          
                                          <?php } ?>
                                          
                                          <?php if($ncolor > 0){ ?>
                                          
                                          <div class="form-group">
                                          
                                              <label>Edit Sizes</label>
                                              
                                              <div class="row">
                                                  
                                                  <?php for($is=0;$is<$nsize; $is++){ $srow = mysqli_fetch_assoc($getsizes);?>
                                              
                                                  <div class="col-md-4 form-group">
                                                  
                                                      <input class="form-control" type="text" name="size[]" required value="<?php echo $srow['name']; ?>">
                                                  
                                                  </div>
                                                  
                                                  <?php } ?>
                                              
                                              </div>
                                                                                        
                                          </div>
                                          
                                          <?php } ?>
                                  
                                          <div class="form-group">
                                              
                                              <label>Edit Price</label>
                        
                                            <input type="number" name="price" class="form-control" required value="<?php echo $prow['price']; ?>">

                                        </div>
                                          
                                          <div class="form-group">
                                              
                                              <label>Edit Description</label>
                            
                                            <textarea maxlength="300" name="description" class="form-control" style="height: 100px;"><?php echo $prow['description']; ?></textarea>

                                            <input name="id" value="<?php echo $pid; ?>" type="hidden">

                                        </div>
                                  
                                          
                        <input type="hidden" name="merchant" value="<?php echo $row['id']; ?>">
                                  
                                          <div class="form-group">

                                              <button class="btn btn-primary">Edit Product</button>

                                          </div>

                                  </form>
                                  
                                  </div>
                                  <div>
                    
                    <p></p><br>
                    <p></p><br>
                
                    <h4>Product Image(s)</h4>
                    
                                      <div class="col-md-12">
                                      
                                          <div class="row">
                                          
                                            <?php 
                    
                    $getimages = "select * from product_image where product = '$pid'";
                    $images = mysqli_query($connect, $getimages);
                    $nimages = mysqli_num_rows($images);
                    
                    for($m=0; $m<$nimages; $m++){
                        $irow = mysqli_fetch_assoc($images);
                        $image = $irow['name'];
                    
                    ?>
                    
                    <div class="col-md-3 edit">
                    
                        <div class="image">
                        
                            <img src="uploads/products/<?php echo $image; ?>" class="img-responsive">
                        
                        </div>
                        
                        <div class="action" align="center">
                        
                            <a href="edit-image?id=<?php echo base64_encode($irow['id']); ?>" class="btn btn-primary">Edit <i class="fa fa-image"></i></a>
                        
                        </div>
                    
                    </div>
                    
                    <?php } ?>
                                          
                                          </div>
                                      
                                      </div>
                
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