<?php
session_start();
require_once('connect.php');

$page = 'add-prod';

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
$business_category = $row['business_category'];

$getproducts = "select * from products where merchant = '$id'";
$products = mysqli_query($connect, $getproducts);
$nproducts = mysqli_num_rows($products);
$id = $row['id'];


$getcategories = "select * from categories where merchant = '$id'";
$categories = mysqli_query($connect, $getcategories);
$ncategories = mysqli_num_rows($categories);

if($business_category == 5){
    $getbusiness = mysqli_query($connect, "select * from category order by name asc");
    $nbusiness = mysqli_num_rows($getbusiness);
}else{
    $getbusiness = mysqli_query($connect, "select * from category where business_category = '$business_category' order by name asc");
    $nbusiness = mysqli_num_rows($getbusiness);
}



$saved_color_pull = mysqli_query($connect, "select * from saved_colors where name != 'Black' and  name != 'Blue' and  name != 'Brown' and  name != 'Gold' and  name != 'Green' and  name != 'Grey' and  name != 'Orange' and  name != 'Pink' and  name != 'Purple' and  name != 'Red' and  name != 'Silver' and  name != 'White' and  name != 'Yellow' and merchant = '$id' order by name");

$nsavedcolors = mysqli_num_rows($saved_color_pull);

$save_sizes_pull = mysqli_query($connect, "select * from saved_sizes where merchant = '$id'");

$nsavedsizes = mysqli_num_rows($save_sizes_pull);



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DemoName | Add Products</title>
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

<body <?php if($row['log_count'] < 2 && $correct ){ echo 'onLoad="showmodall()"';} ?> >
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
                      
                          Welcome to DemoName. Try these tips to et started
                      
                      </div>
                      
                      <div class="host">
                  
              <div class="col-md-12">
                  
              <div class="row">
                      
                          <div class="col-md-4">
                          
                              <div class="row">
                              
                                  <div class="tabs">
                                  
<!--
                                      <div class="tab tab1">
                                      
                                          Setup Profile
                                      
                                      </div>
                                  
                                      <div class="tab tab2">
                                      
                                          Add Products
                                      
                                      </div>
-->
                                  
                                      <div class="tab tab1">
                                      
                                          Setup Delivery Fees
                                      
                                      </div>
                                  
                                  </div>
                              
                              </div>
                          
                          </div>
                      
                          <div class="col-md-8">
                          
                              <div class="row">
                              
                                  <div class="tab-cont tab-cont1">
                                  
                                      Now that you've added your first product, you can set up your delivery fees <a href="delivery-details.php">here</a>. Please note that if you do not set delivery fees, customers wont get charged for delivery. You can also <a href="./">set it up later</a> from the TODOS menu at the top right corner
                                  
                                  </div>
                              
                                  <div class="tab-cont tab-cont2">
                                  
                                      Click <a href="add-products.php">Here</a> to create product items and specify details such as name, description, price and more<br><br>
                                      
                                      <div align="center"><i class="fa fa-shopping-bag"></i></div>
                                  
                                  </div>
                              
                                  <div class="tab-cont tab-cont3">
                                  
                                      Click <a href="view-products.php">Here</a> to view all your available products and also copy and share your market link so people can access your Shop and start buying.<br><br>
                                      
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
    
