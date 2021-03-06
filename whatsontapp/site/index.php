<?php 
session_start();
if(!isset($_SESSION['login_user'])){
   //redirect or other you want
   header("Location: account/login.php"); // Redirecting To Home Page
}
?>

<!DOCTYPE html>
<html lang="en">



<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>What's on tapp</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <?php
    include('includes/navbar.php'); 
    ?>


    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('./images/beer-science-pour-perfect-glass-beer-every-single-time.w654.jpg');" ></div>
                <div class="carousel-caption">
                    <h2>Caption 1</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://www.bitrebels.com/wp-content/uploads/2012/11/how-to-open-beer-3.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Caption 2</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('./images/imagesJLC94UI5.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Caption 3</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to "What's on Tapp!"
                </h1>
                <p>Welcome to What's on Tapp! A site dedicated to showing what bars have what beers! As a user feel free to find your favorite bar and add the different beers they have so that others may see. On the home page you can see bars and beers trending in your area. If there are none, get your area started! Are you looking for a certain beer? Go to the services page and search for a beer, change the zip code to check different locations! Looking for a specific bar? Try searching the area via zip code, or by bar name. If the bar is highlighted blue then someone has been there before, go check it out! Otherwise feel free to add it and let other users know Whats on Tapp!</p>
                <h2 class="page-header">Bars Trending In Your Area!</h2>
                 <?php include('core/init_index_trendingbars.php'); ?>


            </div>
         
            

        
        <div class="row">
            <div class="col-lg-12">
                <h2>Top Beers In Your State!</h2>
            </div>
              <?php include('core/init_index_trendingbeers.php'); ?>
            
            
        </div>
        <!-- /.row -->
        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Would you like to give feed back on What's on Tapp? We would love to hear from you!</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="mailto:whatsontapp3@gmail.com">Contact Us</a>
                </div>
            </div>
        </div>

        

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <?php include('includes/footer.php'); ?>
                </div>
            </div>
        </footer>


    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
