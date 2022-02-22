<?php
session_start();
require_once('connect.php');
$page = 'banner';

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

$getproducts = "select * from products where merchant = '$id'";
$products = mysqli_query($connect, $getproducts);
$nproducts = mysqli_num_rows($products);
$id = $row['id'];


$getcategories = "select * from categories where merchant = '$id'";
$categories = mysqli_query($connect, $getcategories);
$ncategories = mysqli_num_rows($categories);

$saved_color_pull = mysqli_query($connect, "select * from saved_colors where name != 'Black' and  name != 'Blue' and  name != 'Brown' and  name != 'Gold' and  name != 'Green' and  name != 'Grey' and  name != 'Orange' and  name != 'Pink' and  name != 'Purple' and  name != 'Red' and  name != 'Silver' and  name != 'White' and  name != 'Yellow' and merchant = '$id'");

$nsavedcolors = mysqli_num_rows($saved_color_pull);

$save_sizes_pull = mysqli_query($connect, "select * from saved_sizes where merchant = '$id'");

$nsavedsizes = mysqli_num_rows($save_sizes_pull);



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DemoName | Banner Images</title>
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
                              
                              <div align="center"><h3>Manage Banner Images</h3></div>
                          
                          </div>
                      
                          <div class="card-body">
                          
                              <div class="edit-form" >

                                  <div class="col-md-1">&nbsp;</div>

                                  <div class="col-md-10">
                                  
                                      <form role="form" enctype="multipart/form-data" action="doBanner" method="post">
                                  
                                          <div id="dynamic_field">
                                              
                                          <div class="form-group">

                                              <label>Banner Heading</label>
                                              
                                              <input value="" type="text" class="form-control" required name="heading[]">

                                          </div>
                                  
                                          <div class="form-group">

                                              <label>Banner Caption</label>
                                              
                                              <input value="" type="text" class="form-control" required name="caption[]">

                                          </div><br>
                                  
                                          <div class="input-group">

                                              <label class="custom-file-label">Add Image</label>
                                              
                                              <input type="file" class="custom-file-input" required name="image[]">

                                          </div>
                                              
                                          </div>
                                          
                                          <div class="form-group" align="center">

                                              <a href="javascript::;" id="add">[+] Add another banner</a>

                                          </div>
                             
                                          <input type="hidden" name="merchant" value="<?php echo $row['id']; ?>">
                                  
                                          <div class="form-group">

                                              <button class="btn btn-primary">Add Banners</button>

                                          </div>

                                  </form>
                                  
                                  </div>

                                  <div class="col-md-1"></div>

                              </div>
                              
                              <div class="row">
                              <div class="col-md-12">
                    
                                  <h3>Active Banner(s)</h3>
                        
                                  <div class="row">
                                  <?php 

                                    $getimages = "select * from banner_images where merchant = '$id'";
                                    $images = mysqli_query($connect, $getimages);
                                    $nimages = mysqli_num_rows($images);

                                    for($m=0; $m<$nimages; $m++){
                                        $irow = mysqli_fetch_assoc($images);
                                        $image = $irow['name'];

                                ?>
                    
                                <div class="col-md-3 edit">

                                    <div class="image" style="background-image: url('uploads/banner/<?php echo $image; ?>'); background-size: cover; background-position:center; background-repeat: no-repeat;"></div>

                                    <div class="action" align="center">

                                        <a href="edit-banner-image?id=<?php echo base64_encode($irow['id']); ?>" class="btn btn-primary">Edit <i class="fa fa-image"></i></a> <a href="delete-image?id=<?php echo base64_encode($irow['id']); ?>" class="btn btn-danger">Delete <i class="fa fa-image"></i></a>

                                    </div>

                                </div>
                    
                                <?php } ?>
                    
                                  </div>
                    
                                  </div>
                    
                              </div>
                          
                          </div>
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
      </div>
      <?php include('footer.php'); ?>
      </div>
    
    
       
