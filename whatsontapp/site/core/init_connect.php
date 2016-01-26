<?php

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("localhost","root","admin","brew_view");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }



?>