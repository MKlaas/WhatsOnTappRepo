<?php
// Connection
include(dirname(__DIR__).'../../core/init_connect.php');

session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($connection, "select username from dbtableuser where username='$user_check'") or die('Could not look up user information; ' . mysqli_error($connection));;
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['username'];
if(!isset($login_session)){
mysqli_close($connection); // Closing Connection
}
?>