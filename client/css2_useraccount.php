<?php
	session_start();
?>
<?php
	require_once'redir.php';
	if( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false )
	{	//redirect('./0211.php');
		redirect('./css2_sign_in.php');
	}
	//if ( isset($_SESSION['bookable']) && $_SESSION['bookable']==true )
	if ( isset($_SESSION['busfound']) && $_SESSION['busfound']==true )
	{	redirect('./css2_bookticket1.php');
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
		     <!--li class='has-sub'><a href='#'><span><--?php echo $_SESSION['email_id'] ?></span></a>
			     <ul>
				 
		        	<li class='has-sub'><a href="css2_sign_out.php"><span>Sign Out</span></a>
	   	         	<li class='has-sub'><a href='#'><span>Edit Details</span></a>
      			</ul>
   			</li-->
		   <!--li class='last'><a href='#'><span>Contact</span></a></li-->
		   <!--li><a href='#'><span>About</span></a></li-->		
		   <li><a href="css2_sign_out.php"><span>Sign Out</span></a>
		   <li class='active'><a href='0211.php'><span>Home</span></a></li>
		   <li style="float:left; margin-left:50px" class='has-sub'><a href="#"><span>Welcome <?php echo $_SESSION['name'] ?></span></a>
		    <ul>	 
		        <li class='has-sub'><a href="user_past_tickets.php"><span>Past Tickets</span></a></li>
	   	        <li class='has-sub'><a href='user_details.php'><span>View Profile</span></a></li>
      		</ul>
			</li>
		</ul>
	</div>
  
  <div class="container">
  <div class="sidebar2">
    <ul class="nav">
         <li><a href="./css2_findbus.php">Find Bus</a></li>
         <li><a href="./css_bookticket1.php">Book Ticket</a></li>
         <li><a href="./view_route.php">View Routes</a></li>
         <li><a href="./view_schedule.php">View Schedule of Next week</a></li>
         <li><a href="./cancelticket.php">Cancel Ticket</a></li>
    </ul>
  </div>
  <div class="content">
  <?php
			if( isset($_SESSION['email_id']) )
			{	echo "<br><b>EMAIL-ID:".$_SESSION['email_id']."</b></br>";
			}
			if( isset($_SESSION['userid']) )
			{	echo "<br><b>USERID:".$_SESSION['userid']."</b></br>";
			}
	?>
  </div>
  
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
 </div>
</body>
</html>
