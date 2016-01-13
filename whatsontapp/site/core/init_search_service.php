<?php
error_reporting(E_ERROR | E_PARSE);
include('account\core\init_profile.php'); 
$address = $zip;
if ($_POST['address_submit_button']) {

    $address = $_POST['address'];

}

echo '<iframe 
	  width="700"
	  height="450"
	  frameborder="0" style="border:0"
	  src="https://www.google.com/maps/embed/v1/search?key=AIzaSyAsQreVM5VjCc_yXcMWPVJx3zeqWHyhOsc
		&q=bars+near+'.$address.'" allowfullscreen>
	</iframe>';
 

$beerID = $_GET['id'];
echo "<br/> Bars Near <strong> " . $address ." </strong> <br/> With The Beer Name ";

$connection = mysql_connect("localhost", "root", "admin");


// Selecting Database
$db = mysql_select_db("brew_view", $connection);

$sqlquery="SELECT a.name,a.address,a.city,a.zipcode
FROM dbtablebar a, dbtablebarbeer b 
WHERE a.BarID=b.BarID 
AND b.BeerID = '$beerID'";

$sqlresult=mysql_query($sqlquery);
$rows = mysql_num_rows($sqlresult);

$barName=array();
  //-create  while loop and loop through result set
  while($row=mysql_fetch_array($sqlresult)){
	  // select the index from a.name,
          $barName[]=$row[0];
          $beername = $row[4];
  }
  echo "<strong>" . $beername . "</strong>";
$divid = 1;
$map_url = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+". $address ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
$xml=simplexml_load_file($map_url);

echo '<div class="row"> ';

foreach ($xml ->result as $result)
{
    if(in_array($result->name, $barName))
	{
        $barNameValue = mysql_real_escape_string($result->name);
        $barIDQuery="SELECT BarID 
            FROM dbtablebar
            WHERE Name= '$barNameValue'";
        $barIDResult=mysql_query($barIDQuery);
        $barIDRows = mysql_num_rows($barIDResult);
        
        while($row=mysql_fetch_array($barIDResult)){
       //$barName=$row['Name','BarID'];
          $barIDValue=$row['BarID'];
        }
        
	$photo=$result->photo;
	$photo_reference = $result->photo->photo_reference;
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

mysql_close($connection); // Closing Connection
  ?>