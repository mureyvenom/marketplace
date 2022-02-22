<?php 

$search = $_POST['search'];
$merchant = $_POST['merchant'];

header('Location: search?find='.$search.'&merchant='.$merchant);


?>