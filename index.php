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
 
        input, textarea, lable {
            font-family: Arial, Helvetica, sans-serif;
            margin: 3px;
            margin-bottom: 10px;
        
        }
      
        button, input, textarea {
            border-radius: 4px;
        }

    </style>
</head>
<body>
<form action="save-form.php" method="post">
  <lable>Marker name:</lable><br>
    <input name="name" placeholder="Name"><br>
    <lable>Latitude of marker:</lable><br>
    <input name="latitude" id="lat" placeholder="Latitude"><br>
    <lable>Longitude of marker:</lable><br>
    <input name="longitude" id="lng" placeholder="Longitude"><br>
    <lable>Marker description:</lable><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <button name="action" value="save">Save</button>
</form>
<div id="map"></div>
<script>
    var map;

    function createMarker(data) {

        console.log(data);

        var content = '<form action="edit-marker.php" method="post">' +
            '<p>Name: </p>' +
            '<input type="text" id="name" name="name" value=' + data.name +'><br>' +
            '<p>Description: </p>' +
            '<input type="text" id="description" name="description" value=' + data.description +'><br>' +
            '<p>Latitude: </p>' +
            '<input type="text" id="latitude" name="latitude" value=' + data.lat +'><br>' +
            '<p>Longitude: </p>' +
            '<input type="text" id="longitude" name="longitude" value=' + data.lng +'><br>' +
            '<br>' +
            '<input type="hidden" name="id" value=' + data.id + '/>' +
            '<input type="submit" name="update" value="update" >' +
            '<input type="submit" name="delete" value="delete" >' +
            '</form>';


        var infowindow = new google.maps.InfoWindow({
            content: content
        });

        var marker = new google.maps.Marker({
            position: data,
            map: map,
            title: 'Test3232'
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
            map.setCenter(marker.getPosition());
        });
    }

    function initMap() {

        fetch('get-markers.php')
            .then(function(response){
                return response.json();
            })
            .then(function(data) {
                for (k in data) {
                    console.log(data[k]);
                    createMarker(data[k]);
                }
            })
            .catch(function(err) {
                console.log('Fetch Error :-S', err);
            });

        var start = {lat: 58.232693, lng: 22.503854};

        map = new google.maps.Map(document.getElementById('map'), {
            center: start,
            zoom: 8
        });

        map.addListener('click', function(e) {

            console.log(e.latLng.lat())
            console.log(e.latLng.lng())

            var location = {lat: e.latLng.lat(), lng: e.latLng.lng()}
            createMarker(location);
            document.getElementById('lat').value = e.latLng.lat();
            document.getElementById('lng').value = e.latLng.lng();
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
        async defer></script>
</body>
</html>