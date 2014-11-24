<?php	
	session_start();
	require_once 'findbus_functions.php';
	require_once 'bookticket_functions.php';
	require_once './redir.php';
	require_once './database_connect.php';


	
	if( isset($_GET['source']) && ( isset($_GET['destination']) ) && ( isset($_GET['date'])) ) 
	{	$source_city = $_GET['source'];
		$destination_city = $_GET['destination'];
//here
		$date = $_GET['date'];
		$date = date('d-M-Y', strtotime($date));
		$timestamp= strtotime($date);
		$day = date("l", $timestamp);
	}
	else if( isset($_SESSION['source_city']) && isset($_SESSION['destination_city']) && isset($_SESSION['date']) )
	{	$source_city = $_SESSION['source_city'];
		$destination_city = $_SESSION['destination_city'];
		$date = $_SESSION['date'];
		$timestamp= strtotime($date);
		$day = date("l", $timestamp);
	}
	else
	{	redirect('./css2_findbus.php');
	}
	
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Find Bus</title>
<link href="./css/2net2.css" rel="stylesheet" type="text/css" />
<link href="./css/form_css.css" rel="stylesheet" type="text/css" />

<style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
var map;
var directionsDisplay;
var directionsService;
var stepDisplay;
var markerArray = [];

function initialize() {
  // Instantiate a directions service.
  directionsService = new google.maps.DirectionsService();

  // Create a map and center it on Delhi.
  var delhi = new google.maps.LatLng(28.6139, 77.2089);
  var mapOptions = {
    zoom: 10,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: delhi
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  // Create a renderer for directions and bind it to the map.
  var rendererOptions = {
    map: map
  }
  directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions)

  // Instantiate an info window to hold step text.
  stepDisplay = new google.maps.InfoWindow();
}

function calcRoute() {

  // First, remove any existing markers from the map.
  for (var i = 0; i < markerArray.length; i++) {
    markerArray[i].setMap(null);
  }

  // Now, clear the array itself.
  markerArray = [];

  // Retrieve the start and end locations and create
  // a DirectionsRequest using WALKING directions.
  var start = document.getElementById('start').value;
  var end = document.getElementById('end').value;
  var request = {
      origin: start,
      destination: end,
      travelMode: google.maps.TravelMode.DRIVING
  };

  // Route the directions and pass the response to a
  // function to create markers for each step.
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      var warnings = document.getElementById('warnings_panel');
      warnings.innerHTML = '<b>' + response.routes[0].warnings + '</b>';
      directionsDisplay.setDirections(response);
      showSteps(response);
    }
  });
}

function showSteps(directionResult) {
  // For each step, place a marker, and add the text to the marker's
  // info window. Also attach the marker to an array so we
  // can keep track of it and remove it when calculating new
  // routes.
  var myRoute = directionResult.routes[0].legs[0];

  for (var i = 0; i < myRoute.steps.length; i++) {
    var marker = new google.maps.Marker({
      position: myRoute.steps[i].start_location,
      map: map
    });
    attachInstructionText(marker, myRoute.steps[i].instructions);
    markerArray[i] = marker;
  }
}

function attachInstructionText(marker, text) {
  google.maps.event.addListener(marker, 'click', function() {
    // Open an info window when the marker is clicked on,
    // containing the text of the step.
    stepDisplay.setContent(text);
    stepDisplay.open(map, marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize );

    </script>
 

</head>

<body onload="calcRoute();" >
	    <div id='topbar'>
		<ul>
		   <?php 
				if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true )
				{	 echo"<li><a href='./css2_sign_out.php'><span>Sign Out</span></a>";
				}
				else if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false )
                {	echo "<li><a href='./css2_create_account.php'>Create Account</a></li>";
					echo "<li><a href='./css2_sign_in.php'>Login</a></li>";
				}
			?>
		   <li class='active'><a href='0211.php'><img src="images/home-icon.jpg" width="30" height="30" style="margin-top:15px" background="#000"></a></li>
			<?php 
				if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true )		
				{ echo "<li style='float:left; margin-left:50px' class='has-sub'><a href='#'><span>Welcome ". $_SESSION['name'] ."</span></a>";
				  echo"<ul>";
					echo"<li><a href='user_past_tickets.php'><span>Past Tickets</span></a></li>";
					echo"<li><a href='user_details.php'><span>View Details</span></a></li>";

				  echo"</ul>";
				  echo"</li>";
				}
			?>
		</ul>
		</div>
<div id="tablestruct">
  <div id="row">
          <div class="sidebar2">
              <ul class="nav">  
                 <li><a href="./css2_findbus.php">Find Bus</a></li>
                 <li><a href="./css2_bookticket1.php">Book Ticket</a></li>
                 <li><a href="./view_route.php">View Routes</a></li>
                 <li><a href="./view_schedule.php">Weekly Schedule</a></li>
                 <li><a href="./cancelticket.php">Cancel Ticket</a></li>
                 <
                </ul>
        </div>
	<div class="content">
