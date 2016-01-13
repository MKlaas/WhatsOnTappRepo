<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add Bar</title>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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

    
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
      <?php include('core/init_addbar.php'); ?>
  </body>
</html>