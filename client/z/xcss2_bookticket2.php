<?php	
	session_start();
	require_once'redir.php';
	require_once 'bookticket_functions.php';
	require_once './database_connect.php';
	if (  !isset($_SESSION['logged_in'])  || ($_SESSION['logged_in'] == false )  )
	{  	redirect('./css2_sign_in.php'); 
	}
	if ( !isset($_SESSION['bookable']) || $_SESSION['bookable']==false )
	{	redirect('./css2_findbus.php');
	}
	if (  !isset($_SESSION['possible_to_buy'])  || ($_SESSION['possible_to_buy'] <0 )  )
	{  	redirect('./css2_bookticket1.php'); 
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
			/*$userid= isset($_SESSION['userid'])? $_SESSION['userid']:0;
			$routeid= isset($_SESSION['routeid'])?$_SESSION['routeid']:0;
			$source_city = isset($_SESSION['source_city']) ? $_SESSION['source_city'] : '';
			$destination_city = isset($_SESSION['destination_city']) ? $_SESSION['destination_city'] : '';
			$date= isset($_SESSION['date'])?$_SESSION['date']:0;
			$day = isset($_SESSION['day'])?$_SESSION['day']:0;
			$busid= isset($_SESSION['busid'])?$_SESSION['busid']:0;
			$no_of_seats = isset($_SESSION['no_of_seats'])? $_SESSION['no_of_seats']:0;
			$seat1 = isset($_SESSION['seat1'])? $_SESSION['seat1']:0;
			$seat1 = isset($_SESSION['seat2'])? $_SESSION['seat2']:0;
			$seat1 = isset($_SESSION['seat3'])? $_SESSION['seat3']:0;*/
			$userid= $_SESSION['userid'];
			$routeid=$_SESSION['routeid'];
			$source_city = $_SESSION['source_city'];
			$destination_city = $_SESSION['destination_city'];
			$date= $_SESSION['date'];
			$date = date('d-M-Y', strtotime($date));
			$day = $_SESSION['day'];
			$busid= $_SESSION['busid'];
			$no_of_seats = $_SESSION['no_of_seats'];
			$seat1 = isset($_SESSION['seat1'])? $_SESSION['seat1']:0;
			$seat2 = isset($_SESSION['seat2'])? $_SESSION['seat2']:0;
			$seat3 = isset($_SESSION['seat3'])? $_SESSION['seat3']:0;
				
			{	echo "<br><b>DETAILS<br></b>";
				echo "<br><b>Route: </b>" . $routeid;
				echo "<br><b>Source: </b>" . $source_city;
				echo "<br><b>Destination: </b>" . $destination_city;
				echo "<br><b>Date: </b>". $date;	
				echo "<br><b>Day: </b>" .$day;
				echo "<br><b>Bus: </b>" . $busid;
				$amount = calculate_amount( $busid,$no_of_seats);
				$insert=insert_ticket( $userid, $busid, $date, $no_of_seats, $seat1, $seat2, $seat3,$amount);
				$insert=1;
				if( $insert==1)
				{	echo "<br><b>Ticket made";
					$mail_sent= send_ticket_mail();
					if( $mail_sent ==1)
					{	echo "Check your email";
					}
					else
					{	echo "Error in sending mail.Rebook";
					}
				}
				else
				{	echo "<br><b>Error in making ticket";
					echo'<a href= "css2_bookticket1.php">back</a>';
				}
			
				unset_all_variables();
			}
			//echo '<br><b><a href="./0211.php">Home<b></a>';
			echo '<br><b><a href="./user_past_tickets.php">View Ticket Log<b></a>';
			//echo'<br><a href="./css2_useraccount.php">Your Account</a>';
			//exit();
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