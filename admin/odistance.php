<?php
// Haversine formula
function Haversine($start, $finish) {
	
	$theta = $start[1] - $finish[1]; 
	$distance = (sin(deg2rad($start[0])) * sin(deg2rad($finish[0]))) + (cos(deg2rad($start[0])) * cos(deg2rad($finish[0])) * cos(deg2rad($theta))); 
	$distance = acos($distance); 
	$distance = rad2deg($distance); 
	$distance = $distance * 60 * 1.1515; 
	
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
?>
<!doctype html>
<html>
<head>
<title>Getting the distance between two locations</title>
</head>
<body>

	<h1>Getting the distance between two locations</h1>

	<?php
	$x='delhi';
	$start = getLatLong($x);
	$finish = getLatLong('kanpur');
	
	$distance = Haversine($start, $finish);
	
	print('<p class="cb">The distance between <strong>'.$start[0].', '.$start[1].'</strong> and <strong>'.$finish[0].', '.$finish[1].'</strong> is '.$distance.' miles ('.($distance * 1.609344).' km).</p>');
	?>
	
</body>
</html>