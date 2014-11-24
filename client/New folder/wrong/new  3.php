<html>
<head>
	<title>Find Bus</title>
</head>
<body>
	<?php
		$database = "obtrs";
		$server = "localhost";
		$connection = mysql_connect($server);	
		if (!$connection) 
		{	die("Unable to connect to MySQL: " . mysql_error()); 
		}
		else
		{	echo "connected";
		}
		$select_db = mysql_select_db("obtrs",$connection) or die("Could not select database");
		$query1 = "SELECT DISTINCT source FROM route;";
		$result1 = mysql_query($query, $connection) or die("query error". mysql_error());
		$query2 = "SELECT DISTINCT destination FROM route;";
		$result2 = mysql_query($query, $connection) or die("query error". mysql_error());
	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<label for="source city">Enter source:</label>
	<select required name="source_city" >
		<option style="display:none;" disabled="disabled"  <?php if ($source_city=="") {echo "selected='selected'"; }?> > Choose source city </option>
		<?php  
			while($row = mysql_fetch_array($result1))
			{	$city_name=$row["source"];
				echo '<option value= "$source_city">'.$source_city.'</option>';
			}
		?>
	</select>
	<span class="error">* <?php echo $source_cityErr;?></span>
	<br><br>
	
	<label for="destination city">Enter dsetination:</label>
	<select required name="destination_city" >
		<option style="display:none;" disabled="disabled"  <?php if ($destination_city=="") {echo "selected='selected'"; }?> > Choose destination city </option>
		<?php  
			while($row = mysql_fetch_array($result2))
			{	$destination_city=$row["destination"];
				echo '<option value= "$destination_city">'.$destination_city.'</option>';
			}
		?>
	</select>
	<span class="error">* <?php echo $destination_cityErr;?></span>
	<br><br>
	<?php 
		mysql_close($connection);
		exit();
	?>
</body>
</html>
