<?php
	function validate_findbus_form()
	{	$error_found = 0;
		global $source_cityErr, $destination_cityErr, $dateErr;
		if (empty($_POST["source_city"]))
		{	$source_cityErr = "Source City is required";
			$error_found=1; 
		}
		if (empty($_POST["destination_city"]))
		{	$destination_cityErr = "Destination City is required";
			$error_found=1; 
		} 
		if (empty($_POST["date"]))
		{	$dateErr = "Date is required";
			$error_found=1; 
		} 
		return $error_found;
	}
?>
<?php

	function unset_findbus_variables()
	{
		if( isset ($_SESSION['routeid']) )
		{	unset($_SESSION['routeid']);
		}
		if( isset ($_SESSION['busid']) )
		{	unset($_SESSION['busid']);
		}
		if( isset ($_SESSION['busfound']) )
		{	unset($_SESSION['busfound']);
		}
		if( isset ($_SESSION['no_of_seats']) )
		{unset($_SESSION['no_of_seats']);
		}
		if( isset ($_SESSION['seat1']) )
		{unset($_SESSION['seat1']);
		}
		if( isset ($_SESSION['seat2']) )
		{unset($_SESSION['seat2']);
		}
		if( isset ($_SESSION['seat3']) )
		{unset($_SESSION['seat3']);
		}
		if( isset ($_SESSION['passenger1']) )
		{	unset($_SESSION['passenger1']);
		}
		if( isset ($_SESSION['passenger2']) )
		{	unset($_SESSION['passenger2']);
		}
		if( isset ($_SESSION['passenger3']) )
		{	unset($_SESSION['passenger3']);
		}
	}
?>