<?php
require_once('connect.php');
$check_todo1 = mysqli_query($connect, "select * from banner_images where merchant = '$id'");
$check_todo2 = mysqli_query($connect, "SELECT SUM(fee) AS Totalfee FROM delivery where merchant = '$id'");
$totalfee = mysqli_fetch_assoc($check_todo2)['Totalfee'];
$account = $row['account'];

$pend = mysqli_query($connect, "select * from completed where status = 'pending' and payment_status='confirmed' and merchant = '$id'");
$npend = mysqli_num_rows($pend);
?>
<div class=" " data-color="white" data-active-color="danger" id="">
<div class="sidebar collapse show" data-color="white" data-active-color="danger" id="sidebar">
      <div class="logo" align="center">
        
        <a href="#" class="simple-text logo-normal">
          <?php echo $row['name']; ?>
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="navlink<?php if($page == 'dash'){echo ' active';} ?>">
            <a href="./dashboard">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-desktop"></i></div><div class="col-md-10 col-sm-10">Dashboard</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'edit-pro'){echo ' active';} ?>">
            <a href="./edit-profile">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-user"></i></div><div class="col-md-10 col-sm-10">Edit Profile</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'banner'){echo ' active';} ?>">
            <a href="./banner-images">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-image"></i></div><div class="col-md-10 col-sm-10">Banner Images</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'add-prod'){echo ' active';} ?>">
            <a href="./add-products">
                <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-shopping-cart"></i></div><div class="col-md-10 col-sm-10">Add Product</div></div></div>
            </a>
          </li>
<!--
          <li class="navlink<?php if($page == 'add-cat'){echo ' active';} ?>">
            <a href="./add-category.php">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-list"></i></div><div class="col-md-10 col-sm-10">Add/Edit Category</div></div></div>
            </a>
          </li>
-->
          <li class="navlink<?php if($page == 'confirmed'){echo ' active';} ?>">
            <a href="./confirmed-orders">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-check"></i></div><div class="col-md-10 col-sm-10">Confirmed Orders</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'pending'){echo ' active';} ?>">
            <a href="./pending-orders">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-exclamation"></i></div><div class="col-md-10 col-sm-10">Pending Orders <?php if($npend>0){echo '<span class="pending-counter">'.$npend.'</span>'; } ?></div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'payouts'){echo ' active';} ?>">
            <a href="./confirmed-payouts">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-money-bill"></i></div><div class="col-md-10 col-sm-10">Confirmed Payouts</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'delivery'){echo ' active';} ?>">
            <a href="./delivery-details">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-truck"></i></div><div class="col-md-10 col-sm-10">Delivery Details</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'password'){echo ' active';} ?>">
            <a href="./change-password">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-key"></i></div><div class="col-md-10 col-sm-10">Change Password</div></div></div>
            </a>
          </li>
          <li class="navlink">
            <a href="./logout">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-sign-out-alt"></i></div><div class="col-md-10 col-sm-10">Log Out</div></div></div>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="sidebar collapse" data-color="white" data-active-color="danger" id="sidebar2">
      <div class="logo">
        
        <a href="#" class="simple-text logo-normal">
          <?php echo $row['name']; ?>
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="navlink<?php if($page == 'dash'){echo ' active';} ?>">
            <a href="./dashboard">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-desktop"></i></div><div class="col-md-10 col-sm-10">Dashboard</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'edit-pro'){echo ' active';} ?>">
            <a href="./edit-profile">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-user"></i></div><div class="col-md-10 col-sm-10">Edit Profile</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'banner'){echo ' active';} ?>">
            <a href="./banner-images">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-image"></i></div><div class="col-md-10 col-sm-10">Banner Images</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'add-prod'){echo ' active';} ?>">
            <a href="./add-products">
                <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-shopping-cart"></i></div><div class="col-md-10 col-sm-10">Add Product</div></div></div>
            </a>
          </li>
<!--
          <li class="navlink<?php if($page == 'add-cat'){echo ' active';} ?>">
            <a href="./add-category.php">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-list"></i></div><div class="col-md-10 col-sm-10">Add/Edit Category</div></div></div>
            </a>
          </li>
-->
          <li class="navlink<?php if($page == 'confirmed'){echo ' active';} ?>">
            <a href="./confirmed-orders">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-check"></i></div><div class="col-md-10 col-sm-10">Confirmed Orders</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'pending'){echo ' active';} ?>">
            <a href="./pending-orders">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-exclamation"></i></div><div class="col-md-10 col-sm-10">Pending Orders <?php if($npend>0){echo '<span class="pending-counter">'.$npend.'</span>'; } ?></div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'payouts'){echo ' active';} ?>">
            <a href="./confirmed-payouts">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-money-bill"></i></div><div class="col-md-10 col-sm-10">Confirmed Payouts</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'delivery'){echo ' active';} ?>">
            <a href="./delivery-details">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-truck"></i></div><div class="col-md-10 col-sm-10">Delivery Details</div></div></div>
            </a>
          </li>
          <li class="navlink<?php if($page == 'password'){echo ' active';} ?>">
            <a href="./change-password">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-key"></i></div><div class="col-md-10 col-sm-10">Change Password</div></div></div>
            </a>
          </li>
          <li class="navlink">
            <a href="./logout">
              <div class="col-md-12 col-sm-12"><div class="row"><div class="col-md-2 col-sm-2"><i class="fa fa-sign-out-alt"></i></div><div class="col-md-10 col-sm-10">Log Out</div></div></div>
            </a>
          </li>
        </ul>
      </div>
    </div>
    </div>