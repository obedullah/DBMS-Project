<?php
	session_start();
	require_once'redir.php';
	require_once 'bookticket_functions.php';
	if (  !isset($_SESSION['logged_in'])  || ($_SESSION['logged_in'] == false )  )
	{  	redirect('./css2_sign_in.php'); 
	}
	if( isset($_POST['book'] ) && ($_POST['book']=='book' ) )
	{	$_SESSION['busid']= $_POST['busid'];	
		$_SESSION['bookable']=true;
	}
	if ( !isset($_SESSION['bookable']) || $_SESSION['bookable']==false )
	{	redirect('./css2_findbus.php');
	}
	
	$database = "obtrs";
	$server = "localhost";
	$db_connection = mysql_connect($server);				
	if (!$db_connection) 
	{	die("Unable to connect to MySQL: " . mysql_error()); 
	}
	$db_found = mysql_select_db($database);
	if (!$db_found)
	{	die("Unable to connect to MySQL: " . mysql_error());
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
                 <li><a href="">Cancel Ticket</a></li>
                 <li><a href="">Cancelled Buses</a></li>
                 <li><a href="">Complaints</a></li>
                </ul>
        </div>
  	
	<div class="content">
<?php
	$userid= isset($_SESSION['userid'])? $_SESSION['userid']:0;
	$routeid= isset($_SESSION['routeid'])?$_SESSION['routeid']:0;
	$date= isset($_SESSION['date'])?$_SESSION['date']:0;
	$day = isset($_SESSION['day'])?$_SESSION['day']:0;
	$no_of_seats = isset($_SESSION['no_of_seats'])? $_SESSION['no_of_seats']:0;
	$busid= isset($_SESSION['busid'])?$_SESSION['busid']:0;
	if( !isset($_SESSION['day']) )
	{	$timestamp= strtotime($date);
		$day = date("l", $timestamp);
		$_SESSION['day']= $day;
	}
	$select_seatErr='';
	
	if( isset($_POST['submit2'] ) && $_POST['submit2']=='submit2' )
	{	if( empty($_POST['seats_selected'])) 
		{	$select_seatErr='You did not select any seats.';
			$possible_to_buy= -1;
			$_SESSION['possible_to_buy']= $possible_to_buy;
			$no_of_seats=0;
		} 
		else
		{	$seats_selected = $_POST['seats_selected'];
			$no_of_seats = count($seats_selected);
			//echo("<br><br><b>You selected $no_of_seats seat(s).</b>");
			$_SESSION['seat1']=0;
			$_SESSION['seat2']=0;
			$_SESSION['seat3']=0;
			for($i=0; $i < $no_of_seats; $i++)
			{	//echo("<br><b>Ordered Seat Number:</b> ". $seats_selected[$i] . " ");
				if( $i==0 )
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
			//echo"<br>";
			if( $no_of_seats>3)
			{	//$select_seatErr="Number of seats requested and no of seats selected dont match.";
				$select_seatErr="Maximum of 3 seats allowed.";
				$possible_to_buy= -1;
				$_SESSION['possible_to_buy']= $possible_to_buy;
			}
			else
			{	
				$available_count =find_available_seats( $busid, $date);
				echo "<br><b>No of available seats: </b>" . $available_count;
				echo "<br><b>$no of seats: </b>" . $no_of_seats;
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
			{	//echo "<br><b>go and make ticket<br>";
				redirect("./css2_bookticket2.php");
			}
		}
		echo "<br><b>no of seats: </b>" . $no_of_seats;
	}
	
	//if( isset($_POST['submit1'] ) && $_POST['submit1']=='submit1')
	{	echo "<br><b>DETAILS</b><br>";
		echo "<br><b>Route: </b>" . $routeid;
		echo "<br><b>Bus: </b>" . $busid;
		echo "<br><b>Departure Date: </b>". $date;
		echo "<br><b>Departure Day: </b>" .$day;
		
		
		$available_count= find_available_seats( $busid, $date);
		echo "<br><b>No of available seats: </b>" . $available_count;
			
		$query = "SELECT * FROM schedule WHERE routeid=". $routeid. " and busid=". $busid. " and ". $day ."=1;";
		$result = mysql_query($query, $db_connection) or die("query error". mysql_error());
		echo "<p><br><b>SCHEDULE OF BUS ". $busid ." ON ". $date. " </b><br>";
		echo "<table border='1'>
			  <tr><th>Routeid</th>
		      <th>Busid</th>
			  <th>Departure time</th>
			  <th>Arrival time</th>
			  <th>Departure Day</th>
			  <th>Seats Available</th>
			  </tr>";
		while($row = mysql_fetch_array($result))
		{	echo "<tr>";
			echo "<td>" . $row[0] . "</td>";
			echo "<td>" . $row[1] . "</td>";
			echo "<td>" . $row[2] . "</td>";
			echo "<td>" . $row[3] . "</td>";
			echo "<td>" . $day . "</td>";
			echo "<td>" . $available_count . "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo"<br><br>";
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
		echo'<input type="submit" name="submit2" value="submit2" class="button" style="margin-left:200px"/>';
		echo'</form>';
	}
?>	
	</div>
  </div>
  </div>
  
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</body>
</html>



	