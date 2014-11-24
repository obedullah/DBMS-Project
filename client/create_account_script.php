<?php
	require 'create_account_functions.php';
	require_once './database_connect.php';
	$first_nameErr = $last_nameErr = $dobErr= $email_idErr = $genderErr = $password1Err = $password2Err = '';
	$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
	$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
	$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
	$email_id = isset($_POST['email_id']) ? $_POST['email_id'] : '';
	$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
	$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
	$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
	
	//if ($_SERVER["REQUEST_METHOD"] == "POST")
	if( isset($_POST['signup'] ) && ($_POST['signup']=="Create Account" ) )
	{
		$error= validate_signup_form();
		if( $error==0 )
		{	
			$first_name = format_input ( $_POST['first_name'] );
			$last_name = format_input( $_POST['last_name'] );
			$email_id = format_input( $_POST['email_id'] );
			$gender = format_input( $_POST['gender'] );
				
			echo "<b>Name: </b>" . $first_name ." ". $last_name ."<br>";
			echo "<b>Email ID: </b>" . $email_id . "<br>";
			echo "<b>Gender: </b>" . $gender . "<br>";
					
			if( find_user($email_id) !=0 )
			{	echo("<b>Your account already exists.</b>");
				echo "<br><br><b><a href='./css2_sign_in.php'>Sign In</a></b>";
			}
			else
			{	$password = md5($password1);
				$query = "INSERT INTO user(first_name, last_name, email_id, password, gender, dob) VALUES ('$first_name', '$last_name', '$email_id', '$password', '$gender','$dob');";
				$result = mysql_query($query, $db_connection);
				if (!$result)
				{	echo "<br>INSERT failed<br />" . mysql_error() . "<br /><br />";
					die("Error querying database.". mysql_error() );
				}
				else
				{	echo "<b>Account successfully created.</b>";
					echo "<br><br><b><a href='./css2_sign_in.php'>Sign In</a></b>";
				}
//				$affected_rows = mysql_affected_rows();
				//echo "affected rows: " . $affected_rows;
			}
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
			exit();
		}
	}
?>