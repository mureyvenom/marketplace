<?php 
session_start();
require_once('connect.php');



function product_name2($id){
    include('connect.php');
    $query = "select * from products where id = '$id'";
    $run = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($run);
    
    echo $row['name'];
    
}

function product_image2($id){
    include('connect.php');
    $query = "select * from products where id = '$id'";
    $run = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($run);
    
    echo $row['image'];
    
}

$order_id = $_POST['order_id'];

$query = "select * from cart where order_id = '$order_id'";
$run = mysqli_query($connect, $query);
$nrun = mysqli_num_rows($run);

if($nrun > 0){

for($i=0;$i<$nrun; $i++){
    $row = mysqli_fetch_assoc($run);
    $pid = $row['product_id'];
    echo '
    <tr>

        <td>

            <strong>'; product_name2($pid); echo '</strong><br>

        </td>

        <td>

            <strong>'.$row['product_size'].'</strong><br>

        </td>

        <td>

            <strong>'.$row['color'].'</strong><br>

        </td>

        <td>

            <div class="col-12">

                <div class="row">

                    <div class="col-4"><button class="btn1" onClick="minusCart('.$row['id'].')" id="minus">-</button></div>

                    <div class="col-4"><input type="number" readonly min="1" value="'.$row['quantity'].'" id="quant"></div>

                    <div class="col-4"><button class="btn1" onClick="plusCart('.$row['id'].')"  id="plus">+</button></div>

                </div>

            </div>

        </td>

        <td>

             &#8358;'.$row['price'].'

        </td>

        <td>

             &#8358;'.$row['price'] * $row['quantity'].'

        </td>

        <td>

            <button class="btn1" id="clear'.$row['id'].'" onClick="removeCart('.$row['id'].')"><i class="fa fa-times"></i></button>

        </td>

    </tr>';
}
    
}else{
    echo "No items in cart";
}
exit;


?>