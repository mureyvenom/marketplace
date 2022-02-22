<?php

require_once('connect.php');

$order_id_session = $_POST['order_id_session'];

$querycart = "select * from cart where order_id = '".$order_id_session."'";
$resultcart = mysqli_query($connect, $querycart);
$numcart = mysqli_num_rows($resultcart);

function product_coll($id,$col){
    include('connect.php'); 
    $query = "select * from products where id = '$id'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    return $row[$col];
}

function sum_cartt($order_id){
    include('connect.php');
    $query = "select sum(price*quantity) from cart where order_id = '$order_id'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);	
    return $row['sum(price*quantity)'];
}

$firstt = substr(strrchr($_SESSION['return_url'], "/"), 1);	
if($numcart>0){
    for($icart=0; $icart<$numcart; $icart++){
        $scart = $icart+1;
        $rowcart = mysqli_fetch_assoc($resultcart);
        $prid = $rowcart['product_id'];
		$getdetails = mysqli_query($connect, "select * from products where id = '$prid'");
		$details = mysqli_fetch_assoc($getdetails);
        $img = mysqli_query($connect, "select * from product_image where product = '$prid' order by rand() limit 1");
        $rimg = mysqli_fetch_assoc($img);
        $img_name = $rimg['name'];
        echo '<div class="col-12">

                    <div class="cart-content">

                        <div class="row">
                        
                        <input type="hidden" value="'.$rowcart['id'].'" id="cart_id'.$icart.'">
                        <input type="hidden" value="'.$prid.'" id="pr_id'.$icart.'">

                            <div class="col-4" onClick="delete_product('.$icart.')" align="center">

                                <div class="image-holder"><img src="./uploads/products/'.$img_name.'" class="img-fluid"></div>

                                <i class="fas fa-times"></i>

                            </div>

                            <div class="col-8">

                                <div class="item-name">'.$details['name'].'</div>

                                &#8358;'.number_format($rowcart['price']).' x '.$rowcart['quantity'].' '.$rowcart['product_size'].' '.$rowcart['color'].'

                            </div>

                        </div>

                    </div>

                </div>';
        
    }
}else{
    echo '<div class="col-12">No items in cart</div>';
    exit;
}

?>