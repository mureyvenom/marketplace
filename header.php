<?php
require_once('connect.php');

$check_banner =  mysqli_query($connect, "select * from banner_images where merchant = '$id'");
$banner_number = mysqli_num_rows($check_banner);
$check_fee = mysqli_query($connect, "SELECT * FROM products where merchant = $id");
$totalfee = mysqli_num_rows($check_fee);
$account = $row['account'];
                    

?>
<nav class="navbar navbar-expand-md navbar-absolute navbar-fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler sidebar2-toggler" id="side-bar-2-toggle" data-target="#sidebar2" aria-controls="navigation-index" data-toggle="collapse" aria-expanded="false" aria-label="Toggle sidebar2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            
          </div>
          <button class="navbar-toggler" type="button" id="header-items-toggle" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
              
              <div class="input-group no-border">
                <input type="text" value="DemoName.com/<?php echo $row['name']; ?>" readonly class="form-control"  id="link">
              </div>
              <div class="input-group no-border">
                <button class="btn btn-primary" onClick="copyLink()">Copy Link</button>
              </div>
              <script>
                    function copyLink() {
                        var copyText = document.getElementById("link");
                        
                        
                        var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
                        
                        if(iOS == 'true'){
                            function iosCopyToClipboard(copyText) {
                                var oldContentEditable = copyText.contentEditable,
                                    oldReadOnly = copyText.readOnly,
                                    range = document.createRange();

                                copyText.contentEditable = true;
                                copyText.readOnly = false;
                                range.selectNodeContents(el);

                                var s = window.getSelection();
                                s.removeAllRanges();
                                s.addRange(range);

                                copyText.setSelectionRange(0, 999999); // A big number, to cover anything that could be inside the element.

                                copyText.contentEditable = oldContentEditable;
                                copyText.readOnly = oldReadOnly;

                                document.execCommand('copy');
                            }
                        }else{
                            copyText.select();
                            document.execCommand("copy");
                            alert("Market Link Copied ");
                        }
                        
                        
                    }
                </script>
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Todos <i class="fa fa-bell"></i>
                    <?php 
    if(mysqli_num_rows($check_todo1) < 1){
        echo '<i class="fa fa-exclamation" style="color:red"></i>';
    }elseif($totalfee == 0){
        echo '<i class="fa fa-exclamation" style="color:red"></i>';
    }elseif(!$account){
        echo '<i class="fa fa-exclamation" style="color:red"></i>';
    }
    ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <?php if(mysqli_num_rows($check_banner) < 1){ ?><a class="dropdown-item" href="banner-images.php">Add Banner Image</a>
                    <?php } ?>
                  <?php if($totalfee == 0){ ?><a class="dropdown-item" href="delivery-details.php">Edit Delivery Details</a><?php } ?>
                    <?php if(!$account){ ?>
                  <a class="dropdown-item" href="edit-profile.php">Add Account Details</a> <?php } ?>
                    
                    <?php
                    
                    if($banner_number > 0 and $totalfee > 0 and $account){
                        echo 'All Items Completed';
                    }
                    
                    ?>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>