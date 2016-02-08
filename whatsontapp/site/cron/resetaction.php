<?php

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("localhost","whatsont_mk","Hotsauce07","whatsont_brew_view");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


        $sql_useractionreset = "UPDATE dbtableuser 
                        SET Action = 0";
        $retval_useractionreset = mysqli_query($connection ,$sql_useractionreset ) or die('Could not reset user information; ' . mysqli_error($connection));

    mysqli_close($connection); // Closing Connection
?>