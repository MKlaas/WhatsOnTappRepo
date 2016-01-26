<?php 
session_start();
if(!isset($_SESSION['login_user'])){
   //redirect or other you want
   header("Location: account/login.php"); // Redirecting To Home Page
}
?>

<!DOCTYPE html>
<html lang="en">

<head>


</head>

<body>
     <?php include('core/init_update.php'); ?>
     
</body>

</html>