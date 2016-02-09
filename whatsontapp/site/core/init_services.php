<?php
error_reporting(E_ERROR | E_PARSE);
include(dirname(__DIR__).'/account/core/init_profile.php'); 
$address = $zip;

if ($_POST['address_submit_button']) {

    $address = $_POST['address'];

}

// get nearby zip array
include(dirname(__DIR__).'/core/init_getuserzip.php');
echo '<iframe 
	  width="700"
	  height="450"
	  frameborder="0" style="border:0"
	  src="https://www.google.com/maps/embed/v1/search?key=AIzaSyAsQreVM5VjCc_yXcMWPVJx3zeqWHyhOsc
		&q=bars+near+'.$address.'" allowfullscreen>
	</iframe>';
	

echo "<h4>Bars Within <strong> " . $address ." </strong></h4>";

// Connection
include(dirname(__DIR__).'/core/init_connect.php');

// SQL query to fetch information of beer types and finds matches.
$sqlquery="SELECT Name FROM dbtablebar WHERE ZipCode IN ('".$nearbyZipcodesArray."') OR Name LIKE '%".$address."%'";
// think this is screwing me up
//$sqlquery="SELECT Name FROM dbtablebar WHERE ZipCode LIKE '".$address[0].$address[1]."%' OR Name LIKE '%".$address."%'";

$sqlresult = mysqli_query( $connection,$sqlquery) or die('Could not look up bar information; ' . mysqli_error($connection));

$rows = mysqli_num_rows($sqlresult);

//-create  while loop and loop through result set
while($row=mysqli_fetch_array($sqlresult))
{
        $barName[]=$row['Name'];
}
 
$divid = 1; // set this to increment in loop giving each div a unique id

// google places api search
$map_url = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+". $address ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
$xml=simplexml_load_file($map_url);

echo '<div class="row"> ';
// load through results place within html and generate page
foreach ($xml->result as $result)
{
    $name = $result->name;
    $zip = $result->formatted_address;
	$photo=$result->photo;
	$photo_reference = $result->photo->photo_reference;
        
    // Explode formatted address and give it to multiple variables
    $zipExplode = explode(',', $zip);


    // formatted address values, dont need most of these.
    //$name = mysqli_real_escape_string($zipValues[0]);
    //$address = mysqli_real_escape_string($zipValues[1]);
    //$city = mysqli_real_escape_string($zipValues[2]);
    $zipValue = mysqli_real_escape_string($connection,$zipExplode[2]);
    //$country = mysqli_real_escape_string($zipValues[4]);
    //$zipcode = mysqli_real_escape_string($zipValues);
    $finalZipcode = $zipValue[4].$zipValue[5].$zipValue[6].$zipValue[7].$zipValue[8];    
    

        
    // photo reference requires separate google places api call to generate image
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
      
      // get barid from barname if in the the database, use id for url endpoint
	if(in_array($result->name, $barName))
	{
        
        $barNameValue = mysqli_real_escape_string($connection, $result->name);
  
        // get the Bar ID that corresponds to the bar name and zipcode here.
        $barIDQuery="SELECT BarID 
            FROM dbtablebar
            WHERE Name= '$barNameValue' AND ZipCode = '$finalZipcode'";
        $barIDResult = mysqli_query( $connection,$barIDQuery) or die('Could not look up bar information; ' . mysqli_error($connection));
        
        $barIDRows = mysqli_num_rows($barIDResult);
        // get values of id
        while($row=mysqli_fetch_array($barIDResult)){
       //$barName=$row['Name','BarID'];
          $barIDValue=$row['BarID'];
        }

        // then display the bar names in blue as a bar we have in the database
        if($barIDValue == null)
            {
                echo "<div style='float:right; font-size:200%;'><a href='addbar.php?n=".urlencode($name)."&a=".urlencode($zip)."'>+</a></div>";
                echo isset($result->name) ? "<h4>" . $result->name . "</h4>" : "-<br/>";
                
            }
            elseif($barIDValue != null)
            {
                echo isset($result->name) ? "<h4><a href=\"barpage.php?id=$barIDValue\">" . $result->name . "</a></h4>" : "-<br/>";     
            }
           
           // reset bar id so it doesnt carry a value over to the next bar
        $barIDValue = null;
	       
    }
	
	else 
	{
        
		echo "<div style='float:right; font-size:200%;'><a href='addbar.php?n=".urlencode($name)."&a=".urlencode($zip)."'>+</a></div>";
		echo isset($result->name) ? "<h4>" . $result->name . "</h4>" : "-<br/>";
	
	}
	
	echo isset($result->formatted_address) ? "<small>" . $result->formatted_address . "</small><br/>" : "-<br/>";
	echo isset($result->rating) ? "<small> Rating:" . $result->rating . "</small><br/>" : "-<br/>" ;
	echo isset($result->price_level) ? "<small>Price Level:" . $result->price_level . "</small><br/>" : "-<br/>" ;
	
	
	echo ' 		 </div>
			  </div>
		   </div> ';
}
echo '</div>';

mysqli_close($connection); // Closing Connection
  ?>