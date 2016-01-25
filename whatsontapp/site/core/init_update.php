<?php
updateBeer();
function updateBeer()
{
    // connect
    include(dirname(__DIR__).'/core/init_connect.php');
    // get beer and bar id from url

    $beerID = $_GET["beid"];
    $barID = $_GET["brid"];
    // set up query variable 
    $sql_barbeer_update = "UPDATE dbtablebarbeer
                        SET Date = CONCAT(CURDATE(), ' ' , TIME(Date))
                        WHERE beerID = '$beerID' AND barID = $barID ";
    
    // do query
    
    // redirect back to bar
$retval_barbeer_update = mysql_query( $sql_barbeer_update, $connection );


if(! $retval_barbeer_update )
{
  die('Could not enter barbeer data: ' . mysql_error());  
}
echo  "<script>setTimeout(function(){window.location.href='/whatsontapprepo/whatsontapp/site/barpage.php?id=".$barID."'},3000);</script>";
echo "<p>Thanks, for letting us know, we'll update the bar now!</p>";
echo "<p>If you get lost go <a href = '/whatsontapprepo/whatsontapp/site/barpage.php?id=".$barID."'>here</a>.</p>";

mysql_close($connection);
}


?>