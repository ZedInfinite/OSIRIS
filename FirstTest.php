<?php
/*
Plugin Name: FirstTest
Plugin URI: http://osiris.online
Description: A first plugin for data table
Author: Long Zhang
Version: 1.0
Author URI: http://osiris.online
*/
?>

<?php
add_action('admin_menu', 'myfirstplugin_admin_actions');
function myfirstplugin_admin_actions() {
	add_options_page('MyFirstPlugin', 'MyFirstPlugin', 'manage_options', _FILE_, 'myfirstplugin_admin');
}
function myfirstplugin_admin()
{
  $apikey = "AIzaSyBWH9k3eULhoqVSDDKhlAF7Km5syiz-ZXw";
 
  $lat = -37.913928;
  $long = 145.131603;
  $zoom = 8;
  $description = "I am a flower"
  
?><!DOCTYPE html> 
<html>
  <head>
    <meta name="viewport"
        content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=
          <?php echo $apikey; ?>&sensor=false">
    </script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(<?php echo $lat.', '.$long; ?>),
          zoom: <?php echo $zoom; ?>
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);

      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"/>
  </body>
</html>
<?php
}
?>