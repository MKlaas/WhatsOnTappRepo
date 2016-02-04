<br/><br/>
 <?php
 function AddUser()
 {

// Connection     
include(dirname(__DIR__).'../../core/init_connect.php');

//db names into variable
$username = $_POST['username'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$email = $_POST['email'];
$secQ = $_POST['secQ'];
$secA = $_POST['secA'];
$password = $_POST['password'];

 
 $sql = "INSERT INTO dbtableuser (`UserName`,`City`,`State`,`ZipCode`,`Email`, `DateJoined`, `secQ`,`secA`,`Password`) 
		                  VALUES ('$username', '$city', '$state', '$zipcode', '$email', CURDATE(), '$secQ', sha1('$secA'), sha1('$password'))";
	  

   $retval = mysqli_query( $connection, $sql  ) or die('Could not insert user information; ' . mysqli_error($connection));;
   
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
 
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$email = $_POST['email'];
$secQ = $_POST['secQ'];
$secA = $_POST['secA'];
$password = $_POST['password'];

// Check for empty fields, if not empty add to the update statement
$MoreSQL='';
if($city && $state && $zipcode != "")
{
    $MoreSQL.='city = "'.$city.'",';
    $MoreSQL.='state = "'.$state.'",';
    $MoreSQL.='zipcode = "'.$zipcode.'"';
}
if($email != "")
{
    if($MoreSQL!='') $MoreSQL.=', ';
    $MoreSQL.='email = "'.$email.'"';
}
if($secQ && $secA != "")
{
    if($MoreSQL!='') $MoreSQL.=',';
    $MoreSQL.='secQ = "'.$secQ.'",';
    $MoreSQL.='secA = sha1("'.$secA.'")';
}
if($password != "")
{
    if($MoreSQL!='') $MoreSQL.=', ';
    $MoreSQL.='password = sha1("'.$password.'")';
}
if($MoreSQL!="") {
    
    $sql='UPDATE dbtableuser
         SET '.$MoreSQL.' 
         WHERE UserName = "chilipepper"';
   $retval = mysqli_query( $connection,$sql  ) or die('Could not update user information; ' . mysqli_error($connection));;
}else{
    echo 'nothing updated';
}
/*
 $sql = "UPDATE dbtableuser
		SET City ='$city', State= '$state', ZipCode = '$zipcode', email='$email', secQ='$secQ',secA=sha1('$secA'),Password=sha1('$password')
		WHERE UserName = '$username'";

   $retval = mysqli_query( $connection,$sql  ) or die('Could not look up user information; ' . mysqli_error($connection));;
*/   
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


                              		