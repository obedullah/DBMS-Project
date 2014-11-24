<?php
	require_once 'sign_in_functions.php';
	require_once 'redir.php';
	require_once './database_connect.php';
	$email_id = isset($_POST['email_id']) ? $_POST['email_id'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	//if ($_SERVER["REQUEST_METHOD"] == "POST")
	if( isset($_POST['sign_in'] ) && ($_POST['sign_in']=='Sign In' ) )
	{	
		$error= validate_login_form();
		if( $error==0 )
		{	
			 $_SESSION['logged_in'] = true;
			 $_SESSION['email_id']= $email_id;
			 $query = "SELECT userid FROM user WHERE email_id = '".$email_id."'"; 
			 $result = mysql_query($query, $db_connection) or die("Error querying database.". mysql_error() );
			 $row = mysql_fetch_array($result);
			 $userid = $row['userid'];
			 $_SESSION['userid']= $userid;
			 
			 $query2 = "SELECT first_name, last_name, type FROM user WHERE email_id = '".$email_id."'"; 
			 $result2 = mysql_query($query2, $db_connection) or die("Error querying database.". mysql_error() );
			 $row2 = mysql_fetch_array($result2);
			 $name= $row2["first_name"];
			 $name = ucfirst($name); 
			 $lastname= ucfirst($row2["last_name"]);
			 $type= $row2["type"];
			 $_SESSION['name']= $name;
			 $_SESSION['type']= $type;
			 $_SESSION['lastname']= $lastname;
			 
					 
			if( $_SESSION['type']=='admin')
			{	redirect('../admin/adminindex.php');
				exit();
			}
			else
			{	
				if ( isset($_SESSION['busfound']) && $_SESSION['busfound']==true )
				{	redirect('./css2_bookticket1.php');
				}
				else
				{	redirect('./css2_findbus.php');
				}
			}
		}
	}
?>