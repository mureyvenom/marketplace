<?php session_start(); ?><nav class="navbar navbar-expand-md sticky-top navbar-light" id="navbar">
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
        <a class="nav-link" href="./">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./index#home2">Grow your business</a>
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
        <a class="nav-link" href="./index#home3">Why DemoName</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./index#home4">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./index#home5">FAQs</a>
      </li>
<!--
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
-->
      <?php if($_SESSION['user']){ ?>
      <li class="nav-item">
        <a class="nav-link" href="./logout">Logout</a>
      </li>
		
		<?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="./signin">Signin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./signup" id="create">Create a free account</a>
      </li>
		  
		  <?php } ?>
<!--
      <li class="nav-item">
        <a class="nav-link" href="#">Cart <i class="fa fa-shopping-cart"></i></a>
      </li>
-->
    </ul>
  </div>
</div>
</nav>

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