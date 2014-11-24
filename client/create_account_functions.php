<?php

	
	function validate_signup_form()
	{	$error_found = 0;
		global $first_nameErr, $dobErr, $last_nameErr, $email_idErr, $genderErr, $password1Err, $password2Err;
		if (empty($_POST["first_name"]))
		{	$first_nameErr = "First Name is required";
			$error_found=1; 
		}
		else if( !preg_match("/^[a-zA-Z]{1,20}$/", $_POST["first_name"])) 
		{	$first_nameErr = "Please use only letters. Maximum 20 letters allowed.";
			$error_found=1;
		}
		if (empty($_POST["last_name"]))
		{	$last_nameErr = "Last Name is required";
			$error_found=1; 
		} 
		else if( !preg_match("/^[a-zA-Z]{1,20}$/", $_POST["last_name"])) 
		{	$last_nameErr = "Please use only letters. Maximum 20 letters allowed.";
			$error_found=1;
		}
		if ( empty($_POST["dob"]))
		{	$dobErr = "Date of Birth is required";
			$error_found=1; 
		} 
		if (empty($_POST["email_id"]))
		{	$email_idErr = "Email is required";
			$error_found=1;
		}
		if (empty($_POST["gender"]))
		{	$genderErr = "Gender is required";
			$error_found=1;
		}
		if (empty($_POST["password1"]))
		{	$password1Err = "Password is required";
			$error_found=1;
		}
		if (empty($_POST["password2"]))
		{	$password2Err = "Re-enter password.";
			$error_found=1;
		}
		if( strlen($_POST["password1"])<8 )
		{	$password1Err = "Minimum length is 8.";
			$error_found=1;
		}
		else if( !preg_match("/^[a-zA-Z0-9.]{8,20}$/", $_POST["password1"], $matches)) 
		{	$password1Err = "Please use only letters, 0-9 and period.";
			$error_found=1;
		}
		if ($_POST['password1'] != $_POST['password2'])
        {	$password2Err = "Passwords do not match.";
			$error_found=1;
		}
		return $error_found;
	}
	
	function format_input($data)
	{	$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function find_user( $email_id )
	{	$result = mysql_query("select find_if_exists('$email_id')");
		if($result == FALSE)
		{	die(mysql_error()); 
		}
		$row = mysql_fetch_row($result);
		$returnValue = $row[0];
		//echo "result of function: " . $returnValue;
		return $returnValue;
	}
	
?>