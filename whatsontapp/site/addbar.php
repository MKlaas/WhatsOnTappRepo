<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Bar</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
  $(function() {
    $( "#beerTextField" ).autocomplete({
        source: 'search.php'
    });
});
  </script>
<?php include('google_autocomplete.php'); ?>

   <!--
   <p>
     <label for="priceTextField">What price was the beer?</label> <br/>
     <input id="priceTextField" name="priceTextField" type="text" size="50">
   </p>
   <p>
     <label for="styleTextField">What style was it?</label> <br/>
     <input id="styleTextField" name="styleTextField" type="text" size="50">
   </p>
   <p>
     <label for="abvTextField">What abv was it?</label> <br/>
     <input id="abvTextField" name="abvTextField" type="text" size="50">
   </p>
   <p>
     <label for="breweryTextField">Do you know the brewery?</label> <br/>
     <input id="breweryTextField" name="breweryTextField" type="text" size="50">
   </p>
-->   
 
<?php
include('core/init_addbar.php');
?>


