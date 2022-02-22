<?php
session_start();
include('connect.php');

function signup_categories(){
    include('connect.php');
    $query = "select * from business_category order by name asc";
    $run = mysqli_query($connect, $query);
    $nrun = mysqli_num_rows($run);
    for($i=0;$i<$nrun; $i++){
        $row = mysqli_fetch_assoc($run);
        echo '
            <option value="'.$row['id'].'">'.$row['name'].'</option>
        ';
    }
}

function product_name($id){
    include('connect.php');
    $query = "select * from products where id = '$id'";
    $run = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($run);
    
    echo $row['name'];
    
}

function cart_subtotal(){
    include('connect.php');
    $query = "select sum(price*quantity) from cart where order_id = '".$_SESSION['order_id']."'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);	
    echo number_format($row['sum(price*quantity)']);
}

function get_cart(){
    include('connect.php');
    $query = "select * from cart where order_id = '".$_SESSION['order_id']."'";
    $run = mysqli_query($connect, $query);
    $nrun = mysqli_num_rows($run);
    
    if($nrun > 0){
    
        for($i=0;$i<$nrun; $i++){
            $row = mysqli_fetch_assoc($run);
            $pid = $row['product_id'];
            echo '
            <tr>

                <td>

                    <strong>'; product_name($pid); echo '</strong><br>

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
        echo '<tr>No item in cart';
    }
}

function main_categories($merchant){
	include('connect.php');
	$query = "select * from merchant where name = '$merchant'";
	$run = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($run);
	$merchant_id = $row['id'];
	$business_category = $row['business_category'];
	if($business_category == 5){
		$getbusiness = mysqli_query($connect, "select * from category order by name asc");
    	$nbusiness = mysqli_num_rows($getbusiness);
	}else{
		$getbusiness = mysqli_query($connect, "select * from category where business_category = '$business_category' order by name asc");
    	$nbusiness = mysqli_num_rows($getbusiness);
	}
	
	for($i=0; $i<$nbusiness; $i++){
		$category_row = mysqli_fetch_assoc($getbusiness);
		$category_id = $category_row['id'];
		$counter = mysqli_query($connect, "select * from products where merchant = '$merchant_id' and status = 'active' and category = '$category_id' order by rand() limit 1");
		$ncounter = mysqli_num_rows($counter);
		$counter_row = mysqli_fetch_assoc($counter);
		$product_id = $counter_row['id'];
		$getbg = mysqli_query($connect, "select * from product_image where product = '$product_id'");
		$bgrow = mysqli_fetch_assoc($getbg);
		$bg_image = $bgrow['name'];
		
		echo '
		
			<div class="col-md-4" '; if($ncounter<1){echo 'style="display:none;"';} echo '>
			
				<div class="category-pack" align="center">
				
					<div class="category" style="background-image: url(uploads/products/'.$bg_image.')">
					
						<a href="categories?merchant='.$merchant.'&category='.base64_encode($category_id).'"><button class="btn1">'.$category_row['name'].'</button></a>
					
					</div>
				
				</div>
			
			</div>
		
		';
		
	}
	
}

function category_list($merchant){
	include('connect.php');
	$query = "select * from merchant where name = '$merchant'";
	$run = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($run);
	$merchant_id = $row['id'];
	$business_category = $row['business_category'];
	
	if($business_category == 5){
		$getbusiness = mysqli_query($connect, "select * from category order by name asc");
    	$nbusiness = mysqli_num_rows($getbusiness);
	}else{
		$getbusiness = mysqli_query($connect, "select * from category where business_category = '$business_category' order by name asc");
    	$nbusiness = mysqli_num_rows($getbusiness);
	}
	
	for($i=0; $i<$nbusiness; $i++){
		$category_row = mysqli_fetch_assoc($getbusiness);
		$category_id = $category_row['id'];
		$counter = mysqli_query($connect, "select * from products where merchant = '$merchant_id' and status = 'active' and category = '$category_id'");
		$ncounter = mysqli_num_rows($counter);
		
		echo '
		
		<a href="categories?merchant='.$merchant.'&category='.base64_encode($category_id).'" '; if($ncounter < 1){echo 'style="display:none"';}  echo '>
						
			<div class="categoryitem">

				<div class="row">

					<div class="col-9"><div class="name">'.$category_row['name'].'</div></div>

					<div class="col-3"><div class="counter">'.$ncounter.'</div></div>

				</div>

			</div>

		</a>

		';
		
	}
	
}

function total_quantity(){
    include('connect.php');
    $query = "select sum(quantity) from cart where order_id = '".$_SESSION['order_id']."'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);	
    if (!$row['sum(quantity)']){
        echo 0;
    }else{
        echo $row['sum(quantity)'];
    }
}

function product_details($product_id){
	include('connect.php');
	$query = "select * from products where id = '$product_id'";
	$run = mysqli_query($connect, $query);
	$nrun = mysqli_num_rows($run);
	$colorquery = "select * from product_colors where product_id = '$product_id'";
	$runcolor = mysqli_query($connect, $colorquery);
	$ncolor = mysqli_num_rows($runcolor);
	$sizequery = "select * from product_size where product_id = '$product_id'";
	$runsize = mysqli_query($connect, $sizequery);
	$nsize = mysqli_num_rows($runsize);
	
	if($nrun > 0){
		$row = mysqli_fetch_assoc($run);
		$getimages = "select * from product_image where product = '$product_id' order by id asc";
		$runimages = mysqli_query($connect, $getimages);
		$nimages = mysqli_num_rows($runimages);
		$imagerow = mysqli_fetch_assoc($runimages);
		
		echo '
		
		<div id="product-details">

			<div class="container">

				<div class="row">

					<div class="col-md-2 col-4">

						<div id="image-switch">

							<div class="row">

								<div class="col-12">';
								$reimage = mysqli_query($connect, "select * from product_image where product = '$product_id'");
								$nreimage = mysqli_num_rows($reimage);
								for($i=0; $i<$nimages; $i++){
									$imagerow2 = mysqli_fetch_assoc($reimage);
									$image = $imagerow2['name'];
									$x = $i+1;
									echo '

									<div id="switchbox'.$x.'" onClick="switchImage('.$x.')" class="switch-image ';if($i==0){echo 'active';} echo ' ">

										<img id="switch'.$x.'" src="uploads/products/'.$imagerow2['name'].'" class="img-fluid">

									</div>
									
									';
									
								}
										
										echo '

								</div>

							</div>

						</div>

					</div>

					<div class="col-md-6 col-8">

						<div class="image" align="center" style="background-image: url(\'uploads/products/'.$imagerow['name'].'\')">

							<!--<img id="main-image" src="uploads/products/'.$imagerow['name'].'" class="img-fluid">-->

						</div>

					</div>

					<div class="col-md-4">

						<h3>'.$row['name'].'</h3>

						<h4>₦'.$row['price'].'</h4>
						
						<input type="hidden" id="product_price" value="'.$row['price'].'">
						<input type="hidden" id="product_id" value="'.$row['id'].'">

						<div class="description">

							'.$row['description'].'

						</div>';
		
						
						if($nsize > 0){	
														
								echo '

						<div class="selections">

							<select id="size" class="formfield">

								<option value="">Select Size</option>';
							
								for($j=0;$j<$nsize;$j++){
									$sizerow = mysqli_fetch_assoc($runsize);
									
									echo '<option>'.$sizerow['name'].'</option>';
									
								}
									
									
									echo '

							</select>

						</div>';
							
									  }
							
							if($ncolor > 0){
								
								echo '

						<div class="selections">

							<select id="color" class="formfield">

								<option value="">Select Color</option>';
								
								for($k=0; $k<$ncolor; $k++){
									$colorrow = mysqli_fetch_assoc($runcolor);
									
									echo '<option>'.$colorrow['name'].'</option>';
								}
									
									
									echo '

							</select>

						</div>';
							}
									
									echo '

						<div class="actions">

							<div class="row">

								<div class="col-md-6">

									<div class="col-12">

										<div class="row">

											<div class="col-4"><button onClick="minusQuantity()" class="actbtn">-</button></div>

											<div class="col-4"><input id="quantity" value="1" min="1" type="number"></div>

											<div class="col-4"><button onClick="plusQuantity()" class="actbtn">+</button></div>

										</div>

									</div>

								</div>

								<div class="col-md-6">

									<button id="add_cart" class="btn1" onClick="addCart()">Add to cart <i class="fa fa-shopping-cart"></i></button>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>
		
		';
		
	}else{
		echo "<h3>This product is not available</h3>";
	}
	
}

function latest_products($merchant){
	include('connect.php');
	$query = "select * from merchant where name = '$merchant'";
	$run = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($run);
	$merchant_id = $row['id'];
	$getproducts = mysqli_query($connect, "select * from products where merchant = '$merchant_id' and status = 'active' order by id desc limit 12");
	$nproducts = mysqli_num_rows($getproducts);
	
	if($nproducts > 0){
		for($i=0; $i<$nproducts; $i++){
			$product_row = mysqli_fetch_assoc($getproducts);
			$product_id = $product_row['id'];
			$get_product_image = mysqli_query($connect, "select * from product_image where product = '$product_id' order by rand() limit 1");
			$image_row = mysqli_fetch_assoc($get_product_image);
			$image = $image_row['name'];
			echo '
			
			<div class="col-md-3">

				<a href="product-details?merchant='.$merchant.'&id='.base64_encode($product_id).'">

					<div id="product">

						<div class="image" align="center" style="background-image: url(\'uploads/products/'.$image.'\')"></div>

						<div class="name">'.$product_row['name'].'</div>

						<div>₦'.$product_row['price'].'</div>

					</div>

				</a>

			</div>
			
			';
		}
	}else{
		echo '<h3 style="text-align:center;">This user has no active products at the moment</h3>';
	}
	
	
	
}

function category_name($category_id){
	include('connect.php');
	$query = "select * from category where id = '$category_id'";
	$run = mysqli_query($connect, $query);
	$nrun = mysqli_num_rows($run);
	
	if($nrun > 0){
		$row = mysqli_fetch_assoc($run);
		echo $row['name'];
	}
}

function category_products($merchant, $cat_id){
	include('connect.php');
	$query = "select * from merchant where name = '$merchant'";
	$run = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($run);
	$merchant_id = $row['id'];
	$getproducts = mysqli_query($connect, "select * from products where merchant = '$merchant_id' and category = '$cat_id' and status = 'active'");
//	echo "select * from products where merchant = '$merchant_id' and category = '$cat_id' and status = 'active'";exit;
	$nproducts = mysqli_num_rows($getproducts);
	
	if($nproducts > 0){
		for($i=0; $i<$nproducts; $i++){
			$product_row = mysqli_fetch_assoc($getproducts);
			$product_id = $product_row['id'];
			$get_product_image = mysqli_query($connect, "select * from product_image where product = '$product_id' order by rand() limit 1");
			$image_row = mysqli_fetch_assoc($get_product_image);
			$image = $image_row['name'];
			echo '
			
			<div class="col-md-4">

				<a href="product-details?merchant='.$merchant.'&id='.base64_encode($product_id).'">

					<div id="product">

					<div class="image" align="center" style="background-image: url(\'uploads/products/'.$image.'\')"></div>

						<div class="name">'.$product_row['name'].'</div>

						<div>₦'.$product_row['price'].'</div>

					</div>

				</a>

			</div>
			
			';
		}
	}else{
		echo '<h3 style="text-align:center;">This merchant has no active products for this category</h3>';
	}
	
}

function all_products($merchant){
	include('connect.php');
	$query = "select * from merchant where name = '$merchant'";
	$run = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($run);
	$merchant_id = $row['id'];
	$getproducts = mysqli_query($connect, "select * from products where merchant = '$merchant_id' and status = 'active'");
	$nproducts = mysqli_num_rows($getproducts);
	
	if($nproducts > 0){
		for($i=0; $i<$nproducts; $i++){
			$product_row = mysqli_fetch_assoc($getproducts);
			$product_id = $product_row['id'];
			$get_product_image = mysqli_query($connect, "select * from product_image where product = '$product_id' order by rand() limit 1");
			$image_row = mysqli_fetch_assoc($get_product_image);
			$image = $image_row['name'];
			echo '
			
			<div class="col-md-4">

				<a href="product-details?merchant='.$merchant.'&id='.base64_encode($product_id).'">

					<div id="product">

						<div class="image" align="center" style="background-image: url(\'uploads/products/'.$image.'\')"></div>

						<div class="name">'.$product_row['name'].'</div>

						<div>₦'.$product_row['price'].'</div>

					</div>

				</a>

			</div>
			
			';
		}
	}else{
		echo '<h3 style="text-align:center;">This merchant has no active products at the moment</h3>';
	}
	
	
	
}

function cart_drop(){
    include('connect.php');
    $query = "select * from cart where order_id = '".$_SESSION['order_id']."'";
    $run = mysqli_query($connect, $query);
    $nrun = mysqli_num_rows($run);
    if($nrun > 0){
        for($i=0;$i<$nrun; $i++){
            $row = mysqli_fetch_assoc($run);
            $prid = $row['product_id'];
			$product_details = mysqli_query($connect, "select * from products where id = '$prid'");
			$details = mysqli_fetch_assoc($product_details);
            $img = mysqli_query($connect, "select * from product_image where product = '$prid' order by rand() limit 1");
            $rimg = mysqli_fetch_assoc($img);
            $img_name = $rimg['name'];
            echo '<div class="col-12">

                    <div class="cart-content">

                        <div class="row">
                        
                        <input type="hidden" value="'.$row['id'].'" id="cart_id'.$i.'">
                        <input type="hidden" value="'.$prid.'" id="pr_id'.$i.'">

                            <div class="col-4" onClick="delete_product('.$i.')" align="center">

                                <div class="image-holder"><img src="./uploads/products/'.$img_name.'" class="img-fluid"></div>

                                <i class="fas fa-times"></i>

                            </div>

                            <div class="col-8">

                                <div class="item-name">'.$details['name'].'</div>

                                &#8358;'.number_format($row['price']).' x '.$row['quantity'].' '.$row['product_size'].' '.$row['color'].'

                            </div>

                        </div>

                    </div>

                </div>';
        }
    }else{
        echo '<div class="col-12">No items in cart</div>';
    }
}

function cart_total(){
    include('connect.php');
    $query = "select sum(price*quantity) from cart where order_id = '".$_SESSION['order_id']."'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);	
    echo number_format($row['sum(price*quantity)']);
}

function product_search($merchant, $keyword){
	include('connect.php');
	$query = "select * from merchant where name = '$merchant'";
	$run = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($run);
	$merchant_id = $row['id'];
    if(!$keyword){
        $query2 = "select * from products where merchant = '$merchant_id' and status = 'active' order by id desc";
    }else{
        $query2 = "select * from products where merchant = '$merchant_id' and name like '%$keyword%' and status = 'active' order by id desc";
    }
    
	$getproducts = mysqli_query($connect, $query2);
    $nproducts = mysqli_num_rows($getproducts);
	
	if($nproducts > 0){
		for($i=0; $i<$nproducts; $i++){
			$product_row = mysqli_fetch_assoc($getproducts);
			$product_id = $product_row['id'];
			$get_product_image = mysqli_query($connect, "select * from product_image where product = '$product_id' order by rand() limit 1");
			$image_row = mysqli_fetch_assoc($get_product_image);
			$image = $image_row['name'];
			echo '
			
			<div class="col-md-3">

				<a href="product-details?merchant='.$merchant.'&id='.base64_encode($product_id).'">

					<div id="product">

						<div class="image" align="center" style="background-image: url(\'uploads/products/'.$image.'\')"></div>

						<div class="name">'.$product_row['name'].'</div>

						<div>₦'.$product_row['price'].'</div>

					</div>

				</a>

			</div>
			
			';
		}
	}else{
		echo '<h3 style="text-align:center;">No product found for "'.$keyword.'"</h3>';
	}
	
	
	
}

function banner_images($merchant){
	include('connect.php');
	$query = "select * from merchant where name = '$merchant'";
	$run = mysqli_query($connect, $query);
	$nrun = mysqli_num_rows($run);
	if($nrun > 0){
		$row = mysqli_fetch_assoc($run);
		$id = $row['id'];
		$banner_query = "select * from banner_images where merchant = '$id'";
		$banner_run = mysqli_query($connect, $banner_query);
		$nbanner = mysqli_num_rows($banner_run);
		
		if($nbanner > 0){
			$banner_row = mysqli_fetch_assoc($banner_run);
			echo '
			<div id="slider" class="slider">

				<div class="slider-item active" style="background-image: url('.'uploads/banner/'.$banner_row['name'].')">

					<div class="darkened">

						<div class="container">

							<div class="row">

								<p></p><br><br>
								<p class="visible-xs-block visible-sm-block"></p><br class="visible-xs-block visible-sm-block"><br class="visible-xs-block visible-sm-block">

								<div class="col-md-7">

									<h3>'.$banner_row['heading'].'</h3>


									<h4>'.$banner_row['caption'].'</h4><br>

								</div>

							</div>

						</div>

					</div>

				</div>
			
			';
			
			if($nbanner > 1){
				for($i=1; $i<$nbanner; $i++){
					$loop_row = mysqli_fetch_assoc($banner_run);
					echo '
				<div class="slider-item" style="background-image: url('.'uploads/banner/'.$loop_row['name'].')">

					<div class="darkened">

						<div class="container">

							<div class="row">

								<p></p><br><br>
								<p class="visible-xs-block visible-sm-block"></p><br class="visible-xs-block visible-sm-block"><br class="visible-xs-block visible-sm-block">

								<div class="col-md-7">

									<h3>'.$loop_row['heading'].'</h3>


									<h4>'.$loop_row['caption'].'</h4><br>

								</div>

							</div>

						</div>

					</div>

				</div>
					
					';
				}
			}
			
			echo '</div> <script src="dist/js/carmain.js"></script>';
			
		}
	}
	
}

function check_merchant($merchant){
	include('connect.php');
	$query = "select * from merchant where name = '$merchant'";
	$run = mysqli_query($connect, $query);
	$nrun = mysqli_num_rows($run);
	
	if($nrun > 0){
		$row = mysqli_fetch_assoc($run);
		if($row['status'] == "banned"){
			include('inc/header2.php');
			echo '
		<div id="home1" class="home">

			<div class="container">

				<div class="row">

					<div class="col-md-12 wow bounceInDown" align="center">

						<h3>This merchant has been banned</h3><p></p>

						Create your own store by clicking the link below<p></p><br>

						<a href="signup"><button class="btn1">Create a free account</button></a>

					</div>

				</div>

			</div>

		</div>
		';
		}else{			
			include('inc/marketheader.php');
		}
	}elseif(!$merchant){
		include('inc/header2.php');
		echo '
		<div id="home1" class="home">

			<div class="container">

				<div class="row">

					<div class="col-md-12 wow bounceInDown" align="center">

						<h3>No merchant found</h3><p></p>

						Create your own store by clicking the link below<p></p><br>

						<a href="signup"><button class="btn1">Create a free account</button></a>

					</div>

				</div>

			</div>

		</div>
		';
	}else{
		include('inc/header2.php');
		echo '
		<div id="home1" class="home">

			<div class="container">

				<div class="row">

					<div class="col-md-12 wow bounceInDown" align="center">

						<h3>No merchant found</h3><p></p>

						Create your own store by clicking the link below<p></p><br>

						<a href="signup"><button class="btn1">Create a free account</button></a>

					</div>

				</div>

			</div>

		</div>
		';
		
		include('inc/footer.php');
		exit;
	}
	
}

?>