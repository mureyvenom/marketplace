<script>
	
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};
	
let cart_number = <?php total_quantity(); ?>;

let order_id_session = "<?php echo $_SESSION['order_id'] ?>";
	
function update_price(){
    
    if(order_id_session.length < 1){
        document.getElementById('total').innerHTML = '0';
        return false;
    }

    document.getElementById("total").innerHTML = 'Loading...';

    $.post("ajax-cart-price.php", {
         order_id_session:order_id_session
     })
    .done(function(data){
        document.getElementById("total").innerHTML = data;
    })
}
	
function update_quantity(){
    if(order_id_session.length < 1){
        $("#navbar .badge").html(parseInt(cart_number));
        $(".float-cart .badge").html(parseInt(cart_number));
        return false;
    }
    $.post("ajax-cart-quantity.php", {
         order_id_session:order_id_session
     })
    .done(function(data){
        cart_number = data;
        $("#navbar .badge").html(parseInt(cart_number));
    })
}
	
function delete_product(del_id){
    let cart_id = $('#cart_id'+del_id).val();
    let pr_id = $('#pr_id'+del_id).val();
    
    document.getElementById("controlled").innerHTML = document.getElementById("controlled").innerHTML + '<div class="col-12" align="center"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></div>';   
    
    if(del_id.toString().length < 1 && !cart_id){
        alert("No parameters sent");
        return false;
    }

    $.post("ajax-clear.php", {
        cart_id:cart_id,
        pr_id:pr_id
    }).done(function(data){
        if(data == "success"){
            toastr["info"]("Product successfully removed from cart", "Removed from cart");
            update_cart();
			update_quantity();
			update_price();
        }else{
            alert(data);
        }
    });
}
	
function update_cart(){
	if(order_id_session.length < 1){
        document.getElementById('controlled').innerHTML = '<div class="col-12">No items in cart</div>';
        return false;
    }

    document.getElementById("controlled").innerHTML = '<div class="col-12" align="center">Loading...</div>';

    $.post("ajax-cart-drop.php", {
         order_id_session:order_id_session
     })
    .done(function(data){
        document.getElementById("controlled").innerHTML = data;
    })
}
	
function addCart(){
	document.getElementById("add_cart").innerHTML = '<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only">Loading...</span></div>';
	let quantity = document.getElementById("quantity").value;
	let product_id = document.getElementById("product_id").value;
	let product_price = document.getElementById("product_price").value;
	
	if(document.getElementById("size")){
		let size = document.getElementById("size").value;
		sessionStorage.setItem("product_size", size);
		let product_size = sessionStorage.getItem("product_size");
		
		if(sessionStorage.getItem("product_size") == ""){
			document.getElementById("add_cart").innerHTML = 'Add to cart <i class="fa fa-shopping-cart"></i>';
			toastr["error"]("A product size must be selected before adding to cart", "Unable to add to cart");
			return false;
		}
	}else{
		sessionStorage.setItem("product_size", "");
	}
	
	if(document.getElementById("color")){
		let color = document.getElementById("color").value;
		sessionStorage.setItem("product_color", color);
		let product_color = sessionStorage.getItem("product_color");
		
		if(sessionStorage.getItem("product_color") == ""){
			document.getElementById("add_cart").innerHTML = 'Add to cart <i class="fa fa-shopping-cart"></i>';
			toastr["error"]("A product color must be selected before adding to cart", "Unable to add to cart");
			return false;
		}else{
			
		}
		
	}else{
		sessionStorage.setItem("product_color", "");
	}
	
	if(quantity == 0){
		document.getElementById("add_cart").innerHTML = 'Add to cart <i class="fa fa-shopping-cart"></i>';
		toastr["error"]("Minimum amount that can be added to cart is 1", "Unable to add to cart");
		return false;
	}
	
	product_color = sessionStorage.getItem("product_color");
	product_size = sessionStorage.getItem("product_size");
	
	$.post("ajax-cart.php", {
		product_id: product_id,
		quantity: quantity,
		product_price: product_price,
		product_size: product_size,
		product_color: product_color
	}).done(function(data){
		if(data !== "Error in insertion"){
			document.getElementById("add_cart").innerHTML = 'Add to cart <i class="fa fa-shopping-cart"></i>';
			toastr["success"]("Product successfully added to cart", "Added to cart");
            order_id_session = data;
			document.getElementById("quantity").value = 1;
			update_cart();
			update_quantity();
			update_price();
		}
	})
	
	
}

function plusQuantity(){
	let quantity = parseInt(document.getElementById("quantity").value);
	
	document.getElementById("quantity").value = quantity+1;
		
}
	
