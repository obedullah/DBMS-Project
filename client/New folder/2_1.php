<?php	session_start();
?>
<html>
<head>
	<title>Book Ticket</title>
</head>
<body>
<?php
	require_once'redir.php';
	require_once '2_2.php';
	if( isset($_POST['book'] ) && ($_POST['book']=='book' ) )
	{	$busid= $_POST['busid'];
		//echo "1st catch bus=".$busid;
		$_SESSION['busid']=$busid;
	}
	else if( !( isset($_POST['submit1'] ) && $_POST['submit1']=='submit1' ) )
	{	session_unset();
		redirect('./2findbus.php'); 
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
		$query3 = "SELECT userid FROM user;";
		$result3 = mysql_query($query3, $connection) or die("query error". mysql_error());
?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<label for="user">Enter userid:</label>
	<select required name="userid" >
		<option style="display:none;" disabled="disabled"  <?php if ($userid=="") {echo "selected='selected'"; }?> > Choose userid </option>
		<?php  
			while($row = mysql_fetch_array($result3))
			{	$user_choice = $row["userid"];
				echo '<option value='. $user_choice .'>'.$user_choice.'</option>';
			}
		?>
	</select>
	<span class="error">* <?php echo $useridErr;?></span>
	<br><br>
	
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
