<?php
error_reporting(E_ERROR | E_PARSE);
include(dirname(__DIR__).'/account/core/init_profile.php'); 
$address = $zip;
// get zip array
include(dirname(__DIR__).'/core/init_getuserzip.php');
// Connection
include(dirname(__DIR__).'/core/init_connect.php');

// SQL query to fetch information of beer types and finds matches.
$sqlquery="SELECT Name, clicked FROM dbtablebar WHERE ZipCode IN ('".$nearbyZipcodesArray."') ORDER BY clicked DESC LIMIT 4";


$sqlresult = mysqli_query( $connection,$sqlquery) or die('Could not look up bar information; ' . mysqli_error($connection));

$rows = mysqli_num_rows($sqlresult);

//-create  while loop and loop through result set
while($row=mysqli_fetch_array($sqlresult))
{
        $barName[]=$row['Name'];
}
 
$divid = 1;
$map_url = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+". $address ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
$xml=simplexml_load_file($map_url);
echo '<div class="row"> ';

// go through xml file 
foreach ($xml ->result as $result)
{
    if(count(in_array($result->name, $barName)) <= 0)
    {
        
        echo "<p> Hmm, No bars seem to be trending in this area. Get one started by adding your favorite bar!</p>"; break;
    }
    
    // get the bar id of the bar name to place as the id to hyperlinks to use in url later
    if(in_array($result->name, $barName))
	{
      
        $barNameValue = mysqli_real_escape_string($connection, $result->name);
        $barIDQuery="SELECT BarID 
            FROM dbtablebar
            WHERE Name= '$barNameValue'
            AND zipcode IN ('".$nearbyZipcodesArray."')";
        $barIDResult = mysqli_query( $connection,$barIDQuery) or die('Could not get bar information; ' . mysqli_error($connection)); 
        $barIDRows = mysqli_num_rows($barIDResult);
        
        while($row=mysqli_fetch_array($barIDResult))
        {
       //$barName=$row['Name','BarID'];
          $barIDValue=$row['BarID'];
        }
        
	$photo=$result->photo;
	$photo_reference = $result->photo->photo_reference;
    // photo reference requires separate google places api call to generate the image
	$image= "https://maps.googleapis.com/maps/api/place/photo?maxwidth=200&maxheight=140&photoreference=". $photo_reference ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
	echo isset($photo_reference) ? '<div id="'. $divid++ .'"  class="col-md-4 text-center" style="height:350px; width:350px;">
            <div class="thumbnail"> <image src="'. $image .'"</image>
                  <div class="caption">' 
				  : 	  
			'<div id="'. $divid++ .'"  class="col-md-4 text-center" style="height:350px; width:350px;">
				<div class="thumbnail"> <i class="fa fa-beer fa-stack-1x fa-inverse"></i>
                  <span class="fa-stack fa-5x">
					  <i class="fa fa-beer fa-stack-2x text-primary"></i>
					  <i class="fa fa-beer fa-stack-1x fa-inverse"></i>
                    </span>
                  <div class="caption">' ;
		echo isset($result->name) ? "<h4><a  href=\"barpage.php?id=$barIDValue\">" . $result->name . "</a></h4>" : "-<br/>";
			echo isset($result->formatted_address) ? "<small>" . $result->formatted_address . "</small><br/>" : "-<br/>";
	echo isset($result->rating) ? "<small> Rating:" . $result->rating . "</small><br/>" : "-<br/>" ;
	echo isset($result->price_level) ? "<small>Price Level:" . $result->price_level . "</small><br/>" : "-<br/>" ;	
	echo ' 		 </div>
			  </div>
		   </div> ';
	}

}

echo '</div>';

mysqli_close($connection); // Closing Connection
  ?>
  
  