<script>


    function showmodall(){
    
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
                              
                              <div align="center"><h3>Add Products</h3></div>
                          
                          </div>
                      
                          <div class="card-body">
                          
                              <div class="edit-form" >

                                  <div class="col-md-10">
                                  
                                      <form role="form" enctype="multipart/form-data" action="doProductCompress" method="post">
                                  
                                          <div class="form-group">

                                              <label><b>Product Name</b></label>
                                              
                                              <input value="" type="text" class="form-control" required name="name">

                                          </div>
                                  
                                          <div class="form-group">

                                              <label><b>Select Category</b></label>
                                              
                                              <select class="form-control" required name="category">
                            
                                                <option value="">Select categrory</option>

                                                <?php

                                                for($x=0; $x<$nbusiness; $x++){
                                                    $cat = mysqli_fetch_assoc($getbusiness);

                                                ?>

                                                <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>

                                                <?php } ?>

                                            </select>

                                          </div>
                                          
                                          <div class="form-group">
                                          
                                              <label><b>Product Price</b></label>
                                              
                                              <input min="200" type="number" required name="price" class="form-control">
                                          
                                          </div>
                                          
                                          <div id="dynamic_field">
                                              
                                              <br>
                                  
                                          <div class="form-group">

                                              <label class="custom-file-label"></label>
                                              
                                              <div class="custom-file">
                                              
                                                  <input type="file" class="custom-file-input" required name="image[]">
                                              
                                              </div>

                                          </div>
                           
                                              
                                          </div>
                                          
                                          <div class="form-group" align="center">

                                              <a href="javascript::;" id="add"><b>[+] Add another image</b></a>

                                          </div>
                                          
                                          <div class="form-group">
                                              
                                              <label><b>Add Product Sizes (optional)</b></label>
                                          
                                              <div class="row">

                                                  <?php 

                                                  if($nsavedsizes > 0){
                                                        for($xsize=0; $xsize<$nsavedsizes; $xsize++){
                                                            $sizepull = mysqli_fetch_assoc($save_sizes_pull);

                                                  ?>

                                                  <div class="col-md-2 col-xs-4 col-sm-4"><?php echo $sizepull['name']; ?> <input type="checkbox" name="product_size[]" value="<?php echo $sizepull['name']; ?>"></div><br><br>

                                                  <?php }} ?>

                                              </div>
                                              
                                              <div class="row" id="dynamic_size">
                                                  
                                                  <div align="center" class="col-md-12"><a href="javascript::;" id="add_product_size" style="text-align: center"><b>[+] Add custom product size</b></a></div><br><br>
                                
                                                  <div class="col-md-12 size_save"><input type="checkbox" name="save_sizes" id="size_save" value="yes"> <b>Save Sizes</b></div>
                             
                                              </div>
                                          
                                          </div>
                                          
                                          <div class="form-group" >
                                            <div class="form-group" id="colors">
                                                <div id="colorcont"><a href="javascript::;" id="add_color"><b>[+] Add another color</b></a></div>
                                            <div class="form-group" id="preset_colors">

                                                <label><b>Select Available Colors (optional)</b></label>

                                                <div class="row">

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Black <input type="checkbox" name="color[]" value="Black"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Blue <input type="checkbox" name="color[]" value="Blue"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Brown <input type="checkbox" name="color[]" value="Brown"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Gold <input type="checkbox" name="color[]" value="Gold"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Green <input type="checkbox" name="color[]" value="Green"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Grey <input type="checkbox" name="color[]" value="Grey"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Orange <input type="checkbox" name="color[]" value="Orange"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Pink <input type="checkbox" name="color[]" value="Pink"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Purple <input type="checkbox" name="color[]" value="Purple"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Red <input type="checkbox" name="color[]" value="Red"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Silver <input type="checkbox" name="color[]" value="Silver"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">White <input type="checkbox" name="color[]" value="White"></div>

                                                    <div class="col-md-2 col-xs-4 col-sm-4">Yellow <input type="checkbox" name="color[]" value="Yellow"></div>

                                                    <?php 

                                                    if($nsavedcolors > 0){
                                                        for($xcol=0; $xcol<$nsavedcolors; $xcol++){
                                                            $colorpull = mysqli_fetch_assoc($saved_color_pull);



                                                    ?>



                                                    <div class="col-md-2 col-xs-4 col-sm-4"><?php echo $colorpull['name']; ?> <input type="checkbox" name="color[]" value="<?php echo $colorpull['name']; ?>"></div>

                                                    <?php }} ?>



                                                </div>



                                            </div>


                                            </div>
                                                <div class="col-md-3 col-xs-4 col-sm-4" id="customm"><div class="row"><a href="javascript::;" id="set_custom_colors"><b>Add your own Color</b></a></div> </div>
                                                <div class="col-md-3 col-xs-4 col-sm-4" id="presett"><div class="row"><a href="javascript::;" id="set_preset_colors"><b>Select From Preset Colors Only</b></a></div> </div><p></p><br><p></p><br>
                                            </div>
                                          
                                          <div class="form-group">
                            
                                              <textarea maxlength="300" name="description" class="form-control" style="height: 100px;" placeholder="Enter product description"></textarea>

                                          </div>
                             
                                          <input type="hidden" name="merchant" value="<?php echo $row['id']; ?>">
                                  
                                          <div class="form-group">

                                              <button class="btn btn-primary">Add Product</button>

                                          </div>

                                  </form>
                                  
                                  </div>

                              </div>
                              
                              
                          
                          </div>
                      
                      </div>
                  
                  </div>
              
              </div>
          
          </div>
          
      </div><?php include('footer.php'); ?>
      </div>
    
      
    
 
<script type="text/javascript">
$(document).ready(function(){
$('#presett').hide();
$('#colorcont').hide();
$('.size_save').hide();
var i=1;
var ci = 1;
var si = 1;



$('#add').click(function(){

    if(i >= 4){
        alert('Maximum number of images per product is 4')
    }else{
        i++;
        $('#dynamic_field').append('<div id="row'+i+'" class="form-group col-md-12" align="left"><div class="row"><div class="col-md-11"><label class="custom-file-label"></label><input type="file" id="image" name="image[]" class="custom-file-input" required placeholder="Select Product image"></div><div class="col-md-1"><button type="button" style="margin-top:0px;"  name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></div></div></div>');
    }

});


$('#set_custom_colors').click(function(){

    
        
        $('#colors').append('<div class="form-group" id="custom_colors"><label>Set Custom Colors</label><div class="row" id="dynamic_colors"><br><div class="col-md-4 form-group"><input type="text" class="form-control" name="color[]" required placeholder="Enter color name"></div></div><div class="row"></div><div class="col-md-2"><input type="checkbox" name="save_color" value="yes"> Save Custom Colors</div></div>');
    
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
        $('#dynamic_colors').append('<div id="rowx'+ci+'" class="col-md-4 form-group row" align="left"><div class="col-md-9"><input type="text" class="form-control" name="color[]" required placeholder="Enter color name"></div><div class="col-md-2"><button type="button" style="margin-top:0px;"  name="remove" id="'+ci+'" class="btn btn-danger btn_remove_color"><i class="fa fa-trash"></i></button></div>');

});
    

$('#add_product_size').click(function(){

        si++;
        $('#dynamic_size').append('<div id="rowxx'+si+'" class="col-md-4 form-group"><div class="row"><div class="col-md-12"><div class="row"><div class="col-md-9"><input type="text" name="product_size[]" class="form-control" placeholder="Enter product size" required></div><div class="col-md-2"><button style="margin-top: 0px;" type="button"  name="remove" id="'+si+'" class="btn btn-danger btn_remove_size"><i class="fa fa-trash"></i></button></div></div></div></div></div>');
    
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