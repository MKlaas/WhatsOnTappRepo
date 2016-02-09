<?php
$barID = $_GET['id'];
include(dirname(__DIR__).'/core/init_connect.php');
// SQL query to fetch information of beer types and finds matches.
$loaded = false;

$viewed = 0;
//if no such session exists, assume that its their first time viewing.
if(!isset($_SESSION[$viewed.'_v'])){

// update click variable in db
$barClicked =" UPDATE dbtablebar 
    SET clicked = clicked + 1
    WHERE BarID = '$barID'";
    
$barClickedresult=mysqli_query($connection, $barClicked) or die('Could not update bar click ' . mysqli_error($connection));;

    //set session variable saying they've viewed this institutions page.
    $_SESSION[$viewed.'_v'] = 1;

}


// for the bars table
$barquery="SELECT Name, Address, City, State, ZipCode, PhoneNumber, Country 
    FROM dbtablebar 
    WHERE BarID = $barID";
$barresult=mysqli_query($connection, $barquery) or die('Could not look up bar information ' . mysqli_error($connection));
$rows = mysqli_num_rows($barresult);

  //-create  while loop and loop through result set
  while($row=mysqli_fetch_array($barresult)){
          $barName=$row['Name'];
          $barAddress=$row['Address'];
          $barCity=$row['City'];
          $barState=$row['State'];
          $barZipCode=$row['ZipCode'];
          $barPhoneNumber=$row['PhoneNumber'];
          $barCountry=$row['Country'];
  }

// use this to say if it was found in the first second or third page and prevent from going to next page.
$found = 0;
// google places api
$map_url = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+". $barZipCode ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";

$mapsearch_url=simplexml_load_file($map_url);
foreach ($mapsearch_url ->result as $result)
{
    // if its in our database, list it
    if($result->name == $barName)  
    { 
        $found = 1;
        $loaded = true;
        $placeID = $result->place_id;        
        //$photo=$result->photo;
        $photo_reference = $result->photo[0]->photo_reference;
        $image= "https://maps.googleapis.com/maps/api/place/photo?maxwidth=550&maxheight=350&photoreference=". $photo_reference ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
        $detailsImage = isset($photo_reference) ? $details_result->website.'<image width="550" height="350" src="'. $image .'"</image>' : 
            '
            <div style="width:575px; height=:375px;">
            <i style="font-size:360px;" class="fa fa-home fa-stack-2x text-primary"></i>
            </div>
            '; break;
    }
    
    $nextPage1 = isset($mapsearch_url -> next_page_token) ? $mapsearch_url -> next_page_token : "0" ;
    
}

// if it was not found in previous page
if ($found != 1)
{
        
    if($nextPage1 != "0")
    {
        // due to the nature of google api calls, you must sleep for a couple seconds before calling again
        sleep(2);
        $map_url_page1 = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+". $barZipCode ."&pagetoken=". $nextPage1 ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";

        $mapsearch_url_page1=simplexml_load_file($map_url_page1);
        foreach ($mapsearch_url_page1 ->result as $result1)
        {
            // if its in our database, list it
            if($result1->name == $barName)  
            { 
                $found = 1;
                $loaded = true;
                $placeID = $result1->place_id;        
                //$photo=$result1->photo;
                $photo_reference = $result1->photo[0]->photo_reference;
                $image= "https://maps.googleapis.com/maps/api/place/photo?maxwidth=550&maxheight=350&photoreference=". $photo_reference ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
                $detailsImage = isset($photo_reference) ? $details_result->website.'<image width="550" height="350" src="'. $image .'"</image>' : 
                    '
                    <div style="width:575px; height=:375px;">
                    <i style="font-size:360px;" class="fa fa-home fa-stack-2x text-primary"></i>
                    </div>
                    '; break;
            }
            
            $nextPage2 = isset($mapsearch_url_page1 -> next_page_token) ? $mapsearch_url_page1 -> next_page_token : "0" ;
        // echo $nextPage2;
        
        }
    }
}

// if it was not found in previous page
if ($found != 1)
{
    if($nextPage2 != "0")
    {
        sleep(2);
        $map_url_page2 = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+". $barZipCode ."&pagetoken=". $nextPage2 ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";

        $mapsearch_url_page2=simplexml_load_file($map_url_page2);
        foreach ($mapsearch_url_page2 ->result as $result)
        {
            // if its in our database, list it
            if($result->name == $barName)  
            { 
                $loaded = true;
                $placeID = $result->place_id;        
                //$photo=$result->photo;
                $photo_reference = $result->photo[0]->photo_reference;
                $image= "https://maps.googleapis.com/maps/api/place/photo?maxwidth=550&maxheight=350&photoreference=". $photo_reference ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
                $detailsImage = isset($photo_reference) ? $details_result->website.'<image width="550" height="350" src="'. $image .'"</image>' : 
                    '
                    <div style="width:575px; height=:375px;">
                    <i style="font-size:360px;" class="fa fa-home fa-stack-2x text-primary"></i>
                    </div>
                    '; break;
            }
            // shouldnt be another next page, 2 is max according to google api docs
        // $nextPage2 = isset($mapsearch_url -> next_page_token) ? $mapsearch_url -> next_page_token : "0" ;
        
        }
    }
}
// google places detail api
$map_details = "https://maps.googleapis.com/maps/api/place/details/xml?placeid=". $placeID ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";

$mapdetails_url=simplexml_load_file($map_details);
foreach ($mapdetails_url ->result as $details_result)
{
    // results to variable
    $detailsPhoneNumber = isset($details_result->formatted_phone_number) ? "<small>" . $details_result->formatted_phone_number . "</small><br/>" : "<br/>";
    $detailsAddress = isset($details_result->formatted_address) ? "<p>" .$details_result->formatted_address . "</p>" : "-<br/>";
    $detailsOperatingHoursMonday = isset($details_result->opening_hours->weekday_text[0]) ? "<h4> Operating Hours </h4>" . $details_result->opening_hours->weekday_text[0] . "</p>" : "<font style='font-style:italic;'>Hmm, not finding a whole lot of info.</font><br/>" ;
    $detailsOperatingHoursTuesday = isset($details_result->opening_hours->weekday_text[1]) ?  "<p>" . $details_result->opening_hours->weekday_text[1] . "</p>" : "<br/>" ;
    $detailsOperatingHoursWednesday = isset($details_result->opening_hours->weekday_text[2]) ? $details_result->opening_hours->weekday_text[2] . "</p>" : "<br/>" ;
    $detailsOperatingHoursThursday = isset($details_result->opening_hours->weekday_text[3]) ? "<p>" . $details_result->opening_hours->weekday_text[3] . "</p>" : "<br/>" ;
    $detailsOperatingHoursFriday = isset($details_result->opening_hours->weekday_text[4]) ? "<p>" . $details_result->opening_hours->weekday_text[4] . "</p>" : "<br/>" ;
    $detailsOperatingHoursSaturday = isset($details_result->opening_hours->weekday_text[5]) ? "<p>" . $details_result->opening_hours->weekday_text[5] . "</p>" : "<br/>";           
    $detailsOperatingHoursSunday = isset($details_result->opening_hours->weekday_text[6]) ? "<p>" . $details_result->opening_hours->weekday_text[6] . "</p>" : "<br/>" ;               
	$detailsWebsite = isset($details_result->website) ? '<br/><a href="'. $details_result->website .'">'. $details_result->website .'</a>': "<br/>" ;
    
}
mysqli_close($connection);    
?>