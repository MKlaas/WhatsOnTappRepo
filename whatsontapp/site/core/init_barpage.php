<?php
$barID = $_GET['id'];

$connection = mysql_connect("localhost", "root", "admin");

// Selecting Database
$db = mysql_select_db("brew_view", $connection);
// SQL query to fetch information of beer types and finds matches.
// for the bars table
$barquery="SELECT Name, Address, City, State, ZipCode, PhoneNumber, Country 
    FROM dbtablebar 
    WHERE BarID = $barID";
$barresult=mysql_query($barquery);
$rows = mysql_num_rows($barresult);

  //-create  while loop and loop through result set
  while($row=mysql_fetch_array($barresult)){
          $barName=$row['Name'];
          $barAddress=$row['Address'];
          $barCity=$row['City'];
          $barState=$row['State'];
          $barZipCode=$row['ZipCode'];
          $barPhoneNumber=$row['PhoneNumber'];
          $barCountry=$row['Country'];
  }
 
 
 echo $barName;
 echo $barCity;
 echo $barZipCode . "<br/>";
 // this is a placedetails search 

$mapearch_url = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+". $barCity ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";

$mapsearch_url=simplexml_load_file($map_url);
foreach ($mapsearch_url->result as $result)
{

	//$photo=$result->photo;
	//$photo_reference = $result->photo->photo_reference;
	//$image= "https://maps.googleapis.com/maps/api/place/photo?maxwidth=200&maxheight=140&photoreference=". $photo_reference ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
/*
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
*/

    if($result->name == $barName)  
    { 
        echo 'TRUE TRUE TRUE';
        echo isset($result->place_id) ? "Place ID is: " . $result->place_id : "-<br/>";
        $placeID = $result->place_id;
        // assuming this works i then want to place the Place ID into a variable 
        // which is then places in the details map url 
        // to use in a details search where i will yet again extract info just like i do here currently.__CLASS__
        // Specifically going for work hours, pictures, maybe reviews.
    } 
    else
    {
        // Likely will need a redirect to 404 here;
        echo "Sorry, no information on ". $barName . "could be found :(";
    }
}
$map_details = "https://maps.googleapis.com/maps/api/place/details/xml?placeid=ChIJTX-EuVmxQYgR4UFlhpkdyIk&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";

$mapdetails_url=simplexml_load_file($map_details);
foreach ($map_details->result as $details_result)
{
    $photo=$details_result->photo;
	$photo_reference = $details_result->photo->photo_reference;
    
    echo isset($details_result->formatted_phone_number) ? "<small>" . $details_result->formatted_phone_number . "</small><br/>" : "-<br/>";
    echo isset($details_result->formatted_address) ? "<small>" . $details_result->formatted_address . "</small><br/>" : "-<br/>";
    echo isset($details_result->opening_hours->period->open->time) ? "<small> Rating:" . $details_result->opening_hours->period->open . "</small><br/>" : "-<br/>" ;
    echo isset($details_result->opening_hours->period->close->time) ? "<small> Rating:" . $details_result->opening_hours->period->close . "</small><br/>" : "-<br/>" ;
	echo isset($details_result->website) ? "<small>Price Level:" . $details_result->website . "</small><br/>" : "-<br/>" ;
    $photo=$result->photo;
	$photo_reference = $result->photo->photo_reference;
	$image= "https://maps.googleapis.com/maps/api/place/photo?maxwidth=200&maxheight=140&photoreference=". $photo_reference ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
    echo isset($photo_reference) ? '<image src="'. $image .'"</image>' : "-<br/>";
}

?>