<?php
	session_start();
	require_once'redir.php';
	require_once 'bookticket_functions.php';
	require_once './database_connect.php';
	if( isset($_POST['check_availability'] ) && ($_POST['check_availability']=='Check Availablity' ) )
	{	//$_SESSION['busid']= $_POST['busid'];	
		$busid = $_POST['busid'];
	}
	else
	{	redirect('./css2_findbus_script.php');
	}
	$routeid= $_SESSION['routeid'];
	$date= $_SESSION['date'];
	$date = date('d-M-Y', strtotime($date));
	$day = $_SESSION['day'];
	$source_city = $_SESSION['source_city'];
	$destination_city = $_SESSION['destination_city'];
	//$busid= $_SESSION['busid'];
	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Availability</title>
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
	?>
	<li class='last'><a href='#'><span>Contact</span></a></li>
	<li class='active'><a href='0211.php'><span>Home</span></a></li>
	<?php 
		if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true )		
		{ echo "<li style='float:left; margin-left:50px' class='has-sub'><a href='#'><span>Welcome ". $_SESSION['name'] ."</span></a>";
		  echo"<ul>";
		  echo"<li><a href='user_past_tickets.php'><span>Past Tickets</span></a></li>";
		  echo"<li><a href='user_details.php'><span>View Details</span></a></li>";
		  echo"<li><a href='#'><span>Edit Details</span></a>";
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
		<?php
		if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false )
		{	echo "<li><a href='./css2_create_account.php'>Create Account</a></li>";
		echo "<li><a href='./css2_sign_in.php'>Login</a></li>";
		}
		?>
		<li><a href="./css2_findbus.php">Find Bus</a></li>
		<li><a href="./css2_bookticket1.php">Book Ticket</a></li>
		<li><a href="">View Routes</a></li>
		<li><a href="">View Schedule of Next week</a></li>
		<li><a href="">Schemes</a></li>
		<li><a href="./cancelticket.php">Cancel Ticket</a></li>
		<li><a href="">Cancelled Buses</a></li>
		<li><a href="">Complaints</a></li>
		</ul>
</div>

<div class="content">
<?php
	echo "<br><b>Details</b>";
	echo "<br><b>Route: </b>" . $routeid;
	echo "<br><b>Source: </b>" . $source_city;
	echo "<br><b>Destination: </b>" . $destination_city;
	echo "<br><b>Date: </b>". $date;
	
	$timestamp= strtotime($date);
	$day = date("l", $timestamp);
	$_SESSION['day']= $day;
	
	echo "<br><b>Day: </b>" .$day;
	echo "<br><b>Bus: </b>" . $busid;

	$query = "SELECT * FROM schedule WHERE routeid=". $routeid. " and busid=". $busid. " and ". $day ."=1;";
	$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
	$available_count =find_available_seats( $busid, $date);
	echo "<br><b>No of available seats: </b>" . $available_count;
	if( $available_count==0 )
	{	echo "<br><br><b>Bus is full.</b></br>";
		//echo'<a href= "css2_findbus_script.php">back</a>';
		echo '<form method="post" action="css2_findbus_script.php">';
		echo'<td><input type="submit" name="back" value="Back"  class="button" style="margin-left:30px; margin-top:8px"/>';
		echo'</form>';
	}
	else
	{	echo '<form method="post" action="css2_bookticket1.php">';
		echo'<input type="submit" name="book" value="Book Ticket"  class="button" style="margin-left:60px; margin-top:10px"/>';
		echo'</form>';
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