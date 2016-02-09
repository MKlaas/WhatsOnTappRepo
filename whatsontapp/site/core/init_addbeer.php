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
         // always display search text field
        echo '<p> If these are not the beers you\'re looking for, try searching again. </p>
            <form  method="post" action="addbeer.php?go&id='.$barID.'"  id="searchform">
                <input  type="text" name="name">
                <input  type="submit" name="submit" value="Search Beers">
                </form>
                <br/>';
        }
         else
        {
            // this is the whatsontapp3 key a4fd41003198b446f6ee46d9ea309a21
            // the other key 6dab466c8f0979f11e35908c1b6671ff
        $name=$_POST['name'];
        
        // always display search text field
        echo '<p> If these are not the beers you\'re looking for, try searching again. </p>
                <form  method="post" action="addbeer.php?go&id='.$barID.'"  id="searchform">
                    <input  type="text" name="name">
                    <input  type="submit" name="submit" value="Search Beers">
                    </form>
                    <br/>';
        $api_key = "6dab466c8f0979f11e35908c1b6671ff";

        // brewerydb api
        $brewerydb_api_url = "https://api.brewerydb.com/v2/search?type=beer&withBreweries=y&q=".$name."&p=1&key=".$api_key."&format=xml";
        $api_url=simplexml_load_file($brewerydb_api_url);
       foreach ($api_url -> data -> item as $brewerydb_results)
            {

                if ($i >= 100) break;    
                // xml tags into variable
                $brewerydb_id = isset($brewerydb_results -> id) ?  $brewerydb_results -> id  : "-"; 
                $brewerydb_id_value = isset($brewerydb_results -> id) ? $brewerydb_results -> id : NULL; 
                $brewerydb_name = isset($brewerydb_results -> name) ?  $brewerydb_results -> name  : "0"; 
                $brewerydb_name_value = isset($brewerydb_results -> name) ? $brewerydb_results -> name : NULL; 
                $brewerydb_description = isset($brewerydb_results -> description) ?  $brewerydb_results -> description  : "-"; 
                $brewerydb_abv = isset($brewerydb_results -> abv) ?  $brewerydb_results -> abv . "%" : "-"; 
                $brewerydb_style = isset($brewerydb_results -> style -> shortName) ?  $brewerydb_results -> style -> shortName  : "-"; 
                $brewerydb_icon = isset($brewerydb_results -> labels -> icon) ? "<img src='". $brewerydb_results -> labels -> icon ."'/>" :'
                <span class="fa-stack fa-2x">
                    <i class="fa fa-beer fa-stack-2x text-primary"></i>
                </span>
                    ' ;
                $brewerydb_brewery = isset($brewerydb_results -> breweries -> item -> name) ?  $brewerydb_results -> breweries -> item -> name : "-";
                $brewerydb_website = isset($brewerydb_results -> breweries -> item -> website) ? "<a href=". $brewerydb_results -> breweries -> item -> website .">".$brewerydb_results -> breweries -> item -> website."</a>" : "-";
                
                echo "<ul style='list-style-type:none'>\n";
                echo "<li>" . $brewerydb_icon . "  " ."<a href=\"beerpage.php?id=$brewerydb_id\">"   .$brewerydb_name . "</a> | " . $brewerydb_style . " | ".$brewerydb_abv." | " .$brewerydb_brewery. " | ".$brewerydb_website . " <br/> ". 
                '<form action="addbeer.php?brid='.$barID.'&beid='.$brewerydb_id_value.'&ben='.$brewerydb_name_value.'" method="post">
                    <input type="submit" name="Add" value="Add" />
                </form>'."</li>\n";
                echo "</ul>";
                $i++;
            
            }
        }                
    }
 


    
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
    