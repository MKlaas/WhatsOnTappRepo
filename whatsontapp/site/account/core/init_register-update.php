<br/><br/>
 <?php
 function AddUser()
 {

// Connection     
include(dirname(__DIR__).'../../core/init_connect.php');

//db names into variable
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$email = $_POST['email'];
$password = $_POST['password'];
 
 $sql = "INSERT INTO dbtableuser (username, firstname, lastname, city, state, zipcode, email, password) 
		VALUES ('$username','$firstname', '$lastname', '$city', '$state', '$zipcode', '$email',sha1('$password'))";
	  
   $retval = mysql_query( $sql, $connection );
   
   if(! $retval )
   {
      die('Something Went Wrong: ' . mysql_error());
   }
   
   echo "Thanks For Registering \n <br/> You may now <a href='/whatsontapprepo/whatsontapp/site/account/login.php'>Login</a>";
   
 
// Close connection
mysql_close($connection);
 }
function UpdateUser()
{
include(dirname(__DIR__).'../../core/init_connect.php');
 
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

   $retval = mysql_query( $sql, $connection );
   
   if(! $retval )
   {
      die('Something Went Wrong: ' . mysql_error());
   }
   
   echo "Update Successful \n";
   

}
?>


                              		