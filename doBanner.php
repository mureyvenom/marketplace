<?php
session_start();
require_once('connect.php');


$merchant = $_POST['merchant'];
$images = count($_FILES['image']['name']);
$descs = mysqli_real_escape_string($connect, implode(',',$_POST['heading']));
$desc = explode(',',$descs);
$descin = count($desc);
$psizes = mysqli_real_escape_string($connect, implode(',',$_POST['caption']));
$psize = explode(',',$psizes);
$psizein = count($psize);

if(!$merchant && !$descs && !$psizes && !$images ){
    $error = "All information is required";
    include('banner-images.php');
    exit;
}

if($images > 4){
    $error = "Maximum number of images allowed is 4";
    include('banner-images.php');
    exit;
}

if($images < 1){
    $error = "Minimum number of images allowed is 1";
    include('banner-images.php');
}

/*$insert = mysqli_query($connect, "insert into products set name = '$name', category = '$category', price = '$price', description = '$description', merchant = '$merchant'");*/



if($images){
    
    function compressImage($source, $destination, $quality) {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        }elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        }elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        }else{
            echo 'Image format must be jpg, png or gif';
            exit;
        }
        

        imagejpeg($image, $destination, $quality);

}
    
    
    for($i = 0; $i < count($_FILES['image']['name']); $i++){
      
        $link = $i+1;
        $filetmp  = $_FILES['image']['tmp_name'][$i];
      
        $filename[] = basename($_FILES['image']['name'][$i]);
        if(count($_FILES['image']['name']) > 1){
            $dbImage = $merchant.'-'.date("ymdhis").'-'.$link.'.'.'jpg';
        }else{
            $dbImage = $merchant.'-'.date("ymdhis").'.'.'jpg';
        }
        
        $filepath = 'uploads/banner/'.$dbImage;
        
        $headings = $_POST['heading'][$i];
        $captions = $_POST['caption'][$i];
        
        $compressit = compressImage($filetmp, $filepath, 90);
        $status = 'done';
      
        if($status = 'done'){
          $reg = mysqli_query($connect, "insert into banner_images set name = '$dbImage', merchant = '$merchant', heading = '$headings', caption = '$captions'");
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
    include('banner-images.php');
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
 
$correct = "Banner successfully added";
$crr = base64_encode($correct);
header('Location: banner-images?crr='.$crr);
exit;
    
    
?>