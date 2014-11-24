<?php	session_start();
?>
<html>
<head>
	<title>Cancel Ticket</title>
</head>
<body>
<?php
	require_once'redir.php';	
	
	if (  !isset($_SESSION['logged_in'])  || ($_SESSION['logged_in'] == false )  )
	{  	
		echo "Please Sign In";
        echo"<br><a href='./css_sign_in.php'>Login</a>";
		exit();
	}
	$database = "obtrs";
	$server = "localhost";
	$connection = mysql_connect($server);	
	if (!$connection) 
	{	die("Unable to connect to MySQL: " . mysql_error()); 
	}
	$select_db = mysql_select_db("obtrs",$connection) or die("Could not select database");
?>

<?php
	$ticketidErr = '';
	$ticketid = isset($_POST['ticketid']) ? $_POST['ticketid'] : '';
	$error= 0;
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		if (empty($_POST["ticketid"]))
		{	$ticketidErr = "Ticket Number is required";
			$error=1; 
		}
		else if( !preg_match("/^[0-9]{1,20}$/", $_POST["ticketid"])) 
		{	$ticketidErr = "Please use only 0-9.";
			$error=1;
		}
		if( $error==0)
		{	$query = "delete from ticket where ticketid= $ticketid;";
			$result = mysql_query($query, $connection);
			if (!$result)
			{	echo "<br>delete failed<br />" . mysql_error() . "<br /><br />";
				die("Error querying database.". mysql_error() );
			}
			$affected_rows = mysql_affected_rows();
			if( $affected_rows!=0)
			{		echo "<br>ticket deleted.";
			}
			else
			{		echo "<br>no ticket deleted.";
			}
			mysql_close($connection);
			exit();
		}
	}
?>
	
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<!-- div class="field"-->
		<label for="ticketid">Ticket number:</label>
		<input type="text" id="ticketid" name="ticketid">
		<span class="error">*<?php echo $ticketidErr;?></span>
	<!--/div-->
	<br><br>
	<input type="submit" name="cancel" value="cancel" />

</body>
</html>
