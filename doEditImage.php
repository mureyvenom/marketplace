<?php
session_start();
require_once('connect.php');

$id = $_POST['id'];
$image = $_FILES['image']['tmp_name'];
$image_name = $_FILES['image']['id'];
$image_size = round(filesize($image) / 512, 0).' KB';


function get_extension($file){

	$filename = explode('.',$file);	
	$extension = array_reverse($filename);
	return strtolower($extension[0]);
}
    
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
        echo 'Image format must be jpg, png or gif';
        exit;
    }


    imagejpeg($image, $destination, $quality);

}

$ext = get_extension($_FILES['image']['name']);

if(!$image && !$id){
    $error = "All information is required";
    include('edit-image.php');
    exit;
}

$getdetails = "select * from product_image where id = '$id'";
$details = mysqli_query($connect, $getdetails);
$rdetails = mysqli_fetch_assoc($details);

$name = $rdetails['name'];
$dbImage = $name;
$upfile = 'uploads/products/'.$dbImage;

if($ext == 'png'){
    move_uploaded_file($image ,$upfile);
}else{
    $compressit = compressImage($image, $upfile, 40);
}



if($image){
    $correct = "Product image successfully updated";
    $crr = base64_encode($correct);
    header('Location: banner-images.php?crr='.$crr);
    exit;
}else{
    echo 'Error in uploading image';
    exit;
}


if($file == 'yes'){
    $dbImage = $id.'.'.'jpg';
    $upfile = 'uploads/products/'.$dbImage;
    if (move_uploaded_file($image, $upfile)){
        $update = mysqli_query($connect, "update products set name = '$name', category = '$category', price = '$price', description = '$description', image = '$dbImage' where id = '$id'");
        if($update){
            $correct = "Product successfully updated";
            $crr = base64_encode($correct);
            header('Location: edit?crr='.$crr);
        }else{
            echo 'Fatal Error 1';
            exit;
        }        
    }
}else{
    $update = mysqli_query($connect, "update products set name = '$name', category = '$category', price = '$price', description = '$description' where id = '$id'");
    exit;
    
    if($update){    
    $correct = "Product successfully updated";
    $crr = base64_encode($correct);
    header('Location: edit.php?crr='.$crr);
    exit;
    }else{
        $error = "Fatal error";
        include('edit.php');
        exit;
    }
}

/*$update = mysqli_query($connect, "update products set name = '$name', category = '$category', price = '$price', description = '$description' where id = '$id'");

if($update){    
    $correct = "Product successfully updated";
    $crr = base64_encode($correct);
    header('Location: edit.php?crr='.$crr);
    exit;
}else{
    $error = "Fatal error";
    include('edit.php');
    exit;
}*/



?>