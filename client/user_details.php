<?php
	session_start();
	require_once'redir.php';
	if( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false )
	{	redirect('./0211.php');
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Account</title>
<link href="./css/2net2.css" rel="stylesheet" type="text/css" />
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
  
<div class="container">
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
	{	require_once './database_connect.php';
	
	$query = "SELECT first_name, last_name,email_id,gender, dob FROM user where userid=". $_SESSION['userid']. ";";
		$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
		while($row = mysql_fetch_array($result))
		{	echo "<br><b>First Name: </b>" . ucfirst($row["first_name"]);
			echo "<br><b>Last Name: </b>" . ucfirst($row["last_name"]);
			echo "<br><b>Email Id: </b>" . $row["email_id"];
			echo "<br><b>Gender: </b>" . $row["gender"];
			echo "<br><b>Dob: </b>" . $row["dob"];
		}
	}
	?>
  </div>
 </div>
  
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
 </div>
</body>
</html>
