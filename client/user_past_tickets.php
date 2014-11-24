<?php
	session_start();
	require_once'redir.php';
	require_once './database_connect.php';
	if( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false )
	{	redirect('./0211.php');
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Account</title>
<link href="./css/2net2.css" rel="stylesheet" type="text/css" />
<link href="./css/form_css.css" rel="stylesheet" type="text/css" />
</head>

<body>
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
	if( isset($_SESSION['logged_in']) )
	{	echo "<br><b>Past tickets:</b>";
		$query = "SELECT ticketid, busid,departuredate, no_of_seats,bookingdate, amount FROM ticket where userid=". $_SESSION['userid']. ";";
		$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
		$num_rows = mysql_num_rows($result);
		if( $num_rows==0 )
		{	echo "<b>No tickets purchased.</b>";
		}
		else
		{	echo "<table border='1' cellpadding='5'>
						 <tr><th>Ticket No.</th>
							 <th> Bus ID </th>
							 <th>Departure Date</th>
							 <th> From  </th>
							 <th>To</th>
							 <th>No. of seats</th>
							 <th>Booking Date</th>
							 <th>Amount(₹)</th>
							 <th>Status</th>
							 <th>View/Print Ticket</th>
						</tr>";
			while($row = mysql_fetch_array($result))
			{	echo "<tr>";
				echo "<td>" . $row["ticketid"]. "</td>";
				echo "<td>" . $row["busid"]. "</td>";
				//echo "<td>" . $row["departuredate"]. "</td>";
				$departuredate = $row["departuredate"];
				$departuredate = date('d-M-Y', strtotime($departuredate));

				echo "<td>" . $departuredate. "</td>";
				
				$timestamp= strtotime($departuredate);
				$day = date("l", $timestamp);
				
				$route_query = "SELECT routeid FROM schedule where busid=". $row["busid"]. " and ". $day ."=1;";
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
				
				echo "<td>" . $source. "</td>";
				echo "<td>" . $destination. "</td>";
				echo "<td>" . $row["no_of_seats"]. "</td>";
				
				$bookingdate = $row["bookingdate"];
				$bookingdate = date('d-M-Y', strtotime($bookingdate));
				echo "<td>" . $bookingdate. "</td>";
				
				echo "<td>" . $row["amount"]. "</td>";
				//echo "<td>" . $row["bookingdate"]. "</td>";
				if( $row["departuredate"] > date("Y-m-d") )
				{	//echo "<td>ticket can be deleted</td>";
					echo '<form method="post" action="cancelticket.php">';
					echo'<input type="hidden" name="ticketid" value='.$row["ticketid"].'>';
					echo'<td><input type="submit" name="cancel" value="Cancel Ticket"  class="button" style="width:100%" /></td>';
					echo'</form>';
				}
				else if( $row["departuredate"] < date("Y-m-d") )
				{	echo"<td>Travelled</td>";
				}
				else
				{	echo"<td>Journey today</td>";
				}
				echo '<form method="post" action="viewticket.php">';
				echo'<input type="hidden" name="ticketid" value='.$row["ticketid"].'>';
				echo'<td><input type="submit" name="view" value="View Ticket"  class="button" style="width:100%" /></td>';
				echo'</form>'; 
				echo"</tr>";
			}
			echo"</table>";
		}
	}
	?>
  </div>
 </div>
</div>
  <?php mysql_close($db_connection);?>
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</body>
</html>
