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
$secQ = $_POST['secQ'];
$secA = $_POST['secA'];
$password = $_POST['password'];

 
 $sql = "INSERT INTO dbtableuser (`UserName`,`FirstName`,`LastName`,`City`,`State`,`ZipCode`,`Email`,`secQ`,`secA`,`Password`) 
		                  VALUES ('$username','$firstname', '$lastname', '$city', '$state', '$zipcode', '$email', '$secQ', '$secA', sha1('$password'))";
	  

   $retval = mysqli_query( $connection, $sql  ) or die('Could not look up user information; ' . mysqli_error($connection));;
   
   if(! $retval )
   {
      die('Something Went Wrong: ' . mysqli_error());
   }
   echo "<script>setTimeout(function(){window.location.href='../login.php'},2000);</script>";   
   echo "Thanks For Registering \n <br/> You Will Be Redirected, If Not Click <a href='../login.php'>Login</a>";
   
 
// Close connection
mysqli_close($connection);
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
$secQ = $_POST['secQ'];
$secA = $_POST['secA'];
$password = $_POST['password'];

 $sql = "UPDATE dbtableuser 
		SET FirstName='$firstname', LastName='$lastname', City ='$city', State= '$state', ZipCode = '$zipcode', email='$email', secQ='$secQ',secA='$secA',Password=sha1('$password')
		WHERE UserName = '$username'";

   $retval = mysqli_query( $connection,$sql  ) or die('Could not look up user information; ' . mysqli_error($connection));;
   
   if(! $retval )
   {
      die('Something Went Wrong: ' . mysqli_error());
   }
   
   echo "<script>setTimeout(function(){window.location.href='../../index.php'},2000);</script>";   
   echo "Update Successful, You May Go Back To The Main <a href='../../index.php'>Page</a> \n";
  mysqli_close($connection);
}

function UpdatePassword($username, $email)
{
    echo "HIT";
    include(dirname(__DIR__).'../../core/init_connect.php');
 

$password = $_POST['password'];
$sql = "UPDATE `dbtableuser` SET `Password`=sha1('$password') WHERE `UserName` = '$username' AND `Email` = '$email'";

   $retval = mysqli_query( $connection,$sql  ) or die('Could not update user information; ' . mysqli_error($connection));;
   
   if(! $retval )
   {
      die('Something Went Wrong: ' . mysqli_error());
   }
   
   echo "<script>setTimeout(function(){window.location.href='../../index.php'},2000);</script>";   
   echo "Update Successful, You May Go Back To The Main <a href='../../index.php'>Page</a> \n";
   mysqli_close($connection);
}
?>


                              		