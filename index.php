<?php
session_start();
include('functions.php');

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">

    <title>DemoName</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="dist/css/bootstrap.css">

    <link href="dist/font-awesome/css/all.css" rel="stylesheet" type="text/css">

    <link rel="icon" href="images/favicon.ico" />

    <link href="dist/css/animate.css" rel="stylesheet">

    <link href="dist/css/toastr.css" rel="stylesheet">

    <script src="dist/js/jquery.3.4.1.min.js"></script>

    <script src="dist/js/popper.js" type="text/javascript"></script>

    <script src="dist/js/bootstrap.js" type="text/javascript"></script>

    <script src="dist/js/owl.carousel.js"></script>

    <script src="dist/js/toastr.js"></script>

    <!-- Main Stylesheet -->

    <link href="dist/style.css" rel="stylesheet" type="text/css" media="all">

    <script src="dist/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="170" class="wow fadeIn" class="wow fadeIn">

    <?php include('inc/header.php'); ?>

    <div id="home1" class="home">

        <div class="container">

            <div class="row">

                <div class="col-md-12 wow bounceInDown" align="center">

                    <h3>All Your Products In One Place</h3>
                    <p></p>

                    The easiest way to get an online store fast, gain customer trust, and connect with your target market<p></p><br>

                    <a href="signup"><button class="btn1">Create a free account</button></a>

                </div>

            </div>

        </div>

    </div>

    <script>
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 500) {
                $('#home1').addClass('scrolled');
            } else {
                $('#home1').removeClass('scrolled');
            }

            if (scroll >= 2850) {
                $('#home2').addClass('scrolled');
            } else {
                $('#home2').removeClass('scrolled');
            }

            if (scroll >= 3370) {
                $('#home3').addClass('scrolled');
            } else {
                $('#home3').removeClass('scrolled');
            }

            if (scroll >= 4130) {
                $('#home4').addClass('scrolled');
            } else {
                $('#home4').removeClass('scrolled');
            }
        })
    </script>

    <div id="completegradient" class="gradients"></div>

    <div id="home2" class="desktop">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12" align="center">

                    <h3>Grow your business</h3>

                </div>

            </div>

            <div class="content">

                <div class="row">

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-1">
                            <h1>1</h1>
                        </div>

                    </div>

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-2">

                            <br>

                            <i class="fa fa-user"></i><br>

                            Sign up and get a free website link instantly. Creating a DemoName account takes seconds.

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-2">

                            <br>

                            <i class="fa fa-shopping-cart"></i><br>

                            Add your products

                        </div>

                    </div>

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-1">
                            <h1>2</h1>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-1">
                            <h1>3</h1>
                        </div>

                    </div>

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-2">

                            <br>

                            <i class="fa fa-share"></i><br>

                            Copy and share your custom link to desired platforms e.g Instagram, WhatsApp, Twitter, Facebook or Snapchat.

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-2">

                            <br>

                            <i class="fa fa-money-bill"></i><br>

                            Start making sales

                        </div>

                    </div>

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-1">
                            <h1>4</h1>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div id="home2" class="mobile">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12" align="center">

                    <h3>Grow your business</h3>

                </div>

            </div>

            <div class="content">

                <div class="row">

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-1">
                            <h1>1</h1>
                        </div>

                    </div>

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-2">

                            <br>

                            <i class="fa fa-user"></i><br>

                            Sign up and get a free website link instantly. Creating a DemoName account takes seconds.

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-1">
                            <h1>2</h1>
                        </div>

                    </div>

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-2">

                            <br>

                            <i class="fa fa-shopping-cart"></i><br>

                            Add your products

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-1">
                            <h1>3</h1>
                        </div>

                    </div>

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-2">

                            <br>

                            <i class="fa fa-share"></i><br>

                            Copy and share your custom link to desired platforms e.g Instagram, WhatsApp, Twitter, Facebook or Snapchat.

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-1">
                            <h1>4</h1>
                        </div>

                    </div>

                    <div class="col-md-6 wow bounceInUp">

                        <div class="grow1-2">

                            <br>

                            <i class="fa fa-money-bill"></i><br>

                            Start making sales

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div id="home3">

        <div class="container">

            <div class="row">

                <div class="col-12" align="center">

                    <h3>Why DemoName</h3>

                    We exist to make your customers feel safe and comfortable doing business with you online.

                </div>

            </div>

            <div class="row">

                <div class="col-md-3">

                    <div class="content" align="center">

                        <i class="fa fa-2x fa-shopping-cart"></i><br>

                        <h4>Product Listing</h4>

                        Easily list your product(s) and accept payments via your custom link

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="content" align="center">

                        <i class="fa fa-2x fa-users"></i><br>

                        <h4>Customer Trust</h4>

                        Gain trust and upfront payment commitment from customers

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="content" align="center">

                        <i class="fa fa-2x fa-money-bill"></i><br>

                        <h4>Get Paid</h4>

                        Accept payments directly into your bank account and eliminate the risk of payment on delivery.

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="content" align="center">

                        <i class="fa fa-2x fa-eye"></i><br>

                        <h4>Gain Insight</h4>

                        Track what your customers are buying the most.

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div id="home4">

        <div class="container">

            <div class="row">

                <div class="col-12" align="center">

                    <h3>Pricing</h3>

                    Your business growth is our priority, we only earn when you earn

                </div>

            </div>

            <div class="row">

                <div class="col-md-4">

                    <div class="pricebox">

                        <h4>Payment Collection</h4>

                        <h2>5.0%</h2>

                        Per Sale<p></p>
                        Local Payments Only<p></p>
                        Mastercard<p></p>
                        Visa<p></p>
                        Bank Account<p></p>
                        USSD<p></p>

                        <a href="signup"><button class="btn1">Create a free account</button></a>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="pricebox">

                        <h4>Payout</h4>

                        <h2>₦0.00</h2>

                        Earnings are paid straight into your specified bank account at no charge.<p></p>

                        <a href="signup"><button class="btn1">Create a free account</button></a>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="pricebox">

                        <h4>Other Features</h4>

                        <h2>₦0.00</h2>

                        Product Hosting<p></p>
                        Payment Before Delivery<p></p>
                        Custom Shop Link<p></p>
                        Email Support<p></p>
                        Content Management<p></p>
                        Insights<p></p>

                        <a href="signup"><button class="btn1">Create a free account</button></a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div id="home5">

        <div class="container">

            <div class="row">

                <div class="col-12" align="center">
                    <h3>Frequently Asked Questions</h3>
                </div>

            </div>

            <div class="row" style="padding-top: 30px;">

                <div class="col-md-6">

                    <div class="row">

                        <div class="col-2">

                            <i class="fa fa-2x fa-question-circle"></i>

                        </div>

                        <div class="col-10">

                            <h4>What is DemoName</h4>

                            DemoName is a simple and easy way to launch and/or manage an online business that enables payment before delivery without coding skills or the need to set up a website.<br>
                            With DemoName, you get to list all your available products, upload their images, describe them and indicate their prices.You can also include delivery prices based on location. Then, share your store link directly to any social media for potential customers to check out and buy instantly.

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="row">

                        <div class="col-2">

                            <i class="fa fa-2x fa-question-circle"></i>

                        </div>

                        <div class="col-10">

                            <h4>How does DemoName help me gain customer/buyer trust?</h4>

                            DemoName eliminates the risks of payment on delivery and ensures that sellers deliver goods before they get value. This will allow customers to feel safer and trust you enough to buy from you.

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="row">

                        <div class="col-2">

                            <i class="fa fa-2x fa-question-circle"></i>

                        </div>

                        <div class="col-10">

                            <h4>I sell on Instagram and WhatsApp, how will DemoName help me?</h4>

                            DemoName organizes all your products in one place and gives your business structure. You can easily copy your custom shop link from your DemoName dashboard and paste it on your Instagram bio, share it on WhatsApp or on any other platform that you want. People can then click it, visit your shop and buy without having to chat with you.

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="row">

                        <div class="col-2">

                            <i class="fa fa-2x fa-question-circle"></i>

                        </div>

                        <div class="col-10">

                            <h4>Will DemoName manage my deliveries?</h4>

                            No, delivery of goods to buyers are handled by store owners. This allows you to control and ensure that products are sent out immediately.

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="row">

                        <div class="col-2">

                            <i class="fa fa-2x fa-question-circle"></i>

                        </div>

                        <div class="col-10">

                            <h4>What do i need to signup?</h4>

                            You only need a valid email address to signup

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="row">

                        <div class="col-2">

                            <i class="fa fa-2x fa-question-circle"></i>

                        </div>

                        <div class="col-10">

                            <h4>How secure are payments on DemoName?</h4>

                            DemoName takes card holder security very seriously. All payments are made over a secure channel, using the most secure online payment features and web technologies in general. Card details are handled with a PCIDSS (Payment Card Industry Data Security Standards) compliant payment partner.

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        // Select all links with hashes

        $('a[href*="#"]')

            // Remove links that don't actually link to anything

            .not('[href="#"]')

            .not('[href="#0"]')

            .click(function(event) {

                $('#digi-body').hide();
                $('#blog-body1').hide();
                $('#blog-body2').hide();
                $('#main-body').show();

                // On-page links

                if (

                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')

                    &&

                    location.hostname == this.hostname

                ) {

                    // Figure out element to scroll to

                    var target = $(this.hash);

                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

                    // Does a scroll target exist?

                    if (target.length) {

                        // Only prevent default if animation is actually gonna happen

                        event.preventDefault();

                        $('html, body').animate({

                            scrollTop: target.offset().top

                        }, 1000, function() {

                            // Callback after animation

                            // Must change focus!

                            var $target = $(target);

                            $target.focus();

                            if ($target.is(":focus")) { // Checking if the target was focused

                                return false;

                            } else {

                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable

                                $target.focus(); // Set focus again

                            };

                        });

                    }

                }

            });
    </script>

    <?php include('inc/footer.php') ?>

</body>

</html>