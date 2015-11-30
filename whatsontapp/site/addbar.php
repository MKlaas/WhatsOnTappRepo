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

   <input type="submit" value="Add Bar">

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

/*
$name = $_POST['name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$phoneNumber = $_POST['phoneNumber'];
*/
$name = $searchTextFieldArray[0];
$address = $searchTextFieldArray[1];
$city = $searchTextFieldArray[2];
$state = $searchTextFieldArray[3];
$country = $searchTextFieldArray[4];

$sql = "INSERT INTO dbtablebar (name, address, city, state, country) 
VALUES ('$name', '$address', '$city', '$state', '$country')";

mysql_select_db('dbname');
$retval = mysql_query( $sql, $link );

if(! $retval )
{

//  die('Could not enter data: ' . mysql_error());

}

//echo "Entered data successfully\n";


// Close connection
mysql_close($link);

?>


