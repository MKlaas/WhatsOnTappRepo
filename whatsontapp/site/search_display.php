
<?php
include('navbar.php'); 
include('login\profile.php'); 
?>
<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['name'])) {
$error = "Please enter name or style";
}
else
{

$name=$_POST['name'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "admin");


// Selecting Database
$db = mysql_select_db("brew_view", $connection);
// SQL query to fetch information of beer types and finds matches.
$query="SELECT BeerID, Name, Style FROM dbtablebeer WHERE Name LIKE '%" . $name .  "%' OR Style LIKE '%" . $name ."%'";
$rows = mysql_num_rows($query);

  //-run  the query against the mysql query function
  $result=mysql_query($query);
  //-create  while loop and loop through result set
  while($row=mysql_fetch_array($result)){
          $Name  =$row['Name'];
          $Style=$row['Style'];
          $BeerID=$row['BeerID'];
  //-display the result of the array
  echo "<ul>\n";
  echo "<li>" . "<a  href=\"search.php?id=$BeerID\">"   .$Name . " " . $Style .  "</a></li>\n";
  echo "</ul>";
  }
  }
  }
  mysql_close($connection); // Closing Connection
  
?>