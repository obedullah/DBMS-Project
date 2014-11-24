<?php	
	require 'bookticket_functions.php';
	$useridErr = $routeidErr = $busidErr = $dateErr = $no_of_seatsErr='';
	
	$userid = isset($_POST['userid']) ? $_POST['userid'] : '';
	$routeid = isset($_POST['routeid']) ? $_POST['routeid'] : '';
	$busid = isset($_POST['busid']) ? $_POST['busid'] : '';
	$date = isset($_POST['date']) ? $_POST['date'] : '';
	$no_of_seats = isset($_POST['no_of_seats']) ? $_POST['no_of_seats'] : 0;
	$day='';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		$error= validate_bookticket_form();
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
			echo "<br><b>Details</b>";
			echo "<br><b>Userid:</b>" . $userid;
			echo "<br><b>Route:</b>" . $routeid;
			echo "<br><b>Bus:</b>" . $busid;
			echo "<br><b>Date: </b>". $date;
			
			$timestamp= strtotime($date);
			$day = date("l", $timestamp);
			echo "<br><b>Day:</b>" .$day;
			
			$query = "SELECT * FROM schedule WHERE routeid=". $routeid. " and busid=". $busid. " and ". $day ."=1;";
			$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
			$bus_runs_on_day = mysql_num_rows($result);
			
			if( $bus_runs_on_day==0 )
			{	echo"<br>Bus doesnt run on route on this day. ";
			}
			else
			{	
				$available_count =find_available_seats( $busid, $date);
				$possible_to_buy = $available_count - $no_of_seats;
				if( $available_count==0 )
				{	echo "<br>Bus is full.</br>";
				}
				else if ( $possible_to_buy <0 )
				{	echo "<br>Required no of seats not available.";
				}
				else if ($possible_to_buy>=0)
				{	echo "<br>You can book seats.";
				}
				echo "<p><b>SCHEDULE OF BUSES AVAILABLE:". $date. " </b><br>";
				echo "<table border='1'>
					  <tr><th>Routeid</th>
				      <th>Busid</th>
					  <th>Departure time</th>
					  <th>Arrival time</th>
					  <th>Departure Day</th>
					  <th>Seats Available</th>
					  </tr>";
				while($row = mysql_fetch_array($result))
				{	
					echo "<tr>";
					echo "<td>" . $row[0] . "</td>";
					echo "<td>" . $row[1] . "</td>";
					echo "<td>" . $row[2] . "</td>";
					echo "<td>" . $row[3] . "</td>";
					echo "<td>" . $day . "</td>";
					echo "<td>" . $available_count . "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			
			if ($possible_to_buy>=0)
			{	echo '<form>';
				echo "<br>Select seat:</br>";
				$seats=get_available_seatno($busid, $date);
				/*
				echo "<select name=seat>";
				for($i=0; $i < count($seats); $i++)
				{	echo "<option value=". $seats[$i] .">" . $seats[$i] . "</option>";
				}
				echo "</select>";
				*/
				for($i=0; $i < count($seats); $i++)
				{	
					echo '<input type="checkbox" name="seat" value=" . $seats[$i] ." />'. "Seat Number ". $seats[$i] ."<br>";
				}
				echo "</form>";
			}
		}
		exit();
	}
?>

