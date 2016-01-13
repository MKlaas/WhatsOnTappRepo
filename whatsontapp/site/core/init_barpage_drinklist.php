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
// SQL query to fetch information of beer types and finds matches.
$barbeerquery="SELECT BeerID 
FROM dbtablebarbeer
WHERE BarID= $barID";


$barbeerresult=mysql_query($barbeerquery);
$rows = mysql_num_rows($barbeerresult);

//$barName=array();
  //-create  while loop and loop through result set
  while($row=mysql_fetch_array($barbeerresult)){
        $beerID = $row['BeerID'];
        
        $beer_details_url = "http://api.brewerydb.com/v2/beers?ids=".$beerID."&withBreweries=y&key=6dab466c8f0979f11e35908c1b6671ff&format=xml";
        $api_url=simplexml_load_file($beer_details_url);
        $brewerydb_results = $api_url-> data -> item;
        $brewerydb_name = isset($brewerydb_results -> name) ? $brewerydb_results -> name  : "-"; 
        $brewerydb_abv = isset($brewerydb_results -> abv) ? $brewerydb_results -> abv : "-";
        $brewerydb_style = isset($brewerydb_results -> style -> shortName) ? $brewerydb_results -> style -> shortName : "-";
        $brewerydb_brewery = isset($brewerydb_results -> breweries -> item -> name) ? $brewerydb_results -> breweries -> item -> name : "-";
        echo "<ul style='list-style-type:none;'>";
        echo "<li><font color='#377BB5'><a  href=\"beerpage.php?id=$beerID\">" .$brewerydb_name. " - ". $brewerydb_style ." - ". $brewerydb_brewery ." - ". $brewerydb_abv ." %</a></font></li>\n";
          
//get beers by id. Separate by comma
        echo "</ul>";

  }
$beerTextField = $_POST['beerTextField'];
$beerName= mysql_real_escape_string($beerTextField);
$api_key = "6dab466c8f0979f11e35908c1b6671ff";
$brewerydb_api_url = "http://api.brewerydb.com/v2/search?type=beer&withBreweries=y&q=".$beerName."&p=1&key=".$api_key."&format=xml";
$api_url=simplexml_load_file($brewerydb_api_url);
$brewerydb2_results = $api_url-> data -> item;

$brewerydb_id = isset($brewerydb2_results -> id) ? $brewerydb2_results -> id  : NULL; 

 echo ' <form  method="post" action="addbeer.php?go&id='.$barID.'"  id="searchform">
                        <p>See a new beer at the bar? Search for and add it here!</p>
                        <input  type="text" name="name">
                        <input  type="submit" name="submit" value="Search Beers">
                      </form>
                      <br/>';


?>

