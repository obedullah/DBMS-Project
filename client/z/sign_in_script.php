<?php
	require_once 'sign_in_functions.php';
	require_once 'redir.php';
	$email_id = isset($_POST['email_id']) ? $_POST['email_id'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		$error= validate_login_form();
		if( $error==0 )
		{	$database = "obtrs";
			$server = "localhost";
			$db_connection = mysql_connect($server);
			if (!$db_connection) 
			{	die("Unable to connect to MySQL: " . mysql_error()); 
			}
			$db_found = mysql_select_db($database);
			if (!$db_found)
			{	die("Unable to connect to MySQL: " . mysql_error());
			}
			else
			{	$email_id = format_input( $_POST['email_id'] );					
				if( find_user($email_id) == 0 )
				{	die("<h2>Your account doesnt exists.</h2>");
				}				
				$encoded_password = md5($password);
				$query = "SELECT password FROM user WHERE email_id = '".$email_id."'"; 
				$result = mysql_query($query, $db_connection);
				if (!$result)
				{	die("Error querying database.". mysql_error() );
				}
				else
				{	$row = mysql_fetch_row($result);
					$resultValue = $row[0];
					$compare = strcmp( $resultValue, $encoded_password );
					if (  $compare != 0 )
					{	die( "Incorrect password." );
					}
					else if(  $compare == 0 )
					{	 //echo "Logged In.";
						 $_SESSION['logged_in'] = true;
						 $_SESSION['email_id']= $email_id;
						 $query = "SELECT userid FROM user WHERE email_id = '".$email_id."'"; 
						 $result = mysql_query($query, $db_connection) or die("Error querying database.". mysql_error() );
						 $row = mysql_fetch_array($result);
						 $userid = $row['userid'];
						 $_SESSION['userid']= $userid;
						 
						 $query2 = "SELECT first_name, last_name FROM user WHERE email_id = '".$email_id."'"; 
						 $result2 = mysql_query($query2, $db_connection) or die("Error querying database.". mysql_error() );
						 $row2 = mysql_fetch_array($result2);
						 //$name = $row2["first_name"]. ' ' . $row2["last_name"];
						 $name= $row2["first_name"];
						 $name = ucfirst($name); 
						 $_SESSION['name']= $name;
						 //redirect('./useraccount.php');
						redirect('./css_useraccount.php');
						
					}
				}
				mysql_close($db_connection);
				exit();
			}
		}
	}
?>