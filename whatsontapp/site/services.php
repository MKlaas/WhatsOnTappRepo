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
<div style="float:right; padding-right:20px;">
<?php
include('login\profile.php'); 
?>
</div>
</head>

<body>
 <?php
include('navbar.php'); 
?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Services
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Services</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

 
		
		  
<?php 
echo '<iframe 
	  width="700"
	  height="450"
	  frameborder="0" style="border:0"
	  src="https://www.google.com/maps/embed/v1/search?key=AIzaSyAsQreVM5VjCc_yXcMWPVJx3zeqWHyhOsc
		&q=bars+near+'.$zip.'" allowfullscreen>
	</iframe>';
	
	?>
<div style="float:right;">					
  <h3>Search Details</h3>
    <p>You  may search either by first or last name</p>
    <form  method="post" action="search_display.php?go"  id="searchform">
      <input  type="text" name="name">
      <input  type="submit" name="submit" value="Search Beers">
    </form>
	
	<br/><br/><br/>
<?php

if ($_POST['address_submit_button']) {

    $address = $_POST['address'];

}


?>

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
 echo "<h4>Bars Within <strong> " . $address ." </strong></h4>";
?>
 <?php
 

$connection = mysql_connect("localhost", "root", "admin");


// Selecting Database
$db = mysql_select_db("brew_view", $connection);
// SQL query to fetch information of beer types and finds matches.
$sqlquery="SELECT Name FROM dbtablebar";
$rows = mysql_num_rows($sqlquery);
$barName=array();
  //-run  the query against the mysql query function
  $sqlresult=mysql_query($sqlquery);
  //-create  while loop and loop through result set
  while($row=mysql_fetch_array($sqlresult)){
          $barName[]=$row['Name'];
		  
  }

$map_url = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+". $address ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
$xml=simplexml_load_file($map_url);
echo '<div class="row"> ';
foreach ($xml->result as $result)
{
	echo '<div class="col-md-4 text-center" style="height:350px; width:350px;">
            <div class="thumbnail"> <i class="fa fa-beer fa-stack-1x fa-inverse"></i>
                  <span class="fa-stack fa-5x">
                              <i class="fa fa-beer fa-stack-2x text-primary"></i>
                              <i class="fa fa-beer fa-stack-1x fa-inverse"></i>
                        </span>
                  <div class="caption">';

	if(in_array($result->name, $barName))
	{
	   echo "<h4><a href=''>" . $result->name . "</a></h4>";
	}
	
	else 
	{
	echo "<div style='float:right; font-size:200%;'><a href='addbar.php'>+</a></div>";
    echo "<h4>" . $result->name . "</h4>";
	
	}
	
	echo "<small >" . $result->formatted_address . "</small> <br>";
	echo "<small> Rating:" . $result->rating . "</small><br>";
	echo "<small>Price Level:" . $result->price_level . "</small>";
	echo ' 		 </div>
			  </div>
		   </div> ';
}
echo '</div>';

mysql_close($connection); // Closing Connection
  ?>

 


        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
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
