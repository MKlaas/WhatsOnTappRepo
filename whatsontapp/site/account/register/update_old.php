

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Records Form</title>
</head>
<body>
<form action="#" method="post">
    <p>
    	<label for="userName">Username</label>
        <input type="text" name="username" id="userName">
    </p>
	<p>
    	<label for="firstName">First Name:</label>
        <input type="text" name="firstname" id="firstName">
    </p>
    <p>
    	<label for="lastName">Last Name:</label>
        <input type="text" name="lastname" id="lastName">
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
    	<label for="emailAddress">Email Address:</label>
        <input type="text" name="email" id="emailAddress">
    </p>
	    <p>
    	<label for="password">Password</label>
        <input type="text" name="password" id="password">
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
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$email = $_POST['email'];
$password = $_POST['password'];
 
 $sql = "UPDATE dbtableuser 
		SET FirstName='$firstname', LastName='$lastname', City ='$city', State= '$state', ZipCode = '$zipcode', email='$email'
		WHERE UserName = '$username'";
	  
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
                          		 