<?php
	/*$source_city = $_SESSION['source_city'];
	$destination_city = $_SESSION['destination_city'];
	$date = $_SESSION['date'];*/
	/*$day = $_SESSION['day'];*/
	$required_routeid='';
	
	$query = "SELECT routeid FROM route WHERE source='" .$source_city."' AND destination= '" .$destination_city. "';";
	$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
	$row = mysql_fetch_row($result);
	$number_of_routes = mysql_num_rows($result);
	
	//echo "<br><b>DETAILS</b><br>";
	echo "<br><b>From: </b>" . $source_city;
	echo "<span style='margin-left:20px'><b>To: </b>" . $destination_city."</span>";
	echo "<br><b>Departure Date: </b>". $date;
	echo "<br><b>Departure Day: </b>" .$day;
	if( $number_of_routes==0 )
	{	echo"<br><br><b style='color:#cc2c24'>No route exists. </b>";
		echo'<br><br><b><u><a href="./view_schedule.php">View Schedule</a></u></b>';
		echo '<form method="post" action="css2_findbus.php">';
			echo'<input type="hidden" name="source_city" value='.$source_city.'>';
			echo'<input type="hidden" name="destination_city" value='.$destination_city.'>';
			echo'<input type="hidden" name="date" value='.date('Y-m-d', strtotime($date)).'>';
		echo'<br><input type="submit" name="back" value="Back"  class="button" style="margin-left:50px; margin-top:8px"/>';
		echo'</form>';
	}
	else
	{	$required_routeid = $row[0];
		echo "<br><b>Route ID: </b>". $required_routeid;
		$query = "SELECT busid FROM schedule WHERE routeid=". $required_routeid. " and ". $day ."=1;";
		$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
		$number_of_buses = mysql_num_rows($result);
		if( $number_of_buses==0 )
		{	echo"<br><br><b style='color:#cc2c24'>No bus runs on this day. Please see the schedule.</b>";
					
			echo'<br><br><b><u><a href="./view_schedule.php">View Schedule</a></u></b>';
			
			echo '<form method="post" action="css2_findbus.php">';
				echo'<input type="hidden" name="source_city" value='.$source_city.'>';
				echo'<input type="hidden" name="destination_city" value='.$destination_city.'>';
				echo'<input type="hidden" name="date" value='.date('Y-m-d', strtotime($date)).'>';
			echo'<br><input type="submit" name="back" value="Back"  class="button" style="margin-left:50px; margin-top:8px"/>';
			echo'</form>';
		}
		else
		{	echo "<br><br><b><u> BUSES AVAILABLE ON ". $date. " </u></b>";
		
			echo "<table border='1' cellpadding='5' style='margin-top:10px'>
				 <tr><th>Route ID</th>
				 <th> Bus ID </th>
				 <th>Departure Time</th>
				 <th>Arrival Time</th>
				 <th>Bus Type</th>
				 <th>Base Fare(₹)</th>
				 <th>Seats Available</th>
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
				$bus_query = "SELECT bustype, fare FROM bus WHERE busid=". $bus. ";";
				$bus_result = mysql_query($bus_query, $db_connection) or die("query error". mysql_error());
				$bus_row = mysql_fetch_row($bus_result);
				echo "<td>" . $bus_row[0] . "</td>";
				echo "<td>" . $bus_row[1] . "</td>";
				$date = date('Y-m-d', strtotime($date));
				$available_count =find_available_seats( $bus, $date);
				if( $available_count==0 )
				{	echo "<td>Full</td>";
				}
				else
				{	echo "<td>" . $available_count . "</td>";
				}
				$date = date('d-M-Y', strtotime($date));
				echo '<form method="post" action="./css2_bookticket1.php">';
				echo'<input type="hidden" name="source_city" value='.$source_city.'>';
				echo'<input type="hidden" name="destination_city" value='.$destination_city.'>';
				echo'<input type="hidden" name="date" value='.$date.'>';
				echo'<input type="hidden" name="day" value='.$day.'>';
				echo'<input type="hidden" name="routeid" value='.$required_routeid.'>';
				echo'<input type="hidden" name="busid" value='.$bus.'>';
				if ( $available_count!=0 )
				{	echo'<td><input type="submit" name="book" value="Book"  class="button" style="width:100%" /></td>';
				}
				else
				{	echo '<td>Full</td>';
				}
				echo"</tr>";
				echo'</form>';
			}
			echo "</table>";
			echo"<br>";
			/*echo '<form method="post" action="css2_findbus.php">';
			echo'<td><input type="submit" name="new_search" value="New Search"  class="button" style="margin-left:250px; margin-top:8px"/>';
			echo'</form>';*/
		}
	}
?>
</div>
</div>
</div>
<?php mysql_close($db_connection);?>
<div id="panel"  >
    <b>Start: </b>
    <select id="start">
      <option value="<?php echo $source_city ?>"><?php echo $source_city ?></option>
      
    </select>
    <b>End: </b>
    <select id="end" >   <!-- onchange="calcRoute();" -->
      <option value="<?php echo $destination_city ?>"><?php echo $destination_city ?></option>
      
    </select>
    </div>
    <div id="map-canvas" style="width:500px;height:380px; margin-left: 300px ; margin-top : -90px ;"></div>
    &nbsp;
    <div id="warnings_panel" style="width:100%;height:10%;text-align:center"></div>
	
<div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
</div>
</body>
</html>