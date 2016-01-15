<?php

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "admin");


// Selecting Database
$db = mysql_select_db("brew_view", $connection);

?>