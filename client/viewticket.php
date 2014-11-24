<?php	session_start();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>View Ticket</title>
	<link href="./css/2net2.css" rel="stylesheet" type="text/css" />
	<link href="./css/form_css.css" rel="stylesheet" type="text/css" />
	<link href="./css/ticket_design.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
	require_once'redir.php';
	require_once './database_connect.php';
	if (  !isset($_SESSION['logged_in'])  || ($_SESSION['logged_in'] == false )  )
	{  	redirect('./css2_sign_in.php');
	}
	if( isset($_POST['view'] ) && ($_POST['view']=='View Ticket' ))
	{	$ticketid = $_POST['ticketid'];
	}
	else
	{	redirect('./user_past_tickets.php');
	}
?>
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
                
                </ul>
        </div>
 <div class="content">
 
 <?php
		$query = "select * from ticket where ticketid= $ticketid;";
		$result = mysql_query($query, $db_connection);
		if (!$result)
		{	echo "<br>delete failed<br />" . mysql_error() . "<br /><br />";
			die("Error querying database.". mysql_error() );
		}
echo'<br><br>';
echo'<div id="ticketlayout" style="margin-left:80px">';
?>

<br><br><b style="margin-left:150px; font-size:20px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;color:#C66">VOSS TRAVELS</b><br>
<?php		
			while($row = mysql_fetch_array($result))
			{	
				$busid= $row["busid"];
				$departuredate = $row["departuredate"];
				$departuredate = date('d-M-Y', strtotime($departuredate));
				$bookingdate = $row["bookingdate"];
				$bookingdate = date('d-M-Y', strtotime($bookingdate));
				$no_of_seats = $row["no_of_seats"];
				$seat1 = $row["seat1"];
				$seat2 = $row["seat2"];
				$seat3 = $row["seat3"];
				$passenger1 = $row["passenger1"];
				$passenger2 = $row["passenger2"];
				$passenger3 = $row["passenger3"];
				$timestamp= strtotime($departuredate);
				$day= date("l", $timestamp);
				
				$query2 = "select departure_time, arrival_time from schedule where busid=". $busid ." AND ". $day."=1;";
				$result2 = mysql_query($query2, $db_connection) or die("Error querying database.". mysql_error() );
				$row2 = mysql_fetch_array($result2);
				$departure_time = $row2["departure_time"];
				$arrival_time = $row2["arrival_time"];
				
				$route_query = "SELECT routeid FROM schedule where busid=". $busid. " and ". $day ."=1;";
				$route_result = mysql_query($route_query, $db_connection) or die("query error". mysql_error());
				$route_row = mysql_fetch_row($route_result);
				$routeid = $route_row[0];
				
				$city_query = "SELECT source,destination FROM route where routeid=". $routeid.";";
				$city_result = mysql_query($city_query, $db_connection) or die("query error". mysql_error());
				$city_row = mysql_fetch_row($city_result);
				$source = $city_row[0];
				$destination = $city_row[1];
				
				$source = ucfirst($source); 
				$destination = ucfirst($destination); 
		
				echo "<br><b>Ticket ID:</b> " . $row["ticketid"];
				echo "<br><b>Bus ID:</b> " . $row["busid"];
				echo "<br><b>From:</b> " . $source;
				echo "<span><b>To:</b> " . $destination."</span>";
				echo "<br><b>Date of Departure:</b> " . $departuredate;
				echo "<br><b>Time of Departure:</b> " . $departure_time;
				echo "<br><b>Time of Arrival:</b> " . $arrival_time;
				echo "<br><b>No of Seats:</b> " . $row["no_of_seats"];
				echo "<br><b>Seat: </b>" . $seat1;
				$passenger1 = ucfirst($passenger1); 
				echo "<span><b>Passenger: </b>" . $passenger1."</span>";
				if( $no_of_seats>=2)
				{	echo "<br><b>Seat: </b>" . $seat2;
					$passenger2 = ucfirst($passenger2); 
					echo "<span><b>Passenger: </b>" . $passenger2."</span>";
				}
				if( $no_of_seats==3)
				{	echo "<br><b>Seat: </b>" . $seat3;
					$passenger3 = ucfirst($passenger3); 
					echo "<span><b>Passenger: </b>" . $passenger3."</span>";
				}
				echo "<br><b>Amount:</b> ?" . $row["amount"];
				echo "<br><b>Booked on:</b> " . $bookingdate;
				echo "<br><b>Booked by:</b> " . $_SESSION['name'] .' '. $_SESSION['lastname'];
			}
echo'<br><br><br>';
?>
</div>
<br><br>
<input type="button" class="button" onClick="window.print()"  value="Print Ticket" style="margin-left:270px"/>
<br><br>
</div>
  </div>
  </div>
   <?php mysql_close($db_connection);?>  
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</body>
</html>