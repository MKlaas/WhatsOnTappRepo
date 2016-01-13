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
$zipTextField = $_POST['zip_code'];
$beerTextField = $_POST['beerTextField'];

// bar info
$name = mysql_real_escape_string($searchTextFieldArray[0]);
$address = mysql_real_escape_string($searchTextFieldArray[1]);
$city = mysql_real_escape_string($searchTextFieldArray[2]);
$state = mysql_real_escape_string($searchTextFieldArray[3]);
$country = mysql_real_escape_string($searchTextFieldArray[4]);
$zipcode = mysql_real_escape_string($zipTextField);
echo 'Zip Code is: ' . $zipcode;
// beer info
$beerName= mysql_real_escape_string($beerTextField);
echo '<br/>BEER NAME HERE: ' . $beerName . "<br/>";


mysql_select_db('dbname');

$sql_bar = "INSERT INTO dbtablebar (name, address, city, state, country, zipcode) 
VALUES ('$name', '$address', '$city', '$state', '$country', $zipcode)";
$retval_bar = mysql_query( $sql_bar, $link );
$barID = mysql_insert_id();


// beer stuff with brewerydb api
$api_key = "6dab466c8f0979f11e35908c1b6671ff";
$brewerydb_api_url = "http://api.brewerydb.com/v2/search?type=beer&withBreweries=y&q=".$beerName."&p=1&key=".$api_key."&format=xml";
$api_url=simplexml_load_file($brewerydb_api_url);
$brewerydb_results = $api_url-> data -> item;
$brewerydb_id = isset($brewerydb_results -> id) ? $brewerydb_results -> id  : ""; 
$brewerydb_name = isset($brewerydb_results -> name) ? $brewerydb_results -> name  : ""; 

$sql_barbeer = "INSERT INTO dbtablebarbeer (BeerID, BarID) 
VALUES ('$brewerydb_id', '$barID')";
$retval_barbeer = mysql_query($sql_barbeer, $link);


if(! $retval_bar )
{

  die('Could not enter bar data: ' . mysql_error());
  
}

if(! $retval_barbeer )
{

die('Could not enter barbeer data: ' . mysql_error());

}

echo "Entered data successfully\n";


// Close connection
mysql_close($link);

?>