<?php
	session_start();
	require_once './redir.php';
	require_once './database_connect.php';
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Routes</title>
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
				else if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false )
                {	echo "<li><a href='./css2_create_account.php'>Create Account</a></li>";
					echo "<li><a href='./css2_sign_in.php'>Login</a></li>";
				}
			?>
		   <li class='active'><a href='0211.php'><img src="images/home-icon.jpg" width="30" height="30" style="margin-top:15px" background="#000"></a></li>
			<?php 
				if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true )		
				{ echo "<li style='float:left; margin-left:50px' class='has-sub'><a href='#'><span>Welcome ". $_SESSION['name'] ."</span></a>";
				  echo"<ul>";
					echo"<li><a href='user_past_tickets.php'><span>Past Tickets</span></a></li>";
					echo"<li><a href='user_details.php'><span>View Details</span></a></li>";
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
                 <li><a href="./css2_findbus.php">Find Bus</a></li>
                 <li><a href="./css2_bookticket1.php">Book Ticket</a></li>
                 <li><a href="./view_route.php">View Routes</a></li>
                 <li><a href="./view_schedule.php">Weekly Schedule</a></li>
                 <li><a href="./cancelticket.php">Cancel Ticket</a></li>
                 
                </ul>
        </div>
  	
	<div class="content">
	<?php
		$source_cityErr = $destination_cityErr='';
		$source_city = isset($_POST['source_city']) ? $_POST['source_city'] : '';
		$destination_city = isset($_POST['destination_city']) ? $_POST['destination_city'] : '';
		$error=0;
		$number_of_routes=0;
		
		if( isset($_POST['find_from_route'] ) && $_POST['find_from_route']=="Find Seat" )
		{	$url = './css2_findbus.php?source='.$_POST['source'].'&destination='.$_POST['destination'];
			echo $url;
			redirect($url);	
		}
		
		if( isset($_POST['get_route'] ) && $_POST['get_route']=="Get Route" )
		{	
			if( $source_city!='' && $destination_city!='')
			{	$route_query = "SELECT * FROM route WHERE source='" .$source_city."' AND destination= '" .$destination_city. "';";
				$route_result = mysql_query($route_query, $db_connection) or die("query error". mysql_error());
				$number_of_routes = mysql_num_rows($route_result);
				echo "<br><b style='color:#069'>Source: </b>". $source_city;
				echo "<span><b style='color:#069'>Destination: </b>". $destination_city."</span>";
				if( $number_of_routes==0 )
				{	echo"<br><span class='error'><b>No route found.</b></span>";
				}
			}
			if( $source_city!='' && $destination_city=='')
			{	$route_query = "SELECT * FROM route WHERE source='" .$source_city."';";
				$route_result = mysql_query($route_query, $db_connection) or die("query error". mysql_error());
				$number_of_routes = mysql_num_rows($route_result);
				echo "<br><b style='color:#069'>Source: </b>". $source_city;
				if( $number_of_routes==0 )
				{	echo"<br><span class='error'><b>No route found.</b></span>";
				}
			}
			if( $source_city=='' && $destination_city!='')
			{	$route_query = "SELECT * FROM route WHERE destination='" .$destination_city."';";
				$route_result = mysql_query($route_query, $db_connection) or die("query error". mysql_error());
				$number_of_routes = mysql_num_rows($route_result);
				echo "<br><b style='color:#069'>Destination: </b>". $destination_city;
				if( $number_of_routes==0 )
				{	echo"<br><span class='error'><b>No route found.</b></span>";
				}
			}
		}
		if($number_of_routes==0)
		{	
			$route_query= "select * from route ORDER BY route.source, route.destination";
			$route_result = mysql_query($route_query, $db_connection) or die("query error". mysql_error());	
		}
	?>
	<?php
		$query1 = "SELECT DISTINCT source FROM route ORDER BY source ASC;";
		$result1 = mysql_query($query1, $db_connection) or die("query error". mysql_error());
		$query2 = "SELECT DISTINCT destination FROM route ORDER BY destination ASC;";
		$result2 = mysql_query($query2, $db_connection) or die("query error". mysql_error());
	?>
	<br>
	<form id="contactform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<div class="field">
	<label for="source_city">Source:</label>
	<select name="source_city"  class="input2">
		<option value="" <?php if ($source_city=="") {echo "selected='selected'"; }?> >All</option>
		<?php  
			while($row = mysql_fetch_array($result1))
			{	$city = ucwords($row["source"]);
				echo '<option value='. $city .'>'.$city.'</option>';
			}
		?>
	</select>
	<span class="error"><?php echo $source_cityErr;?></span>
	</div>
	
	<div class="field">
	<label for="destination_city">Destination:</label>
	<select name="destination_city" class="input2">
		<option value="" <?php if ($destination_city=="") {echo "selected='selected'"; }?> >All</option>
		<?php  
			while($row = mysql_fetch_array($result2))
			{	$city= ucwords($row["destination"]);
				echo '<option value='. $city. '>'.$city.'</option>';
			}
		?>
	</select>
	<span class="error"><?php echo $destination_cityErr;?></span>
	</div>
	<input type="submit" name="get_route" value="Get Route" class="button" style="margin-left:270px"/>
	</form>
	
	<?php
	echo "<br><b>ROUTES</b><br>";
		echo "<table border='1' cellpadding='5'>		
		<tr>
		<th>Route ID</th>
		<th> From </th>
		<th> To </th>
		<th> Distance(km) </th>
		<th>Book</th>
		</tr>";
			while($row = mysql_fetch_array($route_result))
			{	$routeid = $row["routeid"];
				$source = $row["source"];
				$destination = $row["destination"];
				$distance= $row["distance"];
				$source = ucfirst($source); 
				$destination = ucfirst($destination); 
				echo "<tr>";
				echo "<td>" . $routeid . "</td>";				
				echo "<td>" . $source. "</td>";
				echo "<td>" . $destination. "</td>";
				echo "<td>" . $distance . "</td>";
				?>
				<form id="contactform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				<?php
					echo'<input type="hidden" name="source" value='.$source.'>';
					echo'<input type="hidden" name="destination" value='.$destination.'>';
					echo'<td><input type="submit" name="find_from_route" value="Find Seat"  class="button" style="width:100%" /></td>';
				echo'</form>';
				echo"</tr>";
			}
			echo"</table>";
	?>
		
<br>
<br>
<br>
</div>
</div>
</div>
<?php mysql_close($db_connection);?>
<div class="footer">
<p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
</div>
</body>
</html>