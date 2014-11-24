<?php
	session_start();
	require_once'redir.php';
	require_once 'bookticket_functions.php';
	require_once './database_connect.php';
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Book Ticket</title>
<link href="./css/2net2.css" rel="stylesheet" type="text/css" />
<!-- <link href="./css/form_css.css" rel="stylesheet" type="text/css" />  -->
<link href="./css/seat3.css" rel="stylesheet" type="text/css" />
</head>


<?php
	if( isset($_POST['Yes'] ) && ($_POST['Yes']=='Yes' ) )
	{	$_SESSION['busfound']=true;
		$_SESSION['source_city'] =$_POST['source_city'];
		$_SESSION['destination_city']=$_POST['destination_city'];
		$_SESSION['date']= $_POST['date'];
		$_SESSION['day']=$_POST['day']; 
		$_SESSION['routeid']= $_POST['routeid'];
		$_SESSION['busid']= $_POST['busid'];
				
		unset($_SESSION['showform']);
		unset_seat_variables();
		redirect('./css2_bookticket1.php');
	}
	else if( isset($_POST['No'] ) && ($_POST['No']=='No' ) )
	{	unset($_SESSION['showform']);
		redirect('./css2_bookticket1.php');
	}
	
	if( isset($_POST['book'] ) && ($_POST['book']=='Book' ) )
	{	if ( !isset($_SESSION['busfound']) || $_SESSION['busfound']==false )
		{	$_SESSION['busfound']=true; // ************************
			$_SESSION['source_city'] =$_POST['source_city'];
			$_SESSION['destination_city']=$_POST['destination_city'];
			$_SESSION['date']= $_POST['date'];
			$_SESSION['day']=$_POST['day']; 
			$_SESSION['routeid']= $_POST['routeid'];
			$_SESSION['busid']= $_POST['busid'];
			unset_seat_variables();	
		}
		else if ( check_if_booking_changed($_POST['routeid'], $_POST['busid'], $_POST['date']) )
		{	$_SESSION['showform']=true;
			echo '<br><b>Do you want to start with a new booking?</b>';
			echo '<br><br><b>Currently Searched Bus for the journey:  </b>'. $_SESSION['source_city'] .' to '.$_SESSION['destination_city'].' departing on '.$_SESSION['date'];
			echo '<br><b>New Booking for the journey:  </b>'. $_POST['source_city'] .' to '. $_POST['destination_city'].' departing on '.$_POST['date'];
			echo '<form method="post" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'>';
			echo'<input type="hidden" name="source_city" value='.$_POST['source_city'].'>';
			echo'<input type="hidden" name="destination_city" value='.$_POST['destination_city'].'>';
			echo'<input type="hidden" name="date" value='.$_POST['date'].'>';
			echo'<input type="hidden" name="day" value='.$_POST['day'].'>';
			echo'<input type="hidden" name="routeid" value='.$_POST['routeid'].'>';
			echo'<input type="hidden" name="busid" value='.$_POST['busid'].'>';
			echo'<br>';
			echo'<input type="submit" name="Yes" value="Yes" class="button" style="margin-left:200px"/>';
			echo'<span><input type="submit" name="No" value="No" class="button" style="margin-left:100px"/></span>';
			echo'</form>';
			exit();
		}
	}
	if (  !isset($_SESSION['logged_in'])  || ($_SESSION['logged_in'] == false )  )
	{  	redirect('./css2_sign_in.php'); 
	}
	if ( !isset($_SESSION['busfound']) || $_SESSION['busfound']==false )
	{	redirect('./css2_findbus_script.php'); 
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
	$userid= $_SESSION['userid'];
	$routeid= $_SESSION['routeid'];
	$date= $_SESSION['date'];
	$date = date('d-M-Y', strtotime($date));
	$day = $_SESSION['day'];
	$busid= $_SESSION['busid'];
	$source_city = $_SESSION['source_city'];
	$destination_city = $_SESSION['destination_city'];
	$no_of_seats = isset($_SESSION['no_of_seats'])? $_SESSION['no_of_seats']:0;
	$seat1= isset($_SESSION['seat1'])? $_SESSION['seat1']:0;
	$seat2= isset($_SESSION['seat2'])? $_SESSION['seat2']:0;
	$seat3= isset($_SESSION['seat3'])? $_SESSION['seat3']:0;	
	$select_seatErr='';	
	{	echo "<br><b>DETAILS</b><br>";
		echo "<br><b>From: </b>" . $source_city;
		echo "<span style='margin-left:10px'><b>To: </b>" . $destination_city."</span>";
		echo "<br><b>Departure Date: </b>". $date;
		echo "<br><b>Departure Day: </b>" .$day;
		echo "<br><b>Route ID: </b>" . $routeid;
		echo "<br><b>Bus No.: </b>" . $busid;
		$date = date('Y-m-d', strtotime($date));
		$available_count= find_available_seats( $busid, $date);
		$date = date('d-M-Y', strtotime($date));
		echo "<br><b>Number of available seats: </b>" . $available_count;
			
		$query = "SELECT * FROM schedule WHERE routeid=". $routeid. " and busid=". $busid. " and ". $day ."=1;";
		$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
		echo "<p><br><u><b>SCHEDULE OF BUS NO.". $busid ." ON ". $date. " </b></u><br>";
		echo "<table border='1' cellpadding='5' style='margin-top:10px'>
			  <tr><th>Route ID</th>
			  <th>Bus No.</th>
			  <th>Departure time</th>
			  <th>Arrival time</th>
			  <th>Seats Available</th>
			  </tr>";
		while($row = mysql_fetch_array($result))
		{	echo "<tr style='height:24px'>";
			echo "<td style='height:24px'>" . $row[0] . "</td>";
			echo "<td style='height:24px'>" . $row[1] . "</td>";
			echo "<td style='height:24px'>" . $row[2] . "</td>";
			echo "<td style='height:24px'>" . $row[3] . "</td>";
			echo "<td style='height:24px'>" . $available_count . "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo"<br>";
	}
	if( isset($_POST['next'] ) && $_POST['next']=='Next' )
	{
		$change = check_if_booking_changed($_POST['prev_routeid'], $_POST['prev_busid'], $_POST['prev_date']);
		unset_passenger_variables();
		if ( $change==1 )
		{	unset_seat_variables();	
			echo 'change='.$change;
			redirect('./css2_bookticket1.php');
			exit();
		}
		
		if( empty($_POST['seats_selected']) && $no_of_seats==0) 
		{	$select_seatErr='You did not select any seats.';
			$possible_to_buy= -1;
			$no_of_seats=0;
		} 
		else
		{	$seats_selected = $_POST['seats_selected'];
			$no_of_seats = count($seats_selected);
			if( $no_of_seats>3)
			{	$select_seatErr="Maximum of 3 seats allowed.";
				$possible_to_buy= -1;
			}
			else
			{	$_SESSION['seat1']=0;
				$_SESSION['seat2']=0;
				$_SESSION['seat3']=0;
				for($i=0; $i < $no_of_seats; $i++)
				{	if( $i==0 )
					{	$seat1= $seats_selected[$i];
						$_SESSION['seat1']=$seat1;
					}
					if( $i==1 )
					{	$seat2= $seats_selected[$i];
						$_SESSION['seat2']= $seat2;
					}
					if( $i==2 )
					{	$seat3= $seats_selected[$i];
						$_SESSION['seat3']=$seat3;
					}
				}
				$date = date('Y-m-d', strtotime($date));
				$available_count =find_available_seats( $busid, $date);
				$date = date('d-m-Y', strtotime($date));
				$possible_to_buy = $available_count - $no_of_seats;
				$_SESSION['no_of_seats']= $no_of_seats;
				if( $available_count==0 )
				{	echo "<br><b>Bus is full.</b></br>";
					echo'<a href= "./css2_findbus.php" style="margin-left:30px">Back</a>';
				}
				else if ( $possible_to_buy <0 )
				{	echo "<br><b>Required number of seats are not available.</b>";
					echo'<a href= "./css2_bookticket1.php">back</a>';
				}
			}
			if($possible_to_buy>=0)
			{	unset_passenger_variables();	
				echo 'redir to new';
				redirect("./new.php");
				exit();
			}
		} 
	}
	
	
{	echo '<form method="post" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'>';
			echo "<b>Select seat(s):</b>";
			echo'<span class="error">*'.$select_seatErr.'</span>';
			echo'<br>';
			$seats=get_available_seatno($busid, $date);
		
		$query = "SELECT capacity FROM bus where busid=". $busid.";";
		$result = mysql_query($query) or die("query error". mysql_error());
		$row = mysql_fetch_row($result);
		$capacity = $row[0];
		echo '<p><font size="2" color="blue"> &nbsp&nbsp&nbspfront&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBUS LAYOUT &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsprear</font></p>';
	
		echo'<table border="1" >';
		echo'<tr>';
		echo'<td>';
		
		for($i = 1; $i <= $capacity; $i=$i+1) 
		{	if( in_array( $i, $seats ) )
			{	//echo '<input type="checkbox" style="margin-left:10px" id="' . $i . '" name="seats_selected[]" value="'. $i .'" /><label for="' . $i . '"></label>' ;
				?>
				<input type="checkbox" style="margin-left:10px" id=<?php echo $i;?> name="<?php echo 'seats_selected[]';?>" value=<?php echo $i;?> <?php if ($i==$seat1||$i==$seat2||$i==$seat3){echo "selected='selected'"; }?>" />
				<label for="<?php echo $i;?>"></label>
				<?php
			}
			else
			{	echo '<img src="./images/booked_seat_img.gif" >' ;
				echo'<span style="margin-right:8px"></span>';
			}
			if( $i % 10 == 0)
			echo "<br><br>";
		}
		echo'</td>';
		echo'</tr>';
		echo'</table>';
	
	
			echo'<input type="hidden" name="prev_date" value='.$date.'>';
			echo'<input type="hidden" name="prev_routeid" value='.$routeid.'>';
			echo'<input type="hidden" name="prev_busid" value='.$busid.'>';
	echo'<br><input type="submit" name="next" value="Next" class="button" style="margin-left:420px"/><br><br>';
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



	