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