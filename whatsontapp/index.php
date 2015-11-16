
<?php
/*
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "brew_view";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";


if (!$link = mysql_connect($servername, $username, $password)) {
    echo 'Could not connect to mysql';
    exit;
}

if (!mysql_select_db($dbname, $link)) {
    echo 'Could not select database';
    exit;
}

LOAD DATA INFILE 'c:/xampp/htdocs/whatsontapp/TopAmericanPaleAle.csv' 
INTO TABLE dbtablebeer 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'

/*'INSERT INTO employee '.
      '(emp_name,emp_address, emp_salary, join_date) '.
      'VALUES ( "guest", "XYZ", 2000, NOW() )'; 

 $sql = "INSERT INTO `brew_view`.`dbtablebeer`".
		"(`ID`, `BeerID`, `BarID`, `Style`, `ABV`, `Price`, `Name`, `BreweryID`, `BreweryName`)".
		"VALUES (NULL, '5', '1', 'American Double / Imperial Stout', '8.3', NULL, 'Founders Breakfast Stout', NULL, 'Founders Brewing Company')";
	  
   mysql_select_db('dbname');
   $retval = mysql_query( $sql, $link );
   
   if(! $retval )
   {
      die('Could not enter data: ' . mysql_error());
   }
   
   echo "Entered data successfully\n";
   




$sql    = 'SELECT * FROM dbtablebeer WHERE barid = 1';
$result = mysql_query($sql, $link);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
?>
<br/>
<?php
while ($row = mysql_fetch_assoc($result)) {
    echo $row['Name'];
	?> <br/> <?php
}

mysql_free_result($result);


*/

$xml=simplexml_load_file("Bars.xml");
echo $xml->name . "<br>";
echo $xml->formatted_address . "<br>";
echo $xml->rating;


?>
