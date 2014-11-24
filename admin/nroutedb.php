<?php
require 'login.php';
// Haversine formula
function Haversine($start, $finish) {
	
	$theta = $start[1] - $finish[1]; 
	$distance = (sin(deg2rad($start[0])) * sin(deg2rad($finish[0]))) + (cos(deg2rad($start[0])) * cos(deg2rad($finish[0])) * cos(deg2rad($theta))); 
	$distance = acos($distance); 
	$distance = rad2deg($distance); 
	$distance = $distance * 60 * 1.1515 * 1.6; 
	
	return round($distance, 2);

}

// Get lat/long co-ords
function getLatLong($address) {
		
	$address = str_replace(' ', '+', $address);
	$url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$geoloc = curl_exec($ch);
	
	$json = json_decode($geoloc);
	return array($json->results[0]->geometry->location->lat, $json->results[0]->geometry->location->lng);
	
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");    

$source=$_POST['source'];
$destination=$_POST['destination'];
$start = getLatLong($source);
	$finish = getLatLong($destination);
	
	$distance = Haversine($start, $finish);

$query = "insert into route(source,destination,distance) values('$source','$destination',$distance)";
$result=mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());  

echo "New Route Added" ;

mysqli_close($con);
}
?>
