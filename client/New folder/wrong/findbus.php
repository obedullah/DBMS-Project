<?php
session_start();
?>
<html>
<head>
	<title>Find Bus</title>
</head>
<body>
<?php require 'findbus_script2.php';?>
	<?php
		$database = "obtrs";
		$server = "localhost";
		$connection = mysql_connect($server);	
		if (!$connection) 
		{	die("Unable to connect to MySQL: " . mysql_error()); 
		}
		$select_db = mysql_select_db("obtrs",$connection) or die("Could not select database");
		$query1 = "SELECT DISTINCT source FROM route;";
		$result1 = mysql_query($query1, $connection) or die("query error". mysql_error());
		$query2 = "SELECT DISTINCT destination FROM route;";
		$result2 = mysql_query($query2, $connection) or die("query error". mysql_error());
	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<label for="source_city">Enter source:</label>
	<select required name="source_city" >
		<option style="display:none;" disabled="disabled"  <?php if ($source_city=="") {echo "selected='selected'"; }?> > Choose source city </option>
		<?php  
			while($row = mysql_fetch_array($result1))
			{	$city = $row["source"];
				echo '<option value='. $city .'>'.$city.'</option>';
			}
		?>
	</select>
	<span class="error">* <?php echo $source_cityErr;?></span>
	<br><br>
	
	<label for="destination_city">Enter destination:</label>
	<select required name="destination_city" >
		<option style="display:none;" disabled="disabled"  <?php if ($destination_city=="") {echo "selected='selected'"; }?> > Choose destination city </option>
		<?php  
			while($row = mysql_fetch_array($result2))
			{	$city=$row["destination"];
				echo '<option value='. $city. '>'.$city.'</option>';
			}
		?>
	</select>
	<span class="error">* <?php echo $destination_cityErr;?></span>
	<br><br>
	
	Date of departure: 
	<input type="date" id="date" name="date" value= "<?php print $date ?>" />
	<span class="error">* <?php echo $dateErr;?></span>
	<br><br>
	
	<input type="submit" name="Submit" value="Submit" />
	<?php 
		mysql_close($connection);
		exit();
	?>
</body>
</html>
