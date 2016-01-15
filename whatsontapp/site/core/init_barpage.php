<?php
$barID = $_GET['id'];
include(dirname(__DIR__).'/core/init_connect.php');
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

// google places api
$map_url = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+". $barZipCode ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";

$mapsearch_url=simplexml_load_file($map_url);
foreach ($mapsearch_url ->result as $result)
{
    // if its in our database, list it
    if($result->name == $barName)  
    { 
        $placeID = $result->place_id;        
        //$photo=$result->photo;
        $photo_reference = $result->photo[0]->photo_reference;
        $image= "https://maps.googleapis.com/maps/api/place/photo?maxwidth=550&maxheight=350&photoreference=". $photo_reference ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
        $detailsImage = isset($photo_reference) ? '<a href="'. $details_result->website.'"><image width="550" height="350" src="'. $image .'"</image></a>' : 
            '
            <div style="width:575px; height=:375px;">
            <i style="font-size:360px;" class="fa fa-home fa-stack-2x text-primary"></i>
            </div>
            ';
    } 
}
// google places detail api
$map_details = "https://maps.googleapis.com/maps/api/place/details/xml?placeid=". $placeID ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";

$mapdetails_url=simplexml_load_file($map_details);
foreach ($mapdetails_url ->result as $details_result)
{
    // results to variable
    $detailsPhoneNumber = isset($details_result->formatted_phone_number) ? "<small>" . $details_result->formatted_phone_number . "</small><br/>" : "-<br/>";
    $detailsAddress = isset($details_result->formatted_address) ? "<p>" .$details_result->formatted_address . "</p>" : "-<br/>";
    $detailsOperatingHoursMonday = isset($details_result->opening_hours->weekday_text[0]) ? "<h4> Operating Hours </h4>" . $details_result->opening_hours->weekday_text[0] . "</p>" : "-<br/>" ;
    $detailsOperatingHoursTuesday = isset($details_result->opening_hours->weekday_text[1]) ?  "<p>" . $details_result->opening_hours->weekday_text[1] . "</p>" : "-<br/>" ;
    $detailsOperatingHoursWednesday = isset($details_result->opening_hours->weekday_text[2]) ? $details_result->opening_hours->weekday_text[2] . "</p>" : "-<br/>" ;
    $detailsOperatingHoursThursday = isset($details_result->opening_hours->weekday_text[3]) ? "<p>" . $details_result->opening_hours->weekday_text[3] . "</p>" : "-<br/>" ;
    $detailsOperatingHoursFriday = isset($details_result->opening_hours->weekday_text[4]) ? "<p>" . $details_result->opening_hours->weekday_text[4] . "</p>" : "-<br/>" ;
    $detailsOperatingHoursSaturday = isset($details_result->opening_hours->weekday_text[5]) ? "<p>" . $details_result->opening_hours->weekday_text[5] . "</p>" : "-<br/>";           
    $detailsOperatingHoursSunday = isset($details_result->opening_hours->weekday_text[6]) ? "<p>" . $details_result->opening_hours->weekday_text[6] . "</p>" : "-<br/>" ;               
	$detailsWebsite = isset($details_result->website) ? '<br/><a href="'. $details_result->website .'">'. $details_result->website .'</a>': "-<br/>" ;
    
}
mysql_close($connection);    
?>