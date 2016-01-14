<?php
function addbar()
{
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

echo '<br/>';

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

mysql_select_db('dbname');

$sql_bar = "INSERT INTO dbtablebar (name, address, city, state, country, zipcode) 
VALUES ('$name', '$address', '$city', '$state', '$country', $zipcode)";
$retval_bar = mysql_query( $sql_bar, $link );
global $barID;
$barID = mysql_insert_id();


if(! $retval_bar )
{
  die('Could not enter bar data: ' . mysql_error());  
}

echo "<p>Thanks, follow us to the bar!</p>";
echo "<p>If you get lost go <a href = 'http://localhost/whatsontapprepo/whatsontapp/site/barpage.php?id=".$barID."'>here</a>.</p>";

// Close connection
mysql_close($link);    
}

if(isset($_POST['Add']))
{
    addBar();
    echo "<script>setTimeout(function(){window.location.href='http://localhost/whatsontapprepo/whatsontapp/site/barpage.php?id=".$barID."'},3000);</script>";
}
else 
{
    echo '  <form action="#" method="post">
    <p>
     <label for="searchTextField">Please insert an address:</label>
     <input id="searchTextField" name="searchTextField" type="text" size="100">
     <input id="zip_code" name="zip_code" type="text" size="12">
  
   </p>
    <div id="map_canvas"></div> 
    <input type="submit" name="Add" value="Add">

 </form>
 <form action="http://localhost/whatsontapprepo/whatsontapp/site/services.php">
  <input type="submit" value="Go Back">
</form>';
}

?>