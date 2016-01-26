<?php
include('session.php');

// Connection
include(dirname(__DIR__).'../../core/init_connect.php');


$result = mysqli_query($connection, "SELECT ZipCode FROM dbtableuser WHERE username='$login_session'") or die('Could not look up zip code; ' . mysqli_error($connection));;;
$row = mysqli_fetch_row($result);

$zip = $row[0];

mysqli_close($connection); // Closing Connection
?>