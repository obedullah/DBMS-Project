<?php
	$email_idErr = $passwordErr = '';
	
	function validate_login_form()
	{	$error_found = 0;
		global  $email_idErr,  $passwordErr;
		
		if (empty($_POST["email_id"]))
		{	$email_idErr = "Email is required";
			$error_found=1;
		}
		if (empty($_POST["password"]))
		{	$passwordErr = "Password is required";
			$error_found=1;
		}
		if($error_found==0)
		{	require './database_connect.php';
			$email_id = format_input( $_POST['email_id'] );
			if( find_user($email_id) == 0 )
			{	echo"<h2>Your account does not exist</h2>";
				echo'<br><b><u><a style="margin-left:40px" href="./css2_create_account.php">Create an account</a></u></b>';
				echo'</div>';
				echo'</div>';
				echo'</div>';
				echo'</div>';
				echo'<div class="footer">';
				echo'<p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>';
				echo'</div>';
				echo'</div>';
				echo'</body>';
				echo'</html>';
			}
			$password=$_POST["password"];
			$encoded_password = md5($password);
			$query = "SELECT password FROM user WHERE email_id = '".$email_id."'"; 
			$result = mysql_query($query, $db_connection) or die("Error querying database.". mysql_error() );
			$row = mysql_fetch_row($result);
			$resultValue = $row[0];
			$compare = strcmp( $resultValue, $encoded_password );
			if (  $compare != 0 )
			{	//echo"Incorrect password.";
				$passwordErr = "Incorrect password";
				$error_found=1;
			}
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
		//echo "<br>User Found: " . $returnValue;
		return $returnValue;
	}
	
?>