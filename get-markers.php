<?php
require 'connection.php';

$query = "SELECT * FROM markers";

if ($result = $mysqli->query($query)) {
    while($marker = $result->fetch_assoc()){
        $markers[]= [
            "id"=> $marker['id'],
            "name"=> $marker['name'],
            "lat"=>(float) $marker['lat'],
            "lng"=>(float) $marker['lng'],
            "description"=> $marker['description']
        ];
    }
    $result->close();
}

echo json_encode($markers);