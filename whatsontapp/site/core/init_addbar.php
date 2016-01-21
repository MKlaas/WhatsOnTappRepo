<?php
function addbar()
{
    // Connection
include(dirname(__DIR__).'/core/init_connect.php');

echo '<br/>';

// getting  user input from html variables
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


$sql_bar = "INSERT INTO dbtablebar (name, address, city, state, country, zipcode) 
VALUES ('$name', '$address', '$city', '".$state[1].$state[2]."', '$country', '$zipcode')";
$retval_bar = mysql_query( $sql_bar, $connection );
global $barID;
$barID = mysql_insert_id();


if(! $retval_bar )
{
  die('Could not enter bar data: ' . mysql_error());  
}

echo "<p>Thanks, follow us to the bar!</p>";
echo "<p>If you get lost go <a href = '/whatsontapprepo/whatsontapp/site/barpage.php?id=".$barID."'>here</a>.</p>";

// Close connection
mysql_close($connection);    
}

// get html add attribute, if value is posted run the addbar function and redirect
if(isset($_POST['Add']))
{
    addBar();
    echo "<script>setTimeout(function(){window.location.href='/whatsontapprepo/whatsontapp/site/barpage.php?id=".$barID."'},3000);</script>";
}
else 
{
    $name = $_GET['n'];
    $address = $_GET['a'];
    echo '  <form action="#" method="post">
    <p>
     <label for="searchTextField">Please insert an address:</label>
     <input id="searchTextField" name="searchTextField" type="text" size="100" value="'.urldecode($name).' '.urldecode($address).'">
     <input style="display:none;" id="zip_code" name="zip_code" type="text" size="12">
  
   </p>
    <div id="map_canvas"></div> 
    <input type="submit" name="Add" value="Add">

 </form>
 <form action="/whatsontapprepo/whatsontapp/site/services.php">
  <input type="submit" value="Go Back">
</form>';
}

?>