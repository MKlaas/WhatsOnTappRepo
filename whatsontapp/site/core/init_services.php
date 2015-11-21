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
	

echo "<h4>Bars Within <strong> " . $address ." </strong></h4>";

 

$connection = mysql_connect("localhost", "root", "admin");


// Selecting Database
$db = mysql_select_db("brew_view", $connection);
// SQL query to fetch information of beer types and finds matches.

$sqlquery="SELECT Name FROM dbtablebar";
$sqlresult=mysql_query($sqlquery);
$rows = mysql_num_rows($sqlresult);

$barName=array();
  //-create  while loop and loop through result set
  while($row=mysql_fetch_array($sqlresult)){
          $barName[]=$row['Name'];
		  
  }
$divid = 1;
$map_url = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+". $address ."&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";
$xml=simplexml_load_file($map_url);
echo '<div class="row"> ';
foreach ($xml->result as $result)
{
	echo '<div id="'. $divid++ .'"  class="col-md-4 text-center" style="height:350px; width:350px;">
            <div class="thumbnail"> <i class="fa fa-beer fa-stack-1x fa-inverse"></i>
                  <span class="fa-stack fa-5x">
                              <i class="fa fa-beer fa-stack-2x text-primary"></i>
                              <i class="fa fa-beer fa-stack-1x fa-inverse"></i>
                        </span>
                  <div class="caption">';

	if(in_array($result->name, $barName))
	{
	   echo "<h4><a href=''>" . $result->name . "</a></h4>";
	}
	
	else 
	{
	echo "<div style='float:right; font-size:200%;'><a href='addbar.php'>+</a></div>";
    echo "<h4>" . $result->name . "</h4>";
	
	}
	
	echo "<small >" . $result->formatted_address . "</small> <br>";
	echo "<small> Rating:" . $result->rating . "</small><br>";
	echo "<small>Price Level:" . $result->price_level . "</small>";
	echo ' 		 </div>
			  </div>
		   </div> ';
}
echo '</div>';

mysql_close($connection); // Closing Connection
  ?>