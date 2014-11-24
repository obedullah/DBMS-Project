<?php
session_start();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Find Bus</title>
<link href="./css/2net2.css" rel="stylesheet" type="text/css" />
<link href="./css/form_css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id='topbar'>
<ul>
	<?php 
	if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true )
	{	 echo"<li><a href='./css2_sign_out.php'><span>Sign Out</span></a>";
	}
	?>
	<li class='last'><a href='#'><span>Contact</span></a></li>
	<li class='active'><a href='0211.php'><span>Home</span></a></li>
	<?php 
	if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true )		
	{ 	echo "<li style='float:left; margin-left:50px' class='has-sub'><a href='#'><span>Welcome ". $_SESSION['name'] ."</span></a>";
		echo"<ul>";
		echo"<li><a href='user_past_tickets.php'><span>Past Tickets</span></a></li>";
		echo"<li><a href='user_details.php'><span>View Details</span></a></li>";
		echo"<li><a href='#'><span>Edit Details</span></a>";
		echo"</ul>";
		echo"</li>";
	}
	?>
</ul>
</div>
  
<div id="tablestruct">
<div id="row">
<div class="sidebar2">
	<ul class="nav">  
	<?php
		if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false )
		{	echo "<li><a href='./css2_create_account.php'>Create Account</a></li>";
			echo "<li><a href='./css2_sign_in.php'>Login</a></li>";
		}
	?>
	<li><a href="./css2_findbus.php">Find Bus</a></li>
	<li><a href="./css2_bookticket1.php">Book Ticket</a></li>
	<li><a href="">View Routes</a></li>
	<li><a href="">View Schedule of Next week</a></li>
	<li><a href="">Schemes</a></li>
	<li><a href="./cancelticket.php">Cancel Ticket</a></li>
	<li><a href="">Cancelled Buses</a></li>
	<li><a href="">Complaints</a></li>
	</ul>
</div>

<div class="content">
<?php require_once 'css2_findbus_script.php';?>
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

<form id="contactform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<div class="field">
		<label for="source_city">Enter source:</label>
		<select required name="source_city"  class="input2">
		<option style="display:none;" disabled="disabled"  <?php if ($source_city=="") {echo "selected='selected'"; }?> > Choose source city </option>
			<?php  
				while($row = mysql_fetch_array($result1))
				{	$city = $row["source"];
				echo '<option value='. $city .'>'.$city.'</option>';
				}
			?>
		</select>
		<span class="error">* <?php echo $source_cityErr;?></span>
	</div>

	<div class="field">
		<label for="destination_city">Enter destination:</label>
		<select required name="destination_city" class="input2">
		<option style="display:none;" disabled="disabled"  <?php if ($destination_city=="") {echo "selected='selected'"; }?> > Choose destination city </option>
		<?php  
			while($row = mysql_fetch_array($result2))
			{	$city=$row["destination"];
				echo '<option value='. $city. '>'.$city.'</option>';
			}
		?>
		</select>
		<span class="error">* <?php echo $destination_cityErr;?></span>
	</div>
	
	<div class="field">
		<label for="date_of_departure">Date of departure: </label>
		<?php
			$today = date("Y-m-d"); 
			$maximum= date('Y-m-d', strtotime($today. ' + 14 days')); 
		?>
		<input type="date" id="date" min="<?php echo $today?>" max="<?php echo $maximum?>" name="date" value= "<?php print $date ?>" class="input2"/>
		<span class="error">* <?php echo $dateErr;?></span>
	</div>

	<input type="submit" name="Submit" value="Submit" class="button" style="margin-left:270px"/>
</form>
<?php 
	mysql_close($connection);
?>
</div>
</div>
</div>

<div class="footer">
	<p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
</div>
</body>
</html>

		<!--?php $today = date("Y-m-d"); echo $today; 
		$script_tz = date_default_timezone_get();
		echo $script_tz;?-->