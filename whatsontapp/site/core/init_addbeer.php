 <?php
$barID = $_GET['id'];
 if(isset($_POST['Add']))
{
    $barID = $_GET['brid'];
    addBeer();
    echo "<script>setTimeout(function(){window.location.href='http://localhost/whatsontapprepo/whatsontapp/site/barpage.php?id=".$barID."'},3000);</script>";
    echo "</head>";
    
}
else
{
    echo "</head>";
    if (isset($_POST['submit'])) 
    {
        if (empty($_POST['name'])) 
        {
         $error = "Please enter name or style";
        }
         else
        {
        $name=$_POST['name'];
        $api_key = "6dab466c8f0979f11e35908c1b6671ff";
        $brewerydb_api_url = "http://api.brewerydb.com/v2/search?type=beer&withBreweries=y&q=".$name."&p=1&key=".$api_key."&format=xml";

        $api_url=simplexml_load_file($brewerydb_api_url);
        $brewerydb_results = $api_url-> data -> item;


        $brewerydb_id = isset($brewerydb_results -> id) ? "<p>" . $brewerydb_results -> id . "</p>" : "- <br/>";; 
        $brewerydb_id_value = isset($brewerydb_results -> id) ? $brewerydb_results -> id : NULL; 
        $brewerydb_name = isset($brewerydb_results -> name) ? "<p>" . $brewerydb_results -> name . "</p>" : "0"; 
        $brewerydb_description = isset($brewerydb_results -> description) ? "<p>" . $brewerydb_results -> description . "</p>" : "<br/>-<br/>"; 
        $brewerydb_abv = isset($brewerydb_results -> abv) ? "<p>" . $brewerydb_results -> abv . "%</p>" : "-<br/>"; 
        $brewerydb_style = isset($brewerydb_results -> style -> shortName) ? "<p>" . $brewerydb_results -> style -> shortName . "</p>" : "-<br/>"; 
        $brewerydb_icon = isset($brewerydb_results -> labels -> icon) ? "<p><img src='". $brewerydb_results -> labels -> medium ."'/></p>" : "-<br/>";
        $brewerydb_brewery = isset($brewerydb_results -> breweries -> item -> name) ? "<p>". $brewerydb_results -> breweries -> item -> name ."</p>" : "-<br/>";
        $brewerydb_website = isset($brewerydb_results -> breweries -> item -> website) ? "<p><a href=". $brewerydb_results -> breweries -> item -> website .">".$brewerydb_results -> breweries -> item -> website."</a></p>" : "-<br/>";

        echo $brewerydb_name;
        echo $brewerydb_description;
        echo $brewerydb_abv;
        echo $brewerydb_style;
        echo $brewerydb_icon;
        echo $brewerydb_brewery;
        echo $brewerydb_website;
        }                
    }
    
if($brewerydb_name == "0")
{
    echo 'Sorry We Couldn\'t Fetch Any Info ';
}
else
{    
echo '<form action="addbeer.php?brid='.$barID.'&beid='.$brewerydb_id_value.'" method="post">
<p>Is this the beer? Go ahead and add it!</p>
    <input type="submit" name="Add" value="Add" />
</form>
' ;
}

echo '<p> If this isn\'t the beer you\'re looking for, try searching again. </p>
        <form  method="post" action="addbeer.php?go&id='.$barID.'"  id="searchform">
            <p>See a new beer at the bar? Search for and add it here!</p>
            <input  type="text" name="name">
            <input  type="submit" name="submit" value="Search Beers">
            </form>
            <br/>';
    
}

function addBeer()
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

$barID = $_GET['brid'];
$brewerydb_id_value = $_GET['beid'];
    
    $sql_barbeer = "INSERT INTO dbtablebarbeer (BeerID, BarID) 
    VALUES ('$brewerydb_id_value', '$barID')";
    $retval_barbeer = mysql_query($sql_barbeer, $link);
    if(! $retval_barbeer )
    {
        die('Could not enter data: ' . mysql_error());
    } 
    else
    {
        echo "Thanks for the heads up! you'll be back at the bar in just a few seconds.... <br/><br/> If not take the following link back to the <a href='http://localhost/whatsontapprepo/whatsontapp/site/barpage.php?id=".$barID."'>bar</a>";
    }
    
   }
?>
    