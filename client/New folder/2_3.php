<?php	
	session_start();
	require_once 'bookticket_functions.php';
?>

<?php
	$userid= $_SESSION['userid'];
	$routeid= $_SESSION['routeid'];
	$busid= $_SESSION['busid'];
	$date =$_SESSION['date'];
	$no_of_seats= $_SESSION['no_of_seats'];
	$day=$_SESSION['day'];
	$seat1=0;
	$seat2=0;
	$seat3=0;
	$database = "obtrs";
	$server = "localhost";
	$connection = mysql_connect($server);	
	if (!$connection) 
	{	die("Unable to connect to MySQL: " . mysql_error()); 
	}
	$select_db = mysql_select_db("obtrs",$connection) or die("Could not select database");
	if( isset($_POST['submit2'] ) && $_POST['submit2']=='submit2' )
	{	echo "<br><b>Details</b>";
		echo "<br><b>Userid:</b>" . $userid;
		echo "<br><b>Route:</b>" . $routeid;
		echo "<br><b>Bus:</b>" . $busid;
		echo "<br><b>Date: </b>". $date;	
		echo "<br><b>Day:</b>" .$day;
		$seats_selected = $_POST['seats_selected'];
		if(empty($seats_selected)) 
		{echo("<br>You didn't select any seats.");
		 	echo'<a href= "2_2.php">back</a>';
		} 
		else
		{	$N = count($seats_selected);
			echo("<br>You selected $N seat(s): ");
			for($i=0; $i < $N; $i++)
			{	echo("<br><t>Ordered Seat Number ". $seats_selected[$i] . " ");
				if( $i==0 )
				{	$seat1= $seats_selected[$i];
				}
				if( $i==1 )
				{	$seat2= $seats_selected[$i];
				}
				if( $i==2 )
				{	$seat3= $seats_selected[$i];
				}
			}
			if( $N == $no_of_seats)
			{	echo"<br>Making Ticket.";
				$amount = calculate_amount( $busid,$no_of_seats);
				$insert=insert_ticket( $userid, $busid, $date, $no_of_seats, $seat1, $seat2, $seat3,$amount);
				if( $insert==1)
				{	echo "<br><b>Ticket made";
				}
				else
				{	echo "<br><b>Error in making ticket";
					echo'<a href= "2_1.php">back</a>';
				}
			}
			else
			{	echo "<br>Number of seats requested and no of seats selected dont match";
				echo'<br><a href= "2_1.php">back</a>';
			}
		}
		exit();
	}
?>