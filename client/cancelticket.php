<?php	session_start();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Cancel Ticket</title>
	<link href="./css/2net2.css" rel="stylesheet" type="text/css" />
	<link href="./css/form_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
	require_once'redir.php';	
	if (  !isset($_SESSION['logged_in'])  || ($_SESSION['logged_in'] == false )  )
	{  	redirect('./css2_sign_in.php');
	}
	if( isset($_POST['cancel'] ) && ($_POST['cancel']=='Cancel Ticket' ))
	{	$ticketid = $_POST['ticketid'];
	}
	else
	{	redirect('./user_past_tickets.php');
	}
	require_once './database_connect.php';
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
                 <li><a href="">Schemes</a></li>
                 <li><a href="./cancelticket.php">Cancel Ticket</a></li>
                 <li><a href="">Cancelled Buses</a></li>
                 <li><a href="">Complaints</a></li>
                </ul>
        </div>
  	
    	<div class="content">
<?php
		$query = "delete from ticket where ticketid= $ticketid;";
		$result = mysql_query($query, $db_connection);
		if (!$result)
		{	echo "<br>delete failed<br />" . mysql_error() . "<br /><br />";
			die("Error querying database.". mysql_error() );
		}
		$affected_rows = mysql_affected_rows();
		if( $affected_rows!=0)
		{		echo "<br><b>Ticket deleted.</b>";
				echo "<b><a href='./user_past_tickets.php'>View Ticket Log</a></b>";
		}
		else
		{	redirect('./user_past_tickets.php');
		}
		mysql_close($db_connection);
?>

</div>
  </div>
  </div>
  
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</body>
</html>