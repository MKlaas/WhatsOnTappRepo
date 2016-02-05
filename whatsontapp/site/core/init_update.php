<?php

updateBeer();
function updateBeer()
{
    include(dirname(__DIR__).'/account/core/init_profile.php'); 
    // connect
    include(dirname(__DIR__).'/core/init_connect.php');
    // get beer and bar id from url
    $beerID = $_GET["beid"];
    $barID = $_GET["brid"];
    $sql_action="SELECT Action FROM dbtableuser WHERE AccountID = $accountID";
    $sql_action_result = mysqli_query( $connection,$sql_action) or die('Could not get action information; ' . mysqli_error($connection));

    //-create  while loop and loop through result set
    while($row=mysqli_fetch_array($sql_action_result))
    {
            $action=$row['Action'];
    }
    if ($action >= 5)
    {
         echo "<script>setTimeout(function(){window.location.href='barpage.php?id=".$barID."'},2000);</script>";
         echo "Sorry, You've hit your daily quota for adding and updating the bar info, check back in 24 hours!";
    } 
    else 
    {
        // set up query variable 
        $sql_barbeer_update = "UPDATE dbtablebarbeer
                            SET Date = CONCAT(CURDATE(), ' ' , TIME(Date)), AccountID = $accountID
                            WHERE beerID = '$beerID' AND barID = $barID ";

        $sql_useraction = "UPDATE dbtableuser 
                        SET Action = Action + 1 
                        WHERE AccountID = $accountID";
        $retval_barbeer_update = mysqli_query( $connection,$sql_barbeer_update ) or die('Could not update barbeer information; ' . mysqli_error($connection));;
        $retval_useraction = mysqli_query($connection ,$sql_useraction ) or die('Could not insert user information; ' . mysqli_error($connection));

            // redirect back to bar
        echo  "<script>setTimeout(function(){window.location.href='barpage.php?id=".$barID."'},2000);</script>";
        echo "<p>Thanks, for letting us know, we'll update the bar now!</p>";
        echo "<p>If you get lost go <a href = 'barpage.php?id=".$barID."'>here</a>.</p>";

       
    }
     mysqli_close($connection);
}


?>