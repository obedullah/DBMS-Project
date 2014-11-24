<!--/*GET PASSENGER NAMES*/-->
<?php	
	session_start();
	require_once'redir.php';
	require_once 'bookticket_functions.php';
	require_once './database_connect.php';
	if (  !isset($_SESSION['logged_in'])  || ($_SESSION['logged_in'] == false )  )
	{  	redirect('./css2_sign_in.php'); 
	}
	if ( !isset($_SESSION['no_of_seats'] )|| !isset($_SESSION['seat1']) || !isset($_SESSION['seat2'])|| !isset($_SESSION['seat3'] ) )
	{	redirect('./css2_bookticket1.php');
		exit();
	}
	else if ( ($_SESSION['no_of_seats'] )==0 )
	{	redirect('./css2_bookticket1.php');
		exit();
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
		{	echo "<br><b>DETAILS<br></b>";
		echo "<br><b>From: </b>" . $source_city;
		echo "<span style='margin-left:10px'><b>To: </b>" . $destination_city."</span>";
		echo "<br><b>Departure Date: </b>". $date;
		echo "<br><b>Departure Day: </b>" .$day;
		echo "<br><b>Route ID: </b>" . $routeid;
		echo "<br><b>Bus No.: </b>" . $busid;
		if( $no_of_seats==3)
			echo"<br><b>Seats:</b>". $seat1 .", ". $seat2 .", ". $seat3;
		else if( $no_of_seats==2)
		echo"<br><b>Seats:</b>". $seat1 .", ". $seat2;
		else if( $no_of_seats==1)
			echo"<br><b>Seat:</b>". $seat1;
		}
		
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
			echo"<br>seat3 =". $_SESSION['seat3']; */
	?>
	
<?php
		$passenger1Err = $passenger2Err= $passenger3Err ='';
		$error=0;
		$passenger1 = isset($_POST['passenger1']) ? $_POST['passenger1'] : '';
		$passenger2 = isset($_POST['passenger2']) ? $_POST['passenger2'] : '';
		$passenger3 = isset($_POST['passenger3']) ? $_POST['passenger3'] : '';
			
		if( isset($_POST['buy'] ) && $_POST['buy']=="Buy Ticket" )
		{	
			$change = check_if_seats_changed($_POST['prev_no_of_seats'], $_POST['prev_seat1'], $_POST['prev_seat2'],$_POST['prev_seat3'] );
			if( $change==1 )
			{	unset_passenger_variables();	
				echo 'change='.$change;
				redirect('./new.php');
			}
			$error=validate_passenger_form();
			if($error==0 )
			{ 
			  $_SESSION['passenger1']= $passenger1;
			  $_SESSION['passenger2']= $passenger2;
			  $_SESSION['passenger3']= $passenger3;
			 /* echo "<br><b>p1: </b>" . $passenger1;
			  echo "<br><b>p2: </b>" . $passenger2;
			 echo "<br><b>p3: </b>" . $passenger3;
			  echo "redirect";*/
			 redirect('./new2.php');
			 //exit();
			}
		}
?>
	
<form id="contactform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<br><br><p><b>Please fill name of passengers:</b></p>
	<?php 
		if($no_of_seats>=1)
        {	echo'<br>';
			echo'<div class="field">';
			echo'<label for="passenger1">Passenger 1: </label>';
			echo'<input type="text" id="passenger1" name="passenger1" class="input" value="'.$passenger1.'"/> ';
			echo'<span class="error">*'.$passenger1Err. '</span>';
			echo'</div>';
		}
		if($no_of_seats>=2)
        {	
			echo'<div class="field">';
			echo'<label for="passenger2">Passenger 2: </label>';
			echo'<input type="text" id="passenger2" name="passenger2" class="input"  value= "'.$passenger2.'"/> ';
			echo'<span class="error">*'.$passenger2Err.'</span>';
			echo'</div>';
		}
		if($no_of_seats==3)
        {	
			echo'<div class="field">';
			echo'<label for="passenger3">Passenger 3: </label>';
			echo'<input type="text" id="passenger3" name="passenger3" class="input"  value= "'.$passenger3.'"/> ';
			echo'<span class="error">*'.$passenger3Err.'</span>';
			echo'</div>';
		}
	?>
	 <div class="field">
<?php		echo'<input type="hidden" name="prev_no_of_seats" value='.$no_of_seats.'>';
			echo'<input type="hidden" name="prev_seat1" value='.$seat1.'>';
			echo'<input type="hidden" name="prev_seat2" value='.$seat2.'>';
			echo'<input type="hidden" name="prev_seat3" value='.$seat3.'>';
?>
	<input type="submit" name="buy" value="Buy Ticket"  class="button" style="margin-left:310px"/>
	</div>
</form>	


		
<?php mysql_close($db_connection);?>
</div>
  </div>
  </div>
  
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</body>
</html>