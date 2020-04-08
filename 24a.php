<?php
 $db = mysqli_connect('localhost','root','isdr@430','GPSDB')
 or die('Error connecting to MySQL server.');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>
    <div id="map"></div>

      <?php
//Step2
$query = "SELECT * FROM  gps order by sno desc limit 1 ";
mysqli_query($db, $query) or die('Error querying database.');

//Step3
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

echo $row['datetime'] . ' ' . $row['latitude'] . ': ' . $row['longitude'] . ' '  .'<br />';

?>

    <script>
      var map;
      function initMap(){
          var myLatlng = {lat: <?php echo $row['latitude']?>, lng: <?php echo $row['longitude']?>};
          console.log(myLatlng);
          map = new google.maps.Map(document.getElementById('map'), {
          center: {lat:  <?php echo $row['latitude']?>, lng: <?php echo $row['longitude']?> },
          zoom: 20
        });
           var marker = new google.maps.Marker({
           position: myLatlng,
           map: map,
           title: 'Click to zoom'
         });
      }
    </script>
           <?php
// mysqli_close($db);
?>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_4DEH5XzKKS36yrosKOJGHqewoTTvrmQ&callback=initMap"
    async defer></script>
   <script language ="javascript">
    setTimeout(function(){
    window.location.reload(1);
    },10000);
   </script>
  </body>
</html>
