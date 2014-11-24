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
			echo "<br><b>Details:</b>";
			echo "<br><b>Source:</b>" . $source_city;
			echo "<br><b>Destination:</b>" . $destination_city;
			echo "<br><b>Date: </b>". $date;
			$timestamp= strtotime($date);
			$day = date("l", $timestamp);
			echo "<br><b>Day:</b>" .$day;
			if( $number_of_routes==0 )
			{	echo"<br>No route found. ";
				//echo "<br><a href='2findbus.php'>back</a>";
				echo "<br><a href='css_findbus.php'>back</a>";
			}
			else
			{	$required_routeid = $row[0];
				echo "<br><b>Route Id :</b>". $required_routeid;
				$query = "SELECT busid FROM schedule WHERE routeid=". $required_routeid. " and ". $day ."=1;";
				$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
				$number_of_buses = mysql_num_rows($result);
				if( $number_of_buses==0 )
				{	echo"<br>No bus found. ";
					//echo "<br><a href='2findbus.php'>back</a>";
					echo "<br><a href='css_findbus.php'>back</a>";
				}
				else
				{	echo "<p><b>SCHEDULE OF BUSES AVAILABLE:". $date. " </b><br>";
					echo "<table border='1'>
						 <tr><th>Routeid</th>
							 <th>Busid</th>
							 <th>Departure time</th>
							 <th>Arrival time</th>
							 <th>Departure Day</th>
							 <th>Bus Type</th>
							 <th>Book Seat</th>
						</tr>";
					while($row = mysql_fetch_array($result))
					{	$bus = $row["busid"];
						$schedule_query = "SELECT * FROM schedule WHERE busid=". $bus. ";";
						$schedule_result = mysql_query($schedule_query, $db_connection) or die("query error". mysql_error());
						$schedule_row = mysql_fetch_row($schedule_result);
						echo "<tr>";
						echo "<td>" . $schedule_row[0] . "</td>";
						echo "<td>" . $schedule_row[1] . "</td>";
						echo "<td>" . $schedule_row[2] . "</td>";
						echo "<td>" . $schedule_row[3] . "</td>";
						echo "<td>" . $day . "</td>";
						$_SESSION['routeid'] = $required_routeid;
						$_SESSION['date']=$date;
						$_SESSION['day']= $day;
						$bus_query = "SELECT bustype FROM bus WHERE busid=". $bus. ";";
						$bus_result = mysql_query($bus_query, $db_connection) or die("query error". mysql_error());
						$bus_row = mysql_fetch_row($bus_result);
						echo "<td>" . $bus_row[0] . "</td>";
						//echo '<form method="post" action="2_1.php">';
						//echo '<form method="post" action="book2.php">';
						//echo '<form method="post" action="bookticket1.php">';
						echo '<form method="post" action="css_bookticket1.php">';
							echo'<input type="hidden" name="busid" value='.$bus.'>';
							echo'<td><input type="submit" name="book" value="book" /></td>';
							echo"</tr>";
						echo'</form>';
					}
					echo "</table>";
				}
			}

			exit();
		}
	}
?>