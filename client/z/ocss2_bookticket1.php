<?php
	session_start();
	require_once'redir.php';
	require_once 'bookticket_functions.php';
	if( isset($_POST['book'] ) && ($_POST['book']=='Book Ticket' ) )
	{	$_SESSION['bookable']=true;
	}
	if (  !isset($_SESSION['logged_in'])  || ($_SESSION['logged_in'] == false )  )
	{  	redirect('./css2_sign_in.php'); 
	}
	if ( !isset($_SESSION['bookable']) || $_SESSION['bookable']==false )
	{	redirect('./css2_findbus.php');
	}
	require_once './database_connect.php';
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
	$date= isset($_SESSION['date'])?$_SESSION['date']:0;
	$day = isset($_SESSION['day'])?$_SESSION['day']:0;
	$busid= isset($_SESSION['busid'])?$_SESSION['busid']:0;
	$source_city = isset($_SESSION['source_city']) ? $_SESSION['source_city'] : '';
	$destination_city = isset($_SESSION['destination_city']) ? $_SESSION['destination_city'] : '';
	$no_of_seats = isset($_SESSION['no_of_seats'])? $_SESSION['no_of_seats']:0;
	$select_seatErr='';	*/
	
	$userid= $_SESSION['userid'];
	$routeid= $_SESSION['routeid'];
	$date= $_SESSION['date'];
	$date = date('d-M-Y', strtotime($date));
	$day = $_SESSION['day'];
	$busid= $_SESSION['busid'];
	$source_city = $_SESSION['source_city'];
	$destination_city = $_SESSION['destination_city'];
	$no_of_seats = isset($_SESSION['no_of_seats'])? $_SESSION['no_of_seats']:0;
	$select_seatErr='';
	
	{	echo "<br><b>DETAILS</b><br>";
		echo "<br><b>Route: </b>" . $routeid;
		echo "<br><b>Source: </b>" . $source_city;
		echo "<br><b>Destination: </b>" . $destination_city;
		echo "<br><b>Departure Date: </b>". $date;
		echo "<br><b>Departure Day: </b>" .$day;
		echo "<br><b>Bus: </b>" . $busid;
		
		$available_count= find_available_seats( $busid, $date);
		echo "<br><b>No of available seats: </b>" . $available_count;
			
		$query = "SELECT * FROM schedule WHERE routeid=". $routeid. " and busid=". $busid. " and ". $day ."=1;";
		$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
		echo "<p><br><b>SCHEDULE OF BUS ". $busid ." ON ". $date. " </b><br>";
		echo "<table border='1'>
			  <tr><th>Route ID</th>
		      <th>Bus ID</th>
			  <th>Departure time</th>
			  <th>Arrival time</th>
			  <!--th>Departure Day</th-->
			  <th>Seats Available</th>
			  </tr>";
		while($row = mysql_fetch_array($result))
		{	echo "<tr>";
			echo "<td>" . $row[0] . "</td>";
			echo "<td>" . $row[1] . "</td>";
			echo "<td>" . $row[2] . "</td>";
			echo "<td>" . $row[3] . "</td>";
			//echo "<td>" . $day . "</td>";
			echo "<td>" . $available_count . "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo"<br><br>";
	}
	
	//if( isset($_POST['buy_ticket'] ) && $_POST['buy_ticket']=='Buy Ticket' )
	if( isset($_POST['next'] ) && $_POST['next']=='Next' )
	{	
		if( empty($_POST['seats_selected']) && $no_of_seats==0) 
		{	$select_seatErr='You did not select any seats.';
			$possible_to_buy= -1;
			$_SESSION['possible_to_buy']= $possible_to_buy;
			$no_of_seats=0;
		} 
		else
		{	$seats_selected = $_POST['seats_selected'];
			$no_of_seats = count($seats_selected);
			$_SESSION['seat1']=0;
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
			if( $no_of_seats>3)
			{	$select_seatErr="Maximum of 3 seats allowed.";
				$possible_to_buy= -1;
				$_SESSION['possible_to_buy']= $possible_to_buy;
			}
			else
			{	
				$available_count =find_available_seats( $busid, $date);
				//echo "<br><b>No of available seats: </b>" . $available_count;
				$possible_to_buy = $available_count - $no_of_seats;
				$_SESSION['possible_to_buy']= $possible_to_buy;
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
			{	//echo "<br><b>make ticket<br>";
				//redirect("./css2_bookticket2.php");
				redirect("./new2.php");
			}
		}
	}
	
	{	echo '<form method="post" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'>';
		echo "<br><b>Select seat(s):</b>";
		echo'<span class="error">*'.$select_seatErr.'</span>';
		echo'<br>';
		$seats=get_available_seatno($busid, $date);
		for($i=0; $i < count($seats); $i++)
		{	$x= $seats[$i];
			echo '<input type="checkbox" style="margin-left:30px" name="seats_selected[]" value=" '. $x .'" />'. "Seat Number ". $x ."<br>";
		}
		//echo'<input type="submit" name="buy_ticket" value="Buy Ticket" class="button" style="margin-left:200px"/>';
		echo'<input type="submit" name="next" value="Next" class="button" style="margin-left:200px"/>';
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



	