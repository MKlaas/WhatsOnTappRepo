<?php
$api_key = "6dab466c8f0979f11e35908c1b6671ff";
$name = "Kutztown Lager";
$brewerydb_api_url = "http://api.brewerydb.com/v2/search?type=beer&withBreweries=y&q=".$name."&p=1&key=".$api_key."&format=xml";

$api_url=simplexml_load_file($brewerydb_api_url);
$brewerydb_results = $api_url-> data -> item;

$brewerydb_id = isset($brewerydb_results -> id) ? "<p>" . $brewerydb_results -> id . "</p>" : "-<br/>"; 
$brewerydb_name = isset($brewerydb_results -> name) ? "<p>" . $brewerydb_results -> name . "</p>" : "-<br/>"; 
$brewerydb_description = isset($brewerydb_results -> description) ? "<p>" . $brewerydb_results -> description . "</p>" : "-<br/>"; 
$brewerydb_abv = isset($brewerydb_results -> abv) ? "<p>" . $brewerydb_results -> abv . "%</p>" : "-<br/>"; 
$brewerydb_style = isset($brewerydb_results -> style -> shortName) ? "<p>" . $brewerydb_results -> style -> shortName . "</p>" : "-<br/>"; 
$brewerydb_icon = isset($brewerydb_results -> labels -> icon) ? "<p><img src='". $brewerydb_results -> labels -> medium ."'/></p>" : "-<br/>";
$brewerydb_brewery = isset($brewerydb_results -> breweries -> item -> name) ? "<p>". $brewerydb_results -> breweries -> item -> name ."</p>" : "-<br/>";
$brewerydb_website = isset($brewerydb_results -> breweries -> item -> website) ? "<p><a href=". $brewerydb_results -> breweries -> item -> website ."</p>" : "-<br/>";

/*
echo $brewerydb_id;
echo $brewerydb_name;
echo $brewerydb_description;
echo $brewerydb_abv;
echo $brewerydb_style;
echo $brewerydb_icon;
echo $brewerydb_brewery;
echo $brewerydb_website;
*/

?>