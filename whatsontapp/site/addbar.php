<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Bar</title>
  <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
  <script type="text/javascript">
  function initialize() {
    var input = document.getElementById('searchTextField');
    var options = {componentRestrictions: {country: 'us'}};

    new google.maps.places.Autocomplete(input, options);
  }

  google.maps.event.addDomListener(window, 'load', initialize);
  </script>
</head>
<body>

  <form action="#" method="post">
    <p>
     <label for="searchTextField">Please insert an address:</label>
     <input id="searchTextField" name="searchTextField" type="text" size="150">
   </p>
   <p>
     <label for="beerTextField">What beer did you have/see?</label> <br/>
     <input id="beerTextField" name="beerTextField" type="text" size="50">
   </p>

   <input type="submit" value="Add">

 </form>
 <form action="http://localhost/whatsontapprepo/whatsontapp/site/services.php">
  <input type="submit" value="Go Back">
</form>
</body>
</html>  
<?php
$servername = "localhost";
$dbrootname = "root";
$dbpassword = "admin";
$dbname = "brew_view";

// Create connection
$conn = new mysqli($servername, $dbrootname, $dbpassword);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully"; 


if (!$link = mysql_connect($servername, $dbrootname, $dbpassword)) {
  echo 'Could not connect to mysql';
  exit;
}

if (!mysql_select_db($dbname, $link)) {
  echo 'Could not select database';
  exit;
}


?>
<br/>
<?php

$searchTextField = $_POST['searchTextField'];
$searchTextFieldArray = explode(',', $searchTextField);

$beerTextField = $_POST['beerTextField'];
// bar info
$name = mysql_real_escape_string($searchTextFieldArray[0]);
$address = mysql_real_escape_string($searchTextFieldArray[1]);
$city = mysql_real_escape_string($searchTextFieldArray[2]);
$state = mysql_real_escape_string($searchTextFieldArray[3]);
$country = mysql_real_escape_string($searchTextFieldArray[4]);

// beer info
$beername= mysql_real_escape_string($beerTextField);
$breweryName = mysql_real_escape_string(null);
$style = mysql_real_escape_string(null);
$abv = mysql_real_escape_string(null);
$price = mysql_real_escape_string(null);
// barbeer info
//$beerID = mysql_real_escape_string($searchTextFieldArray[0]);;
//$barID = mysql_real_escape_string($searchTextFieldArray[0]);;

$sql_bar = "INSERT INTO dbtablebar (name, address, city, state, country) 
VALUES ('$name', '$address', '$city', '$state', '$country')";
$sql_beer = "INSERT INTO 'dbtablebeer' ('Name', 'BreweryName', 'Style', 'ABV') 
VALUES ('$beerName', '$breweryName', '$style', '$abv', $price)";
/*
$sql_barbeer = "INSERT INTO 'dbtablebarbeer' ('BeerID', 'BarID') 
VALUES ('$beerID', '$barID')";
*/
mysql_select_db('dbname');
$bar_retval = mysql_query( $sql_bar, $link );
$beer_retval = mysql_query( $sql_beer, $link );
$barbeer_retval = mysql_query( $sql_barbeer, $link );

if(! $retval )
{

  die('Could not enter bar data: ' . mysql_error());

}

if(! $beer_retval )
{

  die('Could not enter beer data: ' . mysql_error());

}

if(! $barbeer_retval )
{

  die('Could not enter barbeer data: ' . mysql_error());

}

//echo "Entered data successfully\n";


// Close connection
mysql_close($link);

?>


