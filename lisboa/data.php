<?php 

include_once('class/makejson.php');
////transito

$file = isset($_GET['file'])&& !empty($_GET['file'])?$_GET['file']:'nofile';
if(isset($_GET['lat'])&&isset($_GET['lng'])){
$lat = $_GET['lat'];
$lng= $_GET['lng'];
    $feed = 'https://emel.city-platform.com/opendata/parking/places/?latitude='.$lat.'&longitude='.$lng;
}else{
    $feed = isset($_GET['service'])&& !empty($_GET["service"])?$_GET['service']:null;
}


$json = new composeJson($feed,$file);
echo $json->init();
