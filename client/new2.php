<!--make ticket-->
<?php	
	session_start();
	require_once'redir.php';
	require_once 'bookticket_functions.php';
	require_once './database_connect.php';
	if (  !isset($_SESSION['logged_in'])  || ($_SESSION['logged_in'] == false )  )
	{  	redirect('./css2_sign_in.php'); 
	}
	if (  !isset($_SESSION['passenger1'])  ||  !isset($_SESSION['passenger2']) ||  !isset($_SESSION['passenger3'])  )
	{  	redirect('./new.php'); 
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Book Ticket</title>
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
			$userid= $_SESSION['userid'];
			$routeid=$_SESSION['routeid'];
			$source_city = $_SESSION['source_city'];
			$destination_city = $_SESSION['destination_city'];
			$date= $_SESSION['date'];
			$date = date('d-M-Y', strtotime($date));
			$day = $_SESSION['day'];
			$busid= $_SESSION['busid'];
			$no_of_seats = $_SESSION['no_of_seats'];
			$seat1 = $_SESSION['seat1'];
			$seat2 = $_SESSION['seat2'];
			$seat3 = $_SESSION['seat3'];
			$passenger1= $_SESSION['passenger1'];
			$passenger2= $_SESSION['passenger2'];
			$passenger3= $_SESSION['passenger3'];
			
			/*echo"<br>userid". $_SESSION['userid'];
			echo"<br>routeid=".$_SESSION['routeid'];
			echo"<br>source_city =". $_SESSION['source_city'];
			echo"<br>destination_city = ".$_SESSION['destination_city'];
			echo"<br>date=". $_SESSION['date'];
			echo"<br>date =". date('d-M-Y', strtotime($date));
			echo"<br>day = ".$_SESSION['day'];
			echo"<br>busid=". $_SESSION['busid'];
			echo"<br>no_of_seats =". $_SESSION['no_of_seats'];
			echo"<br>seat1 =". $_SESSION['seat1'];
			echo"<br>seat2 =". $_SESSION['seat2'];
			echo"<br>seat3 =". $_SESSION['seat3'];
			echo"<br>passenger1=". $_SESSION['passenger1'];
			echo"<br>passenger2=". $_SESSION['passenger2'];
			echo"<br>passenger3=". $_SESSION['passenger3'];*/
				
			{	/*echo "<br><b>DETAILS<br></b>";
				echo "<br><b>Route: </b>" . $routeid;
				echo "<br><b>Source: </b>" . $source_city;
				echo "<span><br><b>Destination: </b>" . $destination_city."</span>";
				echo "<br><b>Date: </b>". $date;	
				echo "<span><br><b>Day: </b>" .$day."</span>";
				echo "<br><b>Bus: </b>" . $busid;
				echo "<br><b>Seat: </b>" . $seat1;
				echo "<span><b>Passenger: </b>" . $passenger1."</span>";
				echo "<br><b>Seat: </b>" . $seat2;
				echo "<span><b>Passenger: </b>" . $passenger2."</span>";
				echo "<br><b>Seat: </b>" . $seat3;
				echo "<span><b>Passenger: </b>" . $passenger3."</span>"; */
				$amount = calculate_amount( $busid,$no_of_seats);
				$insert=insert_ticket( $userid, $busid, $date, $no_of_seats, $seat1, $seat2, $seat3,$passenger1, $passenger2, $passenger3,$amount);
				$insert=1;
				if( $insert==1)
				{	echo "<br><b>Ticket made</b>";
					$mail_sent= send_ticket_mail();
					if( $mail_sent ==1)
					{	echo "<span> Check your mail.</b>";
					}
					else
					{	echo "<br><b>Error in sending mail.Re-book.</b>";
					}
				}
				else
				{	echo "<br><b>Error in making ticket.</b>";
					echo'<a href= "css2_bookticket1.php">Back</a>';
				}			
				unset_all_variables();
			}
			echo '<br><b><a href="./user_past_tickets.php">View Ticket Log</b></a>';
		?>
<?php mysql_close($db_connection);?>
</div>
  </div>
  </div>
  
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</body>
</html>