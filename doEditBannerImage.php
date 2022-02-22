<?php
session_start();
require_once('connect.php');

$id = $_POST['id'];
$image = $_FILES['image']['tmp_name'];
$image_name = $_FILES['image']['id'];
$image_size = round(filesize($image) / 512, 0).' KB';

if(!$image && !$id){
    $error = "All information is required";
    include('edit-banner-image.php');
    exit;
}

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

$getdetails = "select * from banner_images where id = '$id'";
$details = mysqli_query($connect, $getdetails);
$rdetails = mysqli_fetch_assoc($details);

$name = $rdetails['name'];
$dbImage = $name;
$upfile = 'uploads/banner/'.$dbImage;

if(compressImage($image, $upfile, 60)){
    $correct = "Banner image successfully updated";
    $crr = base64_encode($correct);
    header('Location: banner-images?crr='.$crr);
    exit;
}else{
    echo 'Error in uploading image';
    exit;
}


// if($file == 'yes'){
//     $dbImage = $id.'.'.'jpg';
//     $upfile = 'uploads/banner/'.$dbImage;
//     if (move_uploaded_file($image, $upfile)){
//         $update = mysqli_query($connect, "update products set name = '$name', category = '$category', price = '$price', description = '$description', image = '$dbImage' where id = '$id'");
//         if($update){
//             $correct = "Product successfully updated";
//             $crr = base64_encode($correct);
//             header('Location: edit-banner.php?crr='.$crr);
//         }else{
//             echo 'Fatal Error 1';
//             exit;
//         }        
//     }
// }else{
//     $update = mysqli_query($connect, "update products set name = '$name', category = '$category', price = '$price', description = '$description' where id = '$id'");
//     exit;
    
//     if($update){    
//     $correct = "Product successfully updated";
//     $crr = base64_encode($correct);
//     header('Location: edit.php?crr='.$crr);
//     exit;
//     }else{
//         $error = "Fatal error";
//         include('edit.php');
//         exit;
//     }
// }

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