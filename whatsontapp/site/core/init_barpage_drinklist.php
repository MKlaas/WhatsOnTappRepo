<?php

$connection = mysql_connect("localhost", "root", "admin");

// Selecting Database
$db = mysql_select_db("brew_view", $connection);

// SQL query to fetch information of beer types and finds matches.
//for the barbeer table
$barbeerquery="SELECT b.BeerID, b.Name,b.BreweryName, b.Style, b.ABV 
FROM dbtablebeer b, dbtablebarbeer c 
WHERE BarID= $barID 
AND b.BeerID=c.BeerID ";
$barbeerresult=mysql_query($barbeerquery);
$rows = mysql_num_rows($barbeerresult);

//$barName=array();
  //-create  while loop and loop through result set
  while($row=mysql_fetch_array($barbeerresult)){
          $beerID = $row['BeerID'];
          $beerName=$row['Name'];
          $breweryName=$row['BreweryName'];
          $beerStyle=$row['Style'];
          $beerABV=$row['ABV'];
        //  $beerPrice=$row['Price'];
         // $breweryID=$row['BreweryID'];
          echo "<ul style='list-style-type:none;'>";
          echo "<li><font color='#377BB5'><a  href=\"beerpage.php?id=$beerID\">"  .$beerName . " - " . $beerStyle . " - " . $beerABV . "</a></font></li>\n";
		  echo "</ul>";
  }

?>

