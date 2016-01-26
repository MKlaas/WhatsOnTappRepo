<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['form-username']) || empty($_POST['form-password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['form-username'];
$password=$_POST['form-password'];

// Connection
include(dirname(__DIR__).'../../core/init_connect.php');
$query = "select * from dbtableuser where Password=sha1('$password') AND UserName='$username'";
// SQL query to fetch information of registerd users and finds user match.
$ret_query = mysqli_query($connection, $query) or die('Could not look up user information. ' . mysqli_error($connection));;
$rows = mysqli_num_rows($ret_query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: ../index.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($connection); // Closing Connection
}
}

?>