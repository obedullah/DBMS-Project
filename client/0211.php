<?php
	session_start();
	require_once'redir.php';
	redirect('./css2_findbus.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HOME PAGE</title>
<link href="./css/2net2.css" rel="stylesheet" type="text/css" />
</head>

<body>
	    <div id='topbar'>
        <ul>
			<?php 
				if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true )
				{	 echo"<li><a href='./css2_sign_out.php'><span>Sign Out</span></a>";
				}
			?>
			 <?php
				 if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false )
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
				<!--?php
				 if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false )
                 {	echo "<li><a href='./css2_create_account.php'>Create Account</a></li>";
					echo "<li><a href='./css2_sign_in.php'>Login</a></li>";
				 }
				 ?-->
                 <li><a href="./css2_findbus.php">Find Bus</a></li>
                 <li><a href="./css2_bookticket1.php">Book Ticket</a></li>
                 <li><a href="view_route.php">View Routes</a></li>
                 <li><a href="./view_schedule.php">View Schedule of Next week</a></li>
                 <li><a href="./cancelticket.php">Cancel Ticket</a></li>
                </ul>
        </div>
  	
    	<div class="content">
  		</div>
  </div>
  </div>
  
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</body>
</html>
