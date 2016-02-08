<?php

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("localhost","whatsont_mk","Hotsauce07","whatsont_brew_view");

// Check connection
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

    $barbeerdeletequery="DELETE FROM dbtablebarbeer
        WHERE Date < (CURDATE() - INTERVAL 180 DAY)";

    mysqli_query($connection, $barbeerdeletequery) or die('Could not remove barbeer information; ' . mysqli_error($connection));


    mysqli_close($connection); // Closing Connection
?>