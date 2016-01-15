<?php
include('session.php');

// Connection
include(dirname(__DIR__).'../../core/init_connect.php');


$result = mysql_query("SELECT ZipCode FROM dbtableuser WHERE username='$login_session'");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($result);

$zip = $row[0];


mysql_close($connection); // Closing Connection
?>