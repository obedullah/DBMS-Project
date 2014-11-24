<?php
session_start();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FIND BUS CSS</title>
<link href="css/edit1.css" rel="stylesheet" type="text/css" />
</head>

<body>

  <div class="container">
  
		<div class="header"><a href="#"><img src="images/bus.jpg" alt="VOSS TRAVELS" name="Insert_logo" width="113" height="113" id="Insert_logo" style="background-color:#09C; display:block;" /></a> 
  </div>
  
  <div class="sidebar1">
    <ul class="nav">  
      <li><a href="http://localhost:8080/f1/css_create_account.php">Create Account</a></li>
         <li><a href="http://localhost:8080/f1/css_sign_in.php">Login</a></li>
         <li><a href="http://localhost:8080/f1/css_findbus.php">Find Bus</a></li>
         <li><a href="http://localhost:8080/f1/css_bookticket1.php">Book Ticket</a></li>
         <li><a href="">View Routes</a></li>
         <li><a href="">View Schedule of Next week</a></li>
         <li><a href="">Schemes</a></li>
         <li><a href="">Cancel Ticket</a></li>
         <li><a href="">Cancelled Buses</a></li>
         <li><a href="">Complaints</a></li>
    </ul>
  </div>
  <div class="content">
		
	<?php require_once '2findbus_script2.php';?>
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
	</form>
	<?php 
		mysql_close($connection);
	?>
  </div>
 
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</div>
</body>
</html>
