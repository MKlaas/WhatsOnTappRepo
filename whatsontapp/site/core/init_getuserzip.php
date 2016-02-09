<?php


// google places api search
$map_url = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+". $address ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
$xml=simplexml_load_file($map_url);

// load through results place within html and generate page
foreach ($xml->result as $result)
{

	
    $f_address = $result->formatted_address;
    // Explode formatted address and give it to multiple variables
    $zipExplode = explode(',', $f_address);
    $zipValue = $zipExplode[2];
    $finalZipcode[] = $zipValue[4].$zipValue[5].$zipValue[6].$zipValue[7].$zipValue[8];                    
    $nearbyZipcodes = array_values(array_unique($finalZipcode));    
 }
	
  
$nearbyZipcodesArray = implode("','",$nearbyZipcodes);
  //  echo $nearbyZipcodesArray;

/*
$string="1,2,3,4,5";
$array=array_map('intval', explode(',', $string));
$array = implode("','",$array);
$query=mysqli_query($conn, "SELECT name FROM users WHERE id IN ('".$nearbyZipcodesArray."')");
 */
  ?>