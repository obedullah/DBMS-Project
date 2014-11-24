<?php	session_start();
?>
<html>
<head>
	<title>Book Ticket</title>
</head>
<body>
<?php
	require_once'redir.php';
	require_once 'book3.php';

	
	if( isset($_POST['book'] ) && ($_POST['book']=='book' ) )
	{	$busid= $_POST['busid'];
		$_SESSION['busid']=$busid;
		if (  !isset($_SESSION['logged_in'])  || ($_SESSION['logged_in'] == false )  )
		{  	//echo "Through book button.";
			echo "Please Sign In";
			echo"<br><a href=\"http://localhost:8080/f1/css_create_account.php\">Create Account</a>";
            echo"<br><a href=\"http://localhost:8080/f1/sign_in.php\">Login</a>";
			exit(); 
		}
	}
	else if( !( isset($_POST['submit1'] ) && $_POST['submit1']=='submit1' ) )
	{	
		//echo "Not through book button";
		if (  !isset($_SESSION['logged_in'])  || ($_SESSION['logged_in'] ==false )  )
		{	echo "Please Sign In";
			echo"<br><a href=\"http://localhost:8080/f1/css_create_account.php\">Create Account</a>";
			echo"<br><a href=\"http://localhost:8080/f1/sign_in.php\">Login</a>";
			exit();
		}
		else
		{	redirect('./2findbus.php'); 
		}
	}
?>
<?php
		$database = "obtrs";
		$server = "localhost";
		$connection = mysql_connect($server);	
		if (!$connection) 
		{	die("Unable to connect to MySQL: " . mysql_error()); 
		}
		$select_db = mysql_select_db("obtrs",$connection) or die("Could not select database");
?>	
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	Number of seats:
	<select required name="no_of_seats" >
			<option style="display:none;" disabled="disabled"  <?php if ($no_of_seats=="") {echo "selected='selected'"; }?> > Number of seats </option>
 			<option value=1 <?php if ($no_of_seats==1) {echo "selected='selected'"; }?> >1</option>
			<option value=2 <?php if ($no_of_seats==2) {echo "selected='selected'"; }?> >2</option>
			<option value=3 <?php if ($no_of_seats==3) {echo "selected='selected'"; }?> >3</option>
	</select>
	<span class="error">* <?php echo $no_of_seatsErr;?></span>
	<br><br>
	<input type="submit" name="submit1" value="submit1" />
	<?php 
		mysql_close($connection);
		exit();
	?>
</body>
</html>
