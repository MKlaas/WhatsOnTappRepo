<?php

$connection = mysql_connect("localhost", "root", "admin");


// Selecting Database
$db = mysql_select_db("brew_view", $connection);
// SQL query to fetch information of beer types and finds matches.
$sqlquery="SELECT Name FROM dbtablebar";
$rows = mysql_num_rows($sqlquery);
$Name=array();
  //-run  the query against the mysql query function
  $sqlresult=mysql_query($sqlquery);
  //-create  while loop and loop through result set
  while($row=mysql_fetch_array($sqlresult)){

          $Name[]=$row['Name'];
  //-display the result of the array
  //echo "<ul>\n";
  //echo "<li>" . "<a  href=''>"   .$Name .   "</a></li>\n";
  //echo "</ul>";
  }

  	if(in_array("Cincinnati's Good Fellows", $Name))
	{
	   echo "true";
	}
  mysql_close($connection); // Closing Connection
  


/*
$map_url = "https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+Cincinnati&key=AIzaSyCDAZ5pbAv6PUHU1k-_IoGHow-JQVrRBDw";

 $response_xml_data = file_get_contents($map_url);
 if($response_xml_data){
     echo "read";
 }

 $data = simplexml_load_string($response_xml_data);
 echo "<pre>"; print_r($data); exit; 
 
$xml=simplexml_load_file($map_url);

foreach ($xml->result as $result)
{
	echo '<div class="row">
			 <div class="thumbnail">
				 <div class="caption">';
    echo "<h3>" . $result->name . "</h3><br>";
	echo "<small>" . $result->formatted_address . "</small> <br>";
	echo "<small>" . $result->rating . "</small><br>";
	echo "<small>" . $result->price_level . "</small><br><p>------</p>";
	echo ' 		 </div>
			  </div>
		   </div>';
	
}

  ?>
  <?php
include('navbar.php'); 
?>
  <div class="row">
            <div class="col-md-4 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
                    <div class="caption">
                        <h3>John Smith<br>
                            <small>Job Title</small>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste saepe et quisquam nesciunt maxime.</p>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
		*/