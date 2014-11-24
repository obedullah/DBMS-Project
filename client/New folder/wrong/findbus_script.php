<?php	
	require 'findbus_functions.php';
	$source_cityErr = $destination_cityErr = $dateErr ='';
	$source_city = isset($_POST['source_city']) ? $_POST['source_city'] : '';
	$destination_city = isset($_POST['destination_city']) ? $_POST['destination_city'] : '';
	$date = isset($_POST['date']) ? $_POST['date'] : '';
	$required_routeid='';
	$day='';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		$error= validate_findbus_form();
		if( $error==0 )
		{	$database = "obtrs";
			$server = "localhost";
			$db_connection = mysql_connect($server);				
			if (!$db_connection) 
			{	die("Unable to connect to MySQL: " . mysql_error()); 
			}
			$db_found = mysql_select_db($database);
			if (!$db_found)
			{	die("Unable to connect to MySQL: " . mysql_error());
			}
			$query = "SELECT routeid FROM route WHERE source='" .$source_city."' AND destination= '" .$destination_city. "';";
			$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
			$row = mysql_fetch_row($result);
			$number_of_routes = mysql_num_rows($result);
			echo "<br>Source:" . $source_city;
			echo "<br>Destination:" . $destination_city;
			echo "<br>Date: ". $date;
			$date2= strtotime($date);
			$day = date("l", $date2);
			echo "day is:" .$day;
			if( $number_of_routes==0 )
			{	echo"<br>No route found. ";
			}
			else
			{	$required_routeid = $row[0];
				echo "<br>Route Id :". $required_routeid;
				$query = "SELECT busid FROM schedule WHERE routeid='" .$required_routeid."';";
				$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
				$number_of_buses = mysql_num_rows($result);
				if( $number_of_buses==0 )
				{	echo"<br>No bus found. ";
				}
				else
				{	echo "<br>Buses available are: <br>";
					while($row = mysql_fetch_array($result))
					{	$bus = $row["busid"];
						echo $bus ."\t";
					}
				}
				exit();
			}
		}
	}
?>