<?php error_reporting(E_ERROR | E_PARSE); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modern Business - Start Bootstrap Template</title>

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
</div>
</head>

<body>
<?php
include('includes/navbar.php'); 
?>


    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Services
                    <small>Subheading</small>
                </h1>
                
        </div>
        <!-- /.row -->

 
		
		  
<div style="float:right;">					
  <h3>Search Details</h3>
    <p>You  may search name or type</p>
    <form  method="post" action="search_display.php?go"  id="searchform">
      <input  type="text" name="name">
      <input  type="submit" name="submit" value="Search Beers">
    </form>
	
	<br/><br/><br/>
	


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> <!-- notice the updated action -->
<input  type="text" name="address">
 <input  type="submit" name="address_submit_button" value="Search Bars By Zipcode ">
</form>

</div>
	<br/><br/>
        <!-- /.row -->

        <!-- Service Panels -->
        <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->

<?php
include('core/init_search_service.php'); 
?>
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; What's on Tapp! 2015</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
