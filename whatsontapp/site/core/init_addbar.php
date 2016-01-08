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
//$breweryTextField = $_POST['breweryTextField'];
//$styleTextField = $_POST['styleTextField'];
//$abvTextField = $_POST['abvTextField'];
//$priceTextField = $_POST['priceTextField'];

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
echo 'BEER NAME HERE: ' . $beerName;
//$breweryName = mysql_real_escape_string($breweryTextField);
//$style = mysql_real_escape_string($styleTextField);
//$abv = mysql_real_escape_string($abvTextField);
//$price = mysql_real_escape_string($priceTextField);


mysql_select_db('dbname');

$sql_bar = "INSERT INTO dbtablebar (name, address, city, state, country, zipcode) 
VALUES ('$name', '$address', '$city', '$state', '$country', $zipcode)";
$retval_bar = mysql_query( $sql_bar, $link );
$barID = mysql_insert_id();

$sql_beer = "SELECT BeerID, Name FROM dbtablebeer WHERE Name = '$beerName'";
$beerSelectResult = mysql_query($sql_beer, $link);
if (mysql_num_rows($beerSelectResult) > 0) 
{
    // query has results
    echo " results found <br/>";  
    $row = mysql_fetch_row($beerSelectResult);
    $beerID = $row[0];
    echo "HERE IS THE ID: " . $beerID;
} 
else 
{
    // no results
   $sql_beer = "INSERT INTO dbtablebeer (Name) 
   VALUES ('$beerName')";
    /*
    $sql_beer = "INSERT INTO dbtablebeer (Name, BreweryName, Style, ABV, Price) 
    VALUES ('$beerName', '$breweryName', '$style', '$abv', '$price')";
    */
    $retval_beer = mysql_query($sql_beer, $link);
    $beerID = mysql_insert_id();
}


$sql_barbeer = "INSERT INTO dbtablebarbeer (BeerID, BarID) 
VALUES ('$beerID', '$barID')";
$retval_barbeer = mysql_query($sql_barbeer, $link);


if(! $retval_bar )
{

  die('Could not enter bar data: ' . mysql_error());
  
}
if(! $retval_beer )
{

die('Could not enter beer data: ' . mysql_error());
}
if(! $retval_barbeer )
{

die('Could not enter barbeer data: ' . mysql_error());

}

echo "Entered data successfully\n";


// Close connection
mysql_close($link);

?>