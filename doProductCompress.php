<?php
session_start();
require_once('connect.php');

$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$size_needed = $_POST['size_needed'];
$description = $_POST['description'];
$merchant = $_POST['merchant'];
$filename = [];
$dbImage =[];
$images = count($_FILES['image']['name']);
if(!$_POST['product_size']){
    $psizein = 0;
}else{
    $psizes = mysqli_real_escape_string($connect, implode(',',$_POST['product_size']));
    $psize = explode(',',$psizes);
    $psizein = count($psize);
}
if(!$_POST['color']){
    $descin = 0;
}else{
    $descs = mysqli_real_escape_string($connect, implode(',',$_POST['color']));
    $desc = explode(',',$descs);
    $descin = count($desc);
}



function get_extension($file){

	$filename = explode('.',$file);	
	$extension = array_reverse($filename);
	return strtolower($extension[0]);
}



$save_sizes = $_POST['save_sizes'];
$save_color = $_POST['save_color'];

if(!$name && !$category && !$price && !$images && !$merchant ){
    $error = "All information is required";
    include('add-products.php');
    exit;
}

if($images > 4){
    $error = "Maximum number of images allowed is 4";
    include('add-products.php');
    exit;
}

if($images < 1){
    $error = "Minimum number of images allowed is 1";
    include('add-products.php');
}

if($price < 200){
    $error  = "Minimum product amount is N200";
    include('add-products.php');
    exit;
}

/*$insert = mysqli_query($connect, "insert into products set name = '$name', category = '$category', price = '$price', description = '$description', merchant = '$merchant'");*/

$insert = "insert into products set name = '$name', category = '$category', price = '$price', description = '$description', merchant = '$merchant', image_no = '$images', size_needed = '$size_needed', status = 'active'";

$run = mysqli_query($connect, $insert);

if($run){
    $return = mysqli_query($connect, "select * from products where merchant = '$merchant' order by id desc limit 1");
    $rr = mysqli_fetch_assoc($return);
    $rid = $rr['id'];
    
    // Compress image
    function compressImage($source, $destination, $quality) {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        }elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        }elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        }else{
            $error = 'Image format must be jpg, png or gif';
            include('connect.php');
			$email = $_SESSION['user'];
			$getid = mysqli_query($connect, "select * from merchant where email = '$email'");
			$rw = mysqli_fetch_assoc($getid);
			$id = $rw['id'];
            $delete = mysqli_query($connect, "delete from products where merchant = '$id' order by id desc limit 1");
			include('add-products.php');
            exit;
        }
        

        imagejpeg($image, $destination, $quality);

}
    
    for($i = 0; $i < count($_FILES['image']['name']); $i++){
      
        $link = $i+1;
        $filetmp  = $_FILES['image']['tmp_name'][$i];
      
        $filename[] = basename($_FILES['image']['name'][$i]);
        $ext = get_extension($_FILES['image']['name'][$i]);
        if(count($_FILES['image']['name']) > 1){
            $dbImage = $rid.'-'.$link.'.'.$ext;
        }else{
            $dbImage = $rid.'.'.$ext;
        }
        
        $filepath = 'uploads/products/'.$dbImage;
        
        if($ext == 'png'){
            imagepng($filetmp, $filepath, 4);
            // move_uploaded_file($filetmp ,$filepath);
        }else{
            $compressit = compressImage($filetmp, $filepath, 40);
        }
      
        
        $status = 'done';
      
        if($status == 'done'){
          $reg = mysqli_query($connect, "insert into product_image set name = '$dbImage', product = '$rid'");
            if($reg){
                
            }else{
                echo 'Image Upload Error';
                exit;
            }
      }else{
            echo 'Error!';exit;
        }
    }
//      $mainfiles = implode(", ", $filename);
//
//      $sql  = "INSERT INTO pictures2 (";
//      $sql .= "image, photograph_id";
//      $sql .= ") VALUES ('";
//      $sql .= $database->escape_character($mainfiles) ."', '";  
//      $sql .= $id ."')";
//      $result = $database->query($sql);
//        if($result){
//        $session->message('<div class="success-msg">Pictures uploaded sucessfully.</div>');
//        }
    
}else{
    echo $query ;exit;
    $error = "Fatal error 2";
    include('add-products.php');
    exit;
}

if($descin > 0){
    $xreturn = mysqli_query($connect, "select * from products where merchant = '$merchant' order by id desc limit 1");
$xrr = mysqli_fetch_assoc($xreturn);
$xrid = $xrr['id'];

for($xi=0; $xi<$descin; $xi++){
    $color = $_POST['color'][$xi];
    $insert_colors = mysqli_query($connect, "insert into product_colors set name = '$color', product_id = '$xrid'");
        if($save_color == "yes"){
            $savecolor = mysqli_query($connect, "insert into saved_colors set name = '$color', merchant = $merchant");
        }
    if($insert_colors){
        
    }else{
        echo 'End Error';
        exit;
    }
}
}

if($psizein > 0){
    $xxreturn = mysqli_query($connect, "select * from products where merchant = '$merchant' order by id desc limit 1");
    $xxrr = mysqli_fetch_assoc($xxreturn);
    $xxrid = $xxrr['id'];

    for($xxi=0; $xxi<$psizein; $xxi++){
        $product_size = $_POST['product_size'][$xxi];
        $insert_psize = mysqli_query($connect, "insert into product_size set name = '$product_size', product_id = '$xxrid'");
        if($save_sizes == "yes"){
            $savesize = mysqli_query($connect, "insert into saved_sizes set name = '$product_size', merchant = $merchant");
        }
        if($insert_psize){

        }else{
            echo 'End Error 2';
            exit;
        }
    }

}
 
$correct = "Product successfully added";
$crr = base64_encode($correct);
header('Location: add-products?crr='.$crr);
exit;
    
    
?>