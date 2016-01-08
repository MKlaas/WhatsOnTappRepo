<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps JavaScript API v3 Example: Places Autocomplete</title>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>

    <style>
      body {
        font-family: sans-serif;
        font-size: 14px;
      }
      #map_canvas {
        height: 400px;
        width: 600px;
        margin-top: 0.6em;
      }
    </style>

    <script>
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(39.1000, -84.5167),
          zoom: 13,
          types:['establishment'],
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'),
          mapOptions);

        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
          infowindow.close();
          var place = autocomplete.getPlace();
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
          }

          var image = new google.maps.MarkerImage(
              place.icon,
              new google.maps.Size(71, 71),
              new google.maps.Point(0, 0),
              new google.maps.Point(17, 34),
              new google.maps.Size(35, 35));
          marker.setIcon(image);
          marker.setPosition(place.geometry.location);

          var address = '';
          var zip_code = '';
          document.getElementById('zip_code').innerHTML=zip_code;
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
            for (var i=0; i<place.address_components.length;i++)
	    {
              for (var j=0;j<place.address_components[i].types.length;j++)
              {
                if (place.address_components[i].types[j] == "postal_code")
                {
                  zip_code = place.address_components[i].long_name;
                  document.getElementById('zip_code').value=zip_code;
                }
              }
	    }
          }

          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        /*
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          google.maps.event.addDomListener(radioButton, 'click', function() {
            autocomplete.setTypes(types);
          });
        }
*/
       // setupClickListener('changetype-all', []);
        //setupClickListener('changetype-establishment', ['establishment']);
        //setupClickListener('changetype-geocode', ['geocode']);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
  <form action="#" method="post">
    <p>
     <label for="searchTextField">Please insert an address:</label>
     <input id="searchTextField" name="searchTextField" type="text" size="100">
     <input id="zip_code" name="zip_code" type="text" size="12">
  
   </p>
   <p>
    <label for="beerTextField">Beer: </label>
    <input id="beerTextField" name="beerTextField" type = "text">
  </p>
  <!--
    <div>
      <input type="radio" name="type" id="changetype-all" checked="checked">
      <label for="changetype-all">All</label>

      <input type="radio" name="type" id="changetype-establishment">
      <label for="changetype-establishment">Establishments</label>

      <input type="radio" name="type" id="changetype-geocode">
      <label for="changetype-geocode">Geocodes</lable>
    </div>
-->

    <div id="map_canvas"></div> 
       <input type="submit" value="Add">

 </form>
 <form action="http://localhost/whatsontapprepo/whatsontapp/site/services.php">
  <input type="submit" value="Go Back">
</form>
  </body>
</html>