<script type="text/javascript">
$(document).ready(function(){
$('#presett').hide();
$('#colorcont').hide();
$('.size_save').hide();
var i=<?php echo $nimages+1 ?>;
var ci = 1;
var si = 1;



$('#add').click(function(){

    if(i >= 4){
        alert('Banners are limited to 4')
    }else{
        i++;
        $('#dynamic_field').append('<div id="row'+i+'"><div class="form-group"><label>Banner Heading</label><input value="" type="text" class="form-control" required name="heading[]"></div><div class="form-group"><label>Banner Caption</label><input value="" type="text" class="form-control" required name="caption[]"></div><div class="form-group"><label class="custom-file-label">Click Here Add To Image</label><br><input type="file" class="custom-file-input" required name="image[]"></div><div class="form-group"><button id="'+i+'" type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></div></div>');
    }
//'<div class="" id="row'+i+'"><div class="form-group"><input type="text" name="heading[]" class="form-control" required placeholder="Enter banner heading"></div><div class="form-group"><input type="text" name="caption[]" class="form-control" required placeholder="Enter banner caption"></div><div><div class="form-group" align="left"><label>Image</label><input type="file" id="image" name="image[]" class="form-control" required placeholder="Select Product image"></div></div><button type="button" style="padding: 11px 5px; width: 100%;" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash-o"></i></button><br><br><br><br></div>'
});


$('#set_custom_colors').click(function(){

    
        
        $('#colors').append('<div class="form-group" id="custom_colors"><label>Set Custom Colors</label><div class="row" id="dynamic_colors"><br><div class="col-md-4 form-group"><input type="text" class="formfield" name="color[]" required placeholder="Enter color name"></div></div><div class="row"></div></div><div class="col-md-2"><input type="checkbox" name="save_color" value="yes"> Save Custom Colors</div>');
    
    $('#presett').show();
    $('#colorcont').show();
    $('#customm').hide();
    
});


$('#set_preset_colors').click(function(){

    
    $('#custom_colors').remove();
        
//        $('#colors').append('<div class="form-group" id="preset_colors"><label>Select Available Colors</label><div class="row"><div class="col-md-2 col-xs-4 col-sm-4">Black <input type="checkbox" name="color[]" value="Black"></div><div class="col-md-2 col-xs-4 col-sm-4">Blue <input type="checkbox" name="color[]" value="Blue"></div><div class="col-md-2 col-xs-4 col-sm-4">Brown <input type="checkbox" name="color[]" value="Brown"></div><div class="col-md-2 col-xs-4 col-sm-4">Gold <input type="checkbox" name="color[]" value="Gold"></div><div class="col-md-2 col-xs-4 col-sm-4">Green <input type="checkbox" name="color[]" value="Green"></div><div class="col-md-2 col-xs-4 col-sm-4">Grey <input type="checkbox" name="color[]" value="Grey"></div><div class="col-md-2 col-xs-4 col-sm-4">Orange <input type="checkbox" name="color[]" value="Orange"></div><div class="col-md-2 col-xs-4 col-sm-4">Pink <input type="checkbox" name="color[]" value="Pink"></div><div class="col-md-2 col-xs-4 col-sm-4">Purple <input type="checkbox" name="color[]" value="Purple"></div><div class="col-md-2 col-xs-4 col-sm-4">Red <input type="checkbox" name="color[]" value="Red"></div><div class="col-md-2 col-xs-4 col-sm-4">Silver <input type="checkbox" name="color[]" value="Silver"></div><div class="col-md-2 col-xs-4 col-sm-4">White <input type="checkbox" name="color[]" value="White"></div><div class="col-md-2 col-xs-4 col-sm-4">Yellow <input type="checkbox" name="color[]" value="Yellow"></div></div></div>');
    
    $('#presett').hide();
    $('#colorcont').hide();
    $('#customm').show();
    
    
});
    

$('#add_color').click(function(){

        ci++;
        $('#dynamic_colors').append('<div id="rowx'+ci+'" class="col-md-4 form-group row" align="left"><div class="col-md-10"><input type="text" class="formfield" name="color[]" required placeholder="Enter color name"></div><div class="col-md-2"><button type="button" style=" width: 100%; padding: 11px 5px;" name="remove" id="'+ci+'" class="btn btn-danger btn_remove_color"><i class="fa fa-trash-o"></i></button></div>');

});
    

$('#add_product_size').click(function(){

        si++;
        $('#dynamic_size').append('<div id="rowxx'+si+'" class="col-md-4 form-group"><div class="row"><div class="col-md-10"><input type="text" name="product_size[]" class="formfield" placeholder="Enter product size" required></div><div class="col-md-2"><button type="button" style="padding: 11px 5px; width: 100%;" name="remove" id="'+si+'" class="btn btn-danger btn_remove_size"><i class="fa fa-trash-o"></i></button></div></div></div>');
    
    if(si > 1){
        $('.size_save').show();
    }

});

$(document).on('click', '.btn_remove', function(){
i == i--;
var button_id = $(this).attr("id");
$('#row'+button_id+'').remove();
});
   

$(document).on('click', '.btn_remove_color', function(){
ci == ci--;
var button_idx = $(this).attr("id");
$('#rowx'+button_idx+'').remove();
});
   

$(document).on('click', '.btn_remove_size', function(){
si == si--;
var button_idxx = $(this).attr("id");
$('#rowxx'+button_idxx+'').remove();
    if(si < 2){
        $('.size_save').hide();
    }
});
    
    
});

</script>
    
</body>
</html>