function minusQuantity(){
	let quantity = parseInt(document.getElementById("quantity").value);

	if(quantity == 1){
		toastr["error"]("Minimum amount that can be added to cart is 1", "Error");
		return false
	}

	document.getElementById("quantity").value = quantity-1;

}
	
function switchImage(n){
	let imagesource = document.getElementById("switch"+n).src;
	
	document.querySelector(".switch-image.active").classList.remove("active");
	
	// document.getElementById("main-image").src = imagesource;
    document.querySelector('.image').style.backgroundImage = `url('${imagesource}')`;
	
	document.getElementById("switchbox"+n).classList.add("active");
	
	
}

function checkMerchantName() {
    let merchantName = document.getElementById("merchant").value;
    
    if(!merchantName){
        document.getElementById("merchantcheck").innerHTML = "";
        return false;
    }

    $.post("ajaxMerchantName.php", {
        merchant: merchantName
    }).done(function(data){
        if(data == "success"){
            document.getElementById("merchantcheck").innerHTML = '<div class="alert alert-success">Merchant name available</div>';
			document.getElementById("submit").disabled = false;
        }else{
            document.getElementById("merchantcheck").innerHTML = '<div class="alert alert-danger">'+data+'</div';
			document.getElementById("submit").disabled = true;
        }
    })
}

function checkMerchantEmail(){
    let merchantEmail = document.getElementById("email").value;

    if(!merchantEmail){
        document.getElementById("emailcheck").innerHTML = "";
        return false;
    }
    
    $.post("ajaxMerchantEmail.php", {
        email: merchantEmail
    }).done(function(data){
        if(data == "success"){
            document.getElementById("emailcheck").innerHTML = '<div class="alert alert-success">Email available</div>';
            document.getElementById("submit").disabled = false;
        }else{
            document.getElementById("emailcheck").innerHTML = '<div class="alert alert-danger">'+data+'</div';
            document.getElementById("submit").disabled = true;
        }
    })


}

function checkPasswords(){
    let password = document.getElementById("password").value;
    let confirm = document.getElementById("confirm").value;

    if(!confirm){
        document.getElementById("passwordcheck").innerHTML = "";
        return false;
    }

    if(password.length < 6){
        document.getElementById("passwordcheck").innerHTML = '<div class="alert alert-danger">Password must be at least 6 characters</div>';
        document.getElementById("submit").disabled = true;
        return false;
    }else{
        document.getElementById("passwordcheck").innerHTML = '';
        document.getElementById("submit").disabled = false;
    }

    if(password !== confirm){
        document.getElementById("passwordcheck").innerHTML = '<div class="alert alert-danger">Passwords do not match</div>';
        document.getElementById("submit").disabled = true;
        return false;
    }


}
	 
function subTotal(){
    document.getElementById("subtotal").innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>';
    $.post("ajax-sub-total.php", {
        order_id:order_id_session
    }).done(function(data){
        document.getElementById("subtotal").innerHTML = data;
    })
}
	
function resetCart(){
    $.post("ajax-cart-reset.php", {
        order_id:order_id_session
    }).done(function(data){
        document.getElementById("tbody").innerHTML = data;
    })
}
	  
function minusCart(id){
    if(!id){
        alert("No cart ID");
        return false;
    }
    
    document.getElementById("clear"+id).innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>';
    
    $.post("ajax-minus-cart.php", {
        cart_id:id
    }).done(function(data){
        resetCart();
        update_cart();
        subTotal();
        document.getElementById("clear"+id).innerHTML = '<i class="fa fa-times"></i>';
        update_price();
        update_quantity();
    })
    
    
}
	
    
function plusCart(id){
    if(!id){
        alert("No cart ID");
        return false;
    }
    
    document.getElementById("clear"+id).innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>';
    
    $.post("ajax-plus-cart.php", {
        cart_id:id
    }).done(function(data){
        resetCart();
        update_cart();
        subTotal();
        document.getElementById("clear"+id).innerHTML = '<i class="fa fa-times"></i>';
        update_price();
        update_quantity();
    })
    
    
}

function removeCart(id){
    if(!id){
        alert("No cart ID");
        return false;
    }
    
    document.getElementById("clear"+id).innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>';
    
    $.post("ajax-remove.php", {
        cart_id:id
    }).done(function(data){
        subTotal();
        document.getElementById("clear"+id).innerHTML = '<i class="fa fa-times"></i>';
        update_price();
        update_quantity();
        update_cart();
    })
    
}

</script>