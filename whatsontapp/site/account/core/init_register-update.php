<br/><br/>
 <?php
 function AddUser()
 {
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
//echo "Connected successfully"; 


if (!$link = mysql_connect($servername, $dbrootname, $dbpassword)) {
    echo 'Could not connect to mysql';
    exit;
}
 
if (!mysql_select_db($dbname, $link)) {
    echo 'Could not select database';
    exit;
}
 
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$email = $_POST['email'];
$password = $_POST['password'];
 
 $sql = "INSERT INTO dbtableuser (username, firstname, lastname, city, state, zipcode, email, password) 
		VALUES ('$username','$firstname', '$lastname', '$city', '$state', '$zipcode', '$email','$password')";
	  
   mysql_select_db('dbname');
   $retval = mysql_query( $sql, $link );
   
   if(! $retval )
   {
      die('Something Went Wrong: ' . mysql_error());
   }
   
   echo "Thanks For Registering \n <br/> You may now <a href='http://localhost/whatsontapprepo/whatsontapp/site/account/login.php'>Login</a>";
   
 
// Close connection
mysql_close();
 }
function UpdateUser()
{
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
//echo "Connected successfully"; 


if (!$link = mysql_connect($servername, $dbrootname, $dbpassword)) {
    echo 'Could not connect to mysql';
    exit;
}
 
if (!mysql_select_db($dbname, $link)) {
    echo 'Could not select database';
    exit;
}
 
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
      die('Something Went Wrong: ' . mysql_error());
   }
   
   echo "Update Successful \n";
   
 
// Close connection
mysql_close();

}
?>


                              		