<?php
	function send_ticket_mail()
	{	
		   $to = "surbhiagg964@gmail.com";
		   $subject = "Ticket Booked";
		   $message = "Your ticket has been booked. To view ticket log in.";
		   $header = "From:voss.india@gmail.com \r\n";
		   $retval = mail ($to,$subject,$message,$header);
		   if( $retval == true )  
		   {
			  echo "<br><b>Mail sent successfully.";
			  $sent=1;
		   }
		   else
		   {
			  echo "Mail could not be sent.";
			  $sent=0;
		   }
		   return $sent;
	}
	
	function check_if_booking_changed($routeid, $busid, $date)
	{	if ( $routeid!= $_SESSION['routeid'] || $busid!=$_SESSION['busid']|| $date!=$_SESSION['date'])
		{		return 1;
		}
		else
			return 0;
	}
	
	function check_if_seats_changed($no_of_seats, $seat1, $seat2,$seat3)
	{
		if( $no_of_seats!=$_SESSION['no_of_seats'] || $seat1!=$_SESSION['seat1'] || $seat2!= $_SESSION['seat2'] || $seat3!=$_SESSION['seat3'] )
			return 1;
		else
			return 0;
	}
	
	function unset_seat_variables()
	{	
		if( isset ($_SESSION['no_of_seats']))
		{	unset($_SESSION['no_of_seats']);
		}
		if( isset ($_SESSION['seat1']))		
		{unset($_SESSION['seat1']);
		}
		if( isset ($_SESSION['seat2']))		
		{unset($_SESSION['seat2']);
		}
		if( isset ($_SESSION['seat3']))		
		{unset($_SESSION['seat3']);
		}
		if( isset ($_SESSION['passenger1']))		
		{unset($_SESSION['passenger1']);
		}
		if( isset ($_SESSION['passenger2']))		
		{unset($_SESSION['passenger2']);
		}
		if( isset ($_SESSION['passenger3']))		
		{unset($_SESSION['passenger3']);
		}
	}
	function unset_passenger_variables()
	{	
		if( isset ($_SESSION['passenger1']))		
		{unset($_SESSION['passenger1']);
		}
		if( isset ($_SESSION['passenger2']))		
		{unset($_SESSION['passenger2']);
		}
		if( isset ($_SESSION['passenger3']))		
		{unset($_SESSION['passenger3']);
		}
	}
	
	function unset_all_variables()
	{	unset($_SESSION['routeid']);
		unset($_SESSION['busid']);
		unset($_SESSION['date']);
		unset($_SESSION['source_city']);
		unset($_SESSION['destination_city']);
		//unset($_SESSION['bookable']);
		//unset($_SESSION['possible_to_buy']);
		unset($_SESSION['busfound']);
		
		unset($_SESSION['no_of_seats']);
		unset($_SESSION['day']);
		unset($_SESSION['seat1']);
		unset($_SESSION['seat2']);
		unset($_SESSION['seat3']);
		unset($_SESSION['passenger1']);
		unset($_SESSION['passenger2']);
		unset($_SESSION['passenger3']);
	}
	
	function validate_passenger_form()
	{	$error_found = 0;
		global $passenger1Err, $passenger2Err, $passenger3Err;
		$no_of_seats = $_SESSION['no_of_seats'];
		if ($no_of_seats>=1)
		{	if( empty($_POST["passenger1"]) )
			{	$passenger1Err= "Enter Passenger's Name";
				$error_found=1;
			}
			else if( !preg_match("/^[a-zA-Z]{1,20}$/", $_POST["passenger1"])) 
			{	$passenger1Err = "Please use only letters. Maximum 20 letters allowed.";
				$error_found=1;
			}
		}
		if ($no_of_seats>=2)
		{	if( empty($_POST["passenger2"]) )
			{	$passenger2Err= "Enter Passenger's Name";
				$error_found=1;
			}
			else if( !preg_match("/^[a-zA-Z]{1,20}$/", $_POST["passenger2"])) 
			{	$passenger2Err = "Please use only letters. Maximum 20 letters allowed.";
				$error_found=1;
			}
		}
		if ($no_of_seats==3)
		{	if( empty($_POST["passenger3"]) )
			{	$passenger3Err= "Enter Passenger's Name";
				$error_found=1;
			}
			else if( !preg_match("/^[a-zA-Z]{1,20}$/", $_POST["passenger3"])) 
			{	$passenger3Err = "Please use only letters. Maximum 20 letters allowed.";
				$error_found=1;
			}
		}
		return $error_found;
	}
	
	function new_validate_bookticket_form()
	{	$error_found = 0;
		global $userErr, $no_of_seatsErr;
		if (empty($_POST["no_of_seats"]))
		{	$no_of_seatsErr = "No.of seats is required";
			$error_found=1; 
		} 
		return $error_found;
	}
	
	
	function find_available_seats( $busid, $date )
	{	$result = mysql_query("select count_available_seats($busid, '$date' )") or die("query error". mysql_error());;
		$row = mysql_fetch_row($result);
		$available_seats = $row[0];
		return $available_seats;
	}
	
	function get_available_seatno($busid, $date)
	{	
		$date = date('Y-m-d', strtotime($date));
		$query = "SELECT seat1,seat2,seat3 FROM ticket where busid=". $busid. " and departuredate = '". $date ."';";
		$result = mysql_query($query) or die("query error". mysql_error());
		$not_available_array = array();
		while($row = mysql_fetch_array($result))
		{	$seat1 = $row["seat1"];
			$seat2 = $row["seat2"];
			$seat3 = $row["seat3"];
			//echo "<br>". $seat1 ."    ". $seat2. "     ".$seat3;
			$not_available_array[]= $seat1;
			$not_available_array[]= $seat2;
			$not_available_array[]= $seat3;
		}
		//$size_of_array=count($not_available_array);
		//echo "<br>Size of array  is: ". $size_of_array;
		foreach ($not_available_array as $i )
		{		//echo "Booked seat: ".$i."<br>";
		}
		$query = "SELECT capacity FROM bus where busid=". $busid.";";
		$result = mysql_query($query) or die("query error". mysql_error());
		$row = mysql_fetch_row($result);
		$capacity = $row[0];
		//echo "<br>Capacity: ".$capacity."<br>";
		$seatlist = array();
		for($i = 1; $i <= $capacity; $i=$i+1) 
		{	if( in_array( $i, $not_available_array ) )
			{	//echo "<t>Seat is booked. ". $i."<br>";
			}
			else
			{	$seatlist[]= $i;
			}
		}
		foreach ($seatlist as $i )
		{		//echo "Available seat: ".$i."<br>";
		}
		return $seatlist;
	}
	function calculate_amount( $busid,$no_of_seats)
	{	$query = "SELECT fare FROM bus where busid=". $busid.";";
		$result = mysql_query($query) or die("query error". mysql_error());
		$row = mysql_fetch_row($result);
		$fare = $row[0];
		echo "<br><b>Base Fare of Bus: </b>₹".$fare;
		echo "<br><b>Fare per kilometer: </b> ₹5";
		$query = "SELECT distance FROM route where routeid=". $_SESSION['routeid'].";";
		$result = mysql_query($query) or die("query error". mysql_error());
		$row = mysql_fetch_row($result);
		$distance = $row[0];
		echo "<br><b>Distance:</b>".$distance;
		
		$amount = ( $fare + ( 5 * $distance ) )* ($no_of_seats);
		echo "<br><b>Amount: </b>₹".$amount."<br>";
		return $amount;
	}
	function insert_ticket( $userid, $busid, $date, $no_of_seats, $seat1, $seat2, $seat3,$passenger1,$passenger2,$passenger3,$amount)
	{
		$today = date('Y-m-d H:i:s');
		$date = date('Y-m-d', strtotime($date));
		$query= "INSERT INTO ticket(userid,busid,departuredate,no_of_seats,seat1,seat2,seat3,passenger1,passenger2,passenger3,amount,bookingdate) 
		VALUES ( '$userid', '$busid', '$date', '$no_of_seats', '$seat1', '$seat2', '$seat3', '$passenger1','$passenger2','$passenger3','$amount','$today');";
		$result = mysql_query($query);
		if (!$result)
		{	echo "<br>INSERT failed<br />" . mysql_error() . "<br /><br />";
			die("Error querying database.". mysql_error() );
		}
		$affected_rows = mysql_affected_rows();
		//echo "affected rows: " . $affected_rows;
		return $affected_rows;
		return 1;
	}
?>