<?php
error_reporting(E_ERROR | E_PARSE);
include(dirname(__DIR__).'/account/core/init_profile.php'); 
$address = $zip;
// get nearby zip array
include(dirname(__DIR__).'/core/init_getuserzip.php');
// connection
include(dirname(__DIR__).'/core/init_connect.php');
// SQL query to fetch information of beer types and finds matches.
$barbeerquery="SELECT BeerName, BeerID, SUM(Vote) AS Total 
FROM dbtablebarbeer a INNER JOIN dbtablebar b ON b.BarID = a.BarID AND b.ZipCode LIKE '".$address[0].$address[1]."%' 
GROUP BY a.BeerName,a.BeerID
ORDER BY Total Desc
LIMIT 6
";




$barbeerresult=mysqli_query($connection, $barbeerquery) or die('Could not look up barbeer information; ' . mysqli_error($connection));
$rows = mysqli_num_rows($barbeerresult);
  
  //-create  while loop and loop through result set
  $api_key = "6dab466c8f0979f11e35908c1b6671ff";
 if (mysqli_num_rows($barbeerresult)<=0) 
 {  
     echo "Can't seem to find any trending beers in your area. Get a trend starting by adding some beers you see at your favorite bar!";
 }
 else
 {
  while($row=mysqli_fetch_array($barbeerresult)){
        $beerID = $row['BeerID'];
        $beer_details_url = "https://api.brewerydb.com/v2/beers?ids=".$beerID."&withBreweries=y&key=".$api_key."&format=xml";
        $api_url=simplexml_load_file($beer_details_url);
        $brewerydb_results = $api_url-> data -> item;
        $brewerydb_name = isset($brewerydb_results -> name) ? $brewerydb_results -> name  : "-"; 
        //$brewerydb_abv = isset($brewerydb_results -> abv) ? $brewerydb_results -> abv : "-";
        //$brewerydb_style = isset($brewerydb_results -> style -> shortName) ? $brewerydb_results -> style -> shortName : "-";
        //$brewerydb_brewery = isset($brewerydb_results -> breweries -> item -> name) ? $brewerydb_results -> breweries -> item -> name : "-";
        
        $brewerydb_icon = isset($brewerydb_results -> labels -> icon) ? "<p><img src='". $brewerydb_results -> labels -> medium ."'/></p>" : '<span class="fa-stack fa-5x">
					  <i class="fa fa-beer fa-stack-2x text-primary"></i>
					  <i class="fa fa-beer fa-stack-1x fa-inverse"></i>
                    </span> <br/><br/><br/><br/><br/><br/><br/>';
        echo '<div class="col-md-4">
                  <div class="panel panel-default">
                   ';
        echo '<div class="panel-heading"><h4><font color="#377BB5">'.$brewerydb_name.'</font></h4></div>';
        echo '<div class="panel-body">
                       '.$brewerydb_icon.'
                        <a href="beerpage.php?id='.$beerID.'" class="btn btn-default">Search For It!</a>
                    </div>';
        echo '</div>
            </div>';
  }
  }
mysqli_close($connection);    
?>
