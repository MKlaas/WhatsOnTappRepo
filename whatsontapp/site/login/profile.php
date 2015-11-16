<?php
include('session.php');
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "brew_view";
$user_check=$_SESSION['login_user'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 


$result = mysql_query("SELECT ZipCode FROM dbtableuser WHERE username='$login_session'");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($result);

$zip = $row[0];


$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<title>Your Home Page</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b> <br/>

<b>Go to index </b><a href="../index.php">Go To Main Page</a> <br/>

<b id="update"><a href="update.php">Update Info</a></b><br/>
<b id="logout"><a href="login/logout.php">Log Out</a></b>


</div>
</body>
</html>