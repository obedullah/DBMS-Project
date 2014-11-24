<?php	
	require 'findbus_functions.php';
	$source_cityErr = $destination_cityErr = $dateErr ='';
	$source_city = isset($_POST['source_city']) ? $_POST['source_city'] : '';
	$destination_city = isset($_POST['destination_city']) ? $_POST['destination_city'] : '';
	$date = isset($_POST['date']) ? $_POST['date'] : date("Y-m-d");
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
			echo "<br><b>DETAILS</b><br>";
			echo "<br><b>Source: </b>" . $source_city;
			echo "<br><b>Destination: </b>" . $destination_city;
			echo "<br><b>Departure Date: </b>". $date;
			$timestamp= strtotime($date);
			$day = date("l", $timestamp);
			echo "<br><t><b>Departure Day: </b>" .$day;
			if( $number_of_routes==0 )
			{	echo"<br><br><b>No route found. ";
				echo "<br><b><a href='css2_findbus.php'>Back</a>";
				$_SESSION['bookable']=false;
			}
			else
			{	$required_routeid = $row[0];
				echo "<br><b>Route Id: </b>". $required_routeid;
				$query = "SELECT busid FROM schedule WHERE routeid=". $required_routeid. " and ". $day ."=1;";
				$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
				$number_of_buses = mysql_num_rows($result);
				if( $number_of_buses==0 )
				{	echo"<br><br><b>No bus found. </b>";
					echo "<br><br><b><a href='css2_findbus.php'>back</a></b>";
					$_SESSION['bookable']=false;
				}
				else
				{	echo "<br><br><b>SCHEDULE OF BUSES AVAILABLE ON ". $date. " </b><br>";
					echo "<table border='1' cellpadding='5'>
						 <tr><th>Route Id</th>
							 <th> Bus Id </th>
							 <th>Departure Time</th>
							 <th>Arrival Time</th>
							 <th>Departure Day</th>
							 <th>Bus Type</th>
							 <th>Book Seat</th>
						</tr>";
						$_SESSION['routeid'] = $required_routeid;
						$_SESSION['date']=$date;
						$_SESSION['day']= $day;
						$_SESSION['source_city']=$_POST['source_city'];
						$_SESSION['destination_city']=$_POST['destination_city'];
						$_SESSION['bookable']=false;
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
						$bus_query = "SELECT bustype FROM bus WHERE busid=". $bus. ";";
						$bus_result = mysql_query($bus_query, $db_connection) or die("query error". mysql_error());
						$bus_row = mysql_fetch_row($bus_result);
						echo "<td>" . $bus_row[0] . "</td>";
						//echo '<form method="post" action="css2_bookticket1.php">';
						echo '<form method="post" action="check_availability.php">';
							echo'<input type="hidden" name="busid" value='.$bus.'>';
							//echo'<td><input type="submit" name="book" value="book"  class="button" style="width:100%" /></td>';
							echo'<td><input type="submit" name="check_available" value="check"  class="button" style="width:100%" /></td>';
							echo"</tr>";
						echo'</form>';
					}
					echo "</table>";
					echo"<br><br><br>";
				}
			}
			echo"</div>";
			echo"</div>";
			echo"</div>";
			echo'<div class="footer">';
			echo'<p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>';
			echo"</div>";
			exit();
		}
	}
?>