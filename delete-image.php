<?php
session_start();
require_once('connect.php');
$id = base64_decode($_GET['id']);



$get_images = mysqli_query($connect, "select * from banner_images where id = '$id'");
$nimagex = mysqli_num_rows($get_images);
$delr = mysqli_fetch_assoc($get_images);
$delimage = $delr['name'];
unlink("uploads/banner/$delimage");
$delete = mysqli_query($connect, "delete from banner_images where id = '$id'");

header('Location: banner-images.php');

exit;


?>