<?php 

$beerID = $_GET['id'];
// get add value if posted run add beer function and redirect

            // this is the brewerydbkey
        $name=$_POST['name'];
        $api_key = "6dab466c8f0979f11e35908c1b6671ff";

        // brewerydb api
        $brewerydb_api_url = "http://api.brewerydb.com/v2/beers?ids=".$beerID."&withBreweries&key=".$api_key."&format=xml";

        $api_url=simplexml_load_file($brewerydb_api_url);
        $brewerydb_results = $api_url-> data -> item;

// xml values to variable
        $brewerydb_id = isset($brewerydb_results -> id) ? "<p>" . $brewerydb_results -> id . "</p>" : "- <br/>";; 
        $brewerydb_id_value = isset($brewerydb_results -> id) ? $brewerydb_results -> id : NULL; 
        $brewerydb_name = isset($brewerydb_results -> name) ? "<p>" . $brewerydb_results -> name . "</p>" : "0"; 
        $brewerydb_description = isset($brewerydb_results -> description) ? "<p>" . $brewerydb_results -> description . "</p>" : "<br/>-<br/>"; 
        $brewerydb_abv = isset($brewerydb_results -> abv) ? "<p>" . $brewerydb_results -> abv . "%</p>" : "-<br/>"; 
        $brewerydb_style = isset($brewerydb_results -> style -> shortName) ? "<p>" . $brewerydb_results -> style -> shortName . "</p>" : "-<br/>"; 
        $brewerydb_icon = isset($brewerydb_results -> labels -> icon) ? "<p><img src='". $brewerydb_results -> labels -> medium ."'/></p>" : "-<br/>";
      //  $brewerydb_brewery = isset($brewerydb_results -> breweries -> item -> name) ? "<p>". $brewerydb_results -> breweries -> item -> name ."</p>" : "-<br/>";
      //  $brewerydb_website = isset($brewerydb_results -> breweries -> item -> website) ? "<p><a href=". $brewerydb_results -> breweries -> item -> website .">".$brewerydb_results -> breweries -> item -> website."</a></p>" : "-<br/>";
// display the variables
        echo $brewerydb_name;
        echo $brewerydb_description;
        echo $brewerydb_abv;
        echo $brewerydb_style;
        echo $brewerydb_icon;
        echo $brewerydb_brewery;
        echo $brewerydb_website;
                
 
 // small error check. If no info is pulled from the xml the display this message
if($brewerydb_name == "0")
{
    echo 'Sorry We Couldn\'t Fetch Any Info ';
}


?>
    


