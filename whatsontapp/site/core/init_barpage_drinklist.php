<?php
error_reporting(E_ERROR | E_PARSE);
// connection
include(dirname(__DIR__).'/core/init_connect.php');

// SQL query to fetch information of beer types and finds matches.
$barbeerquery="SELECT BeerID, Date 
FROM dbtablebarbeer
WHERE BarID= $barID";

$barbeerresult=mysqli_query($connection, $barbeerquery) or die('Could not look up barbeer information; ' . mysqli_error($connection));
$rows = mysqli_num_rows($barbeerresult);
                           
/*
     $now = time(); // or your date as well
     $your_date = strtotime("2016-01-01");
     $datediff = $now - $your_date;
     echo floor($datediff/(60*60*24));
     */
//$barName=array();
  //-create  while loop and loop through result set
  while($row=mysqli_fetch_array($barbeerresult)){
        $beerID = $row['BeerID'];
        $dbDate = strtotime($row['Date']);
        $now = time(); // or your date as well
        $datediff = $now - $dbDate;
        $dayscount = floor($datediff/(60*60*24));

        if($dayscount >= 180)
        {
            $barbeerdeletequery="DELETE FROM dbtablebarbeer
                WHERE Date < (CURDATE() - INTERVAL 180 DAY)";

            mysqli_query($connection, $barbeerdeletequery) or die('Could not look up barbeer information; ' . mysqli_error($connection));
             
            // way past current ,delete the barbeer entry
            $lastseen = " seen <font style='color:red;'>".$dayscount."</font> days ago"; 
        }
        elseif($dayscount >= 120)
        {
            // way past currentdelete the barbeer entry
            $lastseen = " seen <font style='color:red;'>".$dayscount."</font> days ago"; 
        }
        elseif ($dayscount >= 60)
        {
            // font color is red, no longer current
            $lastseen = " seen <font style='color:orange;'>".$dayscount."</font> days ago"; 
        }
        elseif($dayscount >= 30)
        {
            // font color is yellow needs updated
            $lastseen = " seen <font style='color:GoldenRod;'>".$dayscount."</font> days ago"; 
        }
        else
        {
            if($dayscount == 0)
            {
               
                $lastseen = " seen <font style='color:green;'>Today!</font>"; 
            }
            else
            {
                $lastseen = " seen <font style='color:green;'>".$dayscount."</font> days ago"; 
            }
        }
        $beer_details_url = "https://api.brewerydb.com/v2/beers?ids=".$beerID."&withBreweries=y&key=6dab466c8f0979f11e35908c1b6671ff&format=xml";
        $api_url=simplexml_load_file($beer_details_url);
        $brewerydb_results = $api_url-> data -> item;
        $brewerydb_name = isset($brewerydb_results -> name) ? $brewerydb_results -> name  : "-"; 
        $brewerydb_abv = isset($brewerydb_results -> abv) ? $brewerydb_results -> abv : "-";
        $brewerydb_style = isset($brewerydb_results -> style -> shortName) ? $brewerydb_results -> style -> shortName : "-";
        $brewerydb_brewery = isset($brewerydb_results -> breweries -> item -> name) ? $brewerydb_results -> breweries -> item -> name : "-";
        echo "<ul style='list-style-type:none;'>";
        echo "<li><font color='#377BB5'><a href=\"beerpage.php?id=$beerID\">" .$brewerydb_name. " - ". $brewerydb_style ." - ". $brewerydb_brewery ." - ". $brewerydb_abv ." %</a></font>".$lastseen."<a href=\"update.php?beid=$beerID&brid=$barID\"><i style='margin-left:25px;' class='fa fa-check-square'></i></a></li>\n";
        echo "</ul>";
  }
  
$beerTextField = $_POST['beerTextField'];
$beerName= mysqli_real_escape_string($connection, $beerTextField);

$api_key = "6dab466c8f0979f11e35908c1b6671ff";
// brewerydb api searching for beer by name
$brewerydb_api_url = "https://api.brewerydb.com/v2/search?type=beer&withBreweries=y&q=".$beerName."&p=1&key=".$api_key."&format=xml";
$api_url=simplexml_load_file($brewerydb_api_url);
$brewerydb2_results = $api_url-> data -> item;

$brewerydb_id = isset($brewerydb2_results -> id) ? $brewerydb2_results -> id  : NULL; 

 echo ' <form  method="post" action="addbeer.php?go&id='.$barID.'"  id="searchform">
                        <p>See a new beer at the bar? Search for and add it here!</p>
                        <input  type="text" name="name">
                        <input  type="submit" name="submit" value="Search For The Beer">
                      </form>
                      <br/>';

mysqli_close($connection);    
?>

