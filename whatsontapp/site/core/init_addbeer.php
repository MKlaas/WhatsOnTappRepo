 <?php
 $barID = $_GET['id'];
// get add value if posted run add beer function and redirect
 if(isset($_POST['Add']))
{
    $barID = $_GET['brid'];
    addBeer();
    echo "<script>setTimeout(function(){window.location.href='barpage.php?id=".$barID."'},2000);</script>";
    echo "</head>";
    
}
else
{
    echo "</head>";
    if (isset($_POST['submit'])) 
    {
        if (empty($_POST['name'])) 
        {
         $error = "Please enter name or style";
        }
         else
        {
            // this is the whatsontapp3 key a4fd41003198b446f6ee46d9ea309a21
            // the other key 6dab466c8f0979f11e35908c1b6671ff
        $name=$_POST['name'];
        $api_key = "a4fd41003198b446f6ee46d9ea309a21";

        // brewerydb api
        $brewerydb_api_url = "https://api.brewerydb.com/v2/search?type=beer&withBreweries=y&q=".$name."&p=1&key=".$api_key."&format=xml";

        $api_url=simplexml_load_file($brewerydb_api_url);
        $brewerydb_results = $api_url-> data -> item;

// xml values to variable
        $brewerydb_id = isset($brewerydb_results -> id) ? "<p>" . $brewerydb_results -> id . "</p>" : " <br/>";; 
        $brewerydb_id_value = isset($brewerydb_results -> id) ? $brewerydb_results -> id : NULL; 
        $brewerydb_name = isset($brewerydb_results -> name) ? "<p>" . $brewerydb_results -> name . "</p>" : "0"; 
        $brewerydb_name_value = isset($brewerydb_results -> name) ? $brewerydb_results -> name : NULL; 
        $brewerydb_description = isset($brewerydb_results -> description) ? "<p>" . $brewerydb_results -> description . "</p>" : "<br/>"; 
        $brewerydb_abv = isset($brewerydb_results -> abv) ? "<p>" . $brewerydb_results -> abv . "%</p>" : "<br/>"; 
        $brewerydb_style = isset($brewerydb_results -> style -> shortName) ? "<p>" . $brewerydb_results -> style -> shortName . "</p>" : "<br/>"; 
        $brewerydb_icon = isset($brewerydb_results -> labels -> icon) ? "<p><img src='". $brewerydb_results -> labels -> medium ."'/></p>" : "<br/>";
        $brewerydb_brewery = isset($brewerydb_results -> breweries -> item -> name) ? "<p>". $brewerydb_results -> breweries -> item -> name ."</p>" : "<br/>";
        $brewerydb_website = isset($brewerydb_results -> breweries -> item -> website) ? "<p><a href=". $brewerydb_results -> breweries -> item -> website .">".$brewerydb_results -> breweries -> item -> website."</a></p>" : "<br/>";
// display the variables
        echo $brewerydb_name;
        echo $brewerydb_description;
        echo $brewerydb_abv;
        echo $brewerydb_style;
        echo $brewerydb_icon;
        echo $brewerydb_brewery;
        echo $brewerydb_website;
        }                
    }
 
 // small error check. If no info is pulled from the xml the display this message
if($brewerydb_name == "0")
{
    echo 'Sorry We Couldn\'t Fetch Any Info ';
}
else
{ 
 // succesfully got info, generate it   
echo '<form action="addbeer.php?brid='.$barID.'&beid='.$brewerydb_id_value.'&ben='.$brewerydb_name_value.'" method="post">
<p>Is this the beer? Go ahead and add it!</p>
    <input type="submit" name="Add" value="Add" />
</form>
' ;
}
// always display search text field
echo '<p> If this isn\'t the beer you\'re looking for, try searching again. </p>
        <form  method="post" action="addbeer.php?go&id='.$barID.'"  id="searchform">
            <p>See a new beer at the bar? Search for and add it here!</p>
            <input  type="text" name="name">
            <input  type="submit" name="submit" value="Search Beers">
            </form>
            <br/>';
    
}

function addBeer()
{

    include(dirname(__DIR__).'/account/core/init_profile.php'); 
        // Connection
    include(dirname(__DIR__).'/core/init_connect.php');

    // grabbing url variables for query insert
    $barID = $_GET['brid'];
    $brewerydb_id_value = $_GET['beid'];
    $brewerydb_name_value = $_GET['ben'];
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

        $sql_barbeer = "INSERT INTO dbtablebarbeer (BeerName,BeerID, BarID, AccountID, Date) 
        VALUES ('$brewerydb_name_value','$brewerydb_id_value', '$barID', '$accountID' ,CURDATE())";
        $retval_barbeer = mysqli_query($connection ,$sql_barbeer ) or die('Could not insert bar beer information; ' . mysqli_error($connection));
        $sql_useraction = "UPDATE dbtableuser 
                            SET Action = Action + 1
                            WHERE AccountID = $accountID";
        $retval_useraction = mysqli_query($connection ,$sql_useraction ) or die('Could not insert user information; ' . mysqli_error($connection));
        if(! $retval_barbeer && ! $retval_useraction)
        {
            die('Could not enter data: ' . mysqli_error());
        } 
        else
        {
            echo "Thanks for the heads up! you'll be back at the bar in just a few seconds.... <br/><br/> If not take the following link back to the <a href='barpage.php?id=".$barID."'>bar</a>";
        }
    }
    mysqli_close($connection);
    
   }
?>
    