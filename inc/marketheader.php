<nav class="navbar navbar-expand-md sticky-top navbar-light" id="navbar">
<div class="container">
  <a class="navbar-brand" href="./">
  <!-- <img src="images/logo.png" class="img-fluid"> -->
  <span class="logo">Demo</span>
</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="./<?php echo $_SESSION['merchant']; ?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./products?merchant=<?php echo $_SESSION['merchant']; ?>">All Products</a>
      </li>
<!--
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Our Services
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
-->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">Search</a>
      </li>
      <li class="nav-item">
        <p id="show-cart" class="nav-link">Cart <i class="fa fa-shopping-cart"></i> <span class="badge"><?php total_quantity(); ?></span></p>
      </li>
<!--
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
-->
		
<!--
      <li class="nav-item">
        <a class="nav-link" href="#">Cart <i class="fa fa-shopping-cart"></i></a>
      </li>
-->
    </ul>
  </div>
</div>
</nav>

<!--Search Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
<!--
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
-->
      </div>
      <div class="modal-body">
        <div>
          
            <div class="col-12">
            
                <form class="" action="./presearch.php" method="post">
                
                    <div class="form-group">
                    
                        <input type="search" name="search" placeholder="Search through our catalogue" class="form-control">
												
						<input name="merchant" type="hidden" value="<?php echo $_SESSION['merchant']; ?>">
                    
                    </div>
                
                    <div class="form-group">
                    
                        <button class="btn btn-primary" style="width: 100%;">Search</button>
                    
                    </div>
                
                </form>
            
            </div>
          
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="cart-drop">

    <div class="container">
    
        <div class="row">
        
            <div class="col-md-7"></div>
        
            <div class="col-md-5">
            
                <div class="cart-main">
                
                    <div class="col-12">
                    
                        <div class="row">
                        
                            <div class="col-6">
                            
                                <h3>Cart</h3>
                            
                            </div>
                        
                            <div class="col-6" align="right">
                            
                                <button class="closebtn"><i class="fas fa-times"></i></button>
                            
                            </div>
                        
                        </div>
                    
                    </div>
                    
                    <div class="col-12">
                    
                        <div class="row">
                        
                            <div id="controlled" class="cart-content-hold">
                            
                                <?php cart_drop(); ?>
                                                        
                            </div>
                        
                        </div>
                    
                    </div>
                    
                    <div class="col-12">Total ₦<span id="total"><?php cart_total(); ?></span><p></p></div>
                    
                    <div class="col-12">
                    
                        <div class="row">
                        
                            <div class="col-6"><a href="./cart?merchant=<?php echo $_SESSION['merchant']; ?>"><button class="btn1">View Cart</button></a></div>
                        
                            <div class="col-6"><a href="./checkout?merchant=<?php echo $_SESSION['merchant']; ?>"><button class="btn1">Checkout</button></a></div>
                        
                        </div>
                    
                    </div>
                
                </div>
            
            </div>
        
        </div>
    
    </div>

</div>

<script>
    $( function () {
        $( window ).scroll( function () {
            var scroll = $( window ).scrollTop();
            if ( scroll >= 1 ) {
                $( "#navbar" ).addClass( 'scrolled' );
            } else {
                $( "#navbar" ).removeClass( "scrolled" );
            }
            
            
            
        } );


    } );
</script>

<script>
    
    var cartstatus = sessionStorage.getItem("cartstatus")
    
    $(document).ready(function(){
        
        console.log(cartstatus);
        if(cartstatus == "open"){
            $('#cart-drop').slideDown(220)
        }
    });
    
    $(document).mouseup(function(e) {
        var outside = $(".cart-main");
        var showcart = $("#showcart");

        // if the target of the click isn't the outside nor a descendant of the outside
        if (!outside.is(e.target) && !showcart.is(e.target) && outside.has(e.target).length === 0 && showcart.has(e.target).length === 0) {
            $('#cart-drop').slideUp(220);
            sessionStorage.setItem("cartstatus", "closed");
        }
    });

    $('#show-cart').click(function(){
        
        if(document.querySelector('#cart-drop').style.display !== 'block'){
            $('#cart-drop').slideDown(220); 
            sessionStorage.setItem("cartstatus", "open");
        }
    
    });

    $('.float-cart').click(function(){
        
        if(document.querySelector('#cart-drop').style.display !== 'block'){
            $('#cart-drop').slideDown(220); 
            sessionStorage.setItem("cartstatus", "open");
        }
    
    });

    $('#multi-drop').click(function(){
        
        $('#mobile-drop').slideToggle(200);
        
        if(document.querySelector('#cart-drop').style.display !== 'block'){
            $('#cart-drop').slideDown(220); 
            sessionStorage.setItem("cartstatus", "open");
        }
    
    });
    
    $('.closebtn').click(function(){
        
        $('#cart-drop').slideUp(220);
            sessionStorage.setItem("cartstatus", "closed");
    });
    

</script>