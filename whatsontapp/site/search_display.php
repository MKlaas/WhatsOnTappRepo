<?php 
session_start();
if(!isset($_SESSION['login_user'])){
   //redirect or other you want
   header("Location: account/login.php"); // Redirecting To Home Page
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Search Display</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</div>
</head>

<?php
error_reporting(E_ERROR | E_PARSE);

include('includes/navbar.php'); 
//include('account/profile.php'); 

$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['name'])) {
$error = "Please enter name or style";
echo  '   <p>You  may search name or type</p>
    <form  method="post" action="search_display.php?go"  id="searchform">
      <input  type="text" name="name">
      <input  type="submit" name="submit" value="Search Beers">
    </form>';

}


$name=$_POST['name'];

echo  '   <p>You  may search name or type</p>
    <form  method="post" action="search_display.php?go"  id="searchform">
      <input  type="text" name="name">
      <input  type="submit" name="submit" value="Search Beers">
    </form>';

// load api url into xml reader
$api_key = "6dab466c8f0979f11e35908c1b6671ff";
$brewerydb_api_url = "https://api.brewerydb.com/v2/search?type=beer&withBreweries=y&q=".$name."&p=1&key=".$api_key."&format=xml";


$api_url=simplexml_load_file($brewerydb_api_url);

echo " <br/> <br/> <p>Here are your search results for ".$name.". If these aren't the results you were expecting, check the spelling or spacing and try again </p> <br/> ";
  //-create  while loop and loop through result while generating html
  // check that results are coming in
  // declare to stop loop  
  $i = 0;
  foreach ($api_url-> data -> item as $brewerydb_results)
    {

        if ($i >= 100) break;    
        // xml tags into variable
        $brewerydb_id = isset($brewerydb_results -> id) ?  $brewerydb_results -> id  : "-"; 
        $brewerydb_name = isset($brewerydb_results -> name) ?  $brewerydb_results -> name  : "0"; 
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
        echo "<li>" . $brewerydb_icon . "  " ."<a href=\"beerpage.php?id=$brewerydb_id\">"   .$brewerydb_name . "</a> | " . $brewerydb_style . " | ".$brewerydb_abv." | " .$brewerydb_brewery. " | ".$brewerydb_website . "</li>\n";
        echo "</ul>";
        $i++;
       
    }
    

}
?>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <?php include('includes/footer.php'); ?>
                </div>
            </div>
        </footer>



