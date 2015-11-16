<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Bar Form</title>
</head>
<body>
<form action="#" method="post">
    <p>
    	<label for="name">Name</label>
        <input type="text" name="name" id="name">
    </p>
	<p>
    	<label for="address">Address</label>
        <input type="text" name="address" id="address">
    </p>
	    <p>
    	<label for="city">City:</label>
        <input type="text" name="city" id="city">
    </p>
	    <p>
    	<label for="state">State:</label>
        <input type="text" name="state" id="state">
    </p>
	    <p>
    	<label for="zipcode">Zip Code:</label>
        <input type="text" name="zipcode" id="zipcode">
    </p>
    <p>
    	<label for="phoneNumber">Phone Number</label>
        <input type="text" name="phoneNumber" id="phoneNumber">
    </p>
    <input type="submit" value="Add Records">
</form>
</body>
</html>  
<?php
$servername = "localhost";
$dbrootname = "root";
$dbpassword = "admin";
$dbname = "brew_view";

// Create connection
$conn = new mysqli($servername, $dbrootname, $dbpassword);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully"; 


if (!$link = mysql_connect($servername, $dbrootname, $dbpassword)) {
    echo 'Could not connect to mysql';
    exit;
}
 
if (!mysql_select_db($dbname, $link)) {
    echo 'Could not select database';
    exit;
}
 

 ?>
 <br/>
 <?php
$name = $_POST['name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$phoneNumber = $_POST['phoneNumber'];
 
 $sql = "INSERT INTO dbtablebar (name, address, city, state, zipcode, phoneNumber) 
		VALUES ('$name','$address', '$city', '$state', '$zipcode', '$phoneNumber')";
	  
   mysql_select_db('dbname');
   $retval = mysql_query( $sql, $link );
   
   if(! $retval )
   {
      die('Could not enter data: ' . mysql_error());
   }
   
   echo "Entered data successfully\n";
   
 
// Close connection
mysqli_close($link);

?>


                              		