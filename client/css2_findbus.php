<?php
	session_start();
	require_once './redir.php';
	require_once 'findbus_functions.php';
	require_once './database_connect.php';
	
	if( isset($_GET['source']) && ( isset($_GET['destination']) ) ) 
	{	$source_city = $_GET['source'];
		$destination_city = $_GET['destination'];
		$_POST['source_city']= $_GET['source'];
		$_POST['destination_city']= $_GET['destination'];
	}
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
				
				if ( $_SESSION['type']== 'admin' ) {
					 echo"<li><a href='../admin/adminindex.php'><span>Admin</span></a>";
					 }
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
				 <li><a href="./complaints.php">Complaints</a></li>
				 <li><a href="./about.php">Contact Us</a></li>
                
               
                </ul>
        </div>
  	
	<div class="content">
	<?php
		$source_cityErr = $destination_cityErr = $dateErr ='';
		$source_city = isset($_POST['source_city']) ? $_POST['source_city'] : '';
		$destination_city = isset($_POST['destination_city']) ? $_POST['destination_city'] : '';
		$date = isset($_POST['date']) ? $_POST['date'] : date("Y-m-d");
		$error=0;
		if( isset($_POST['find_bus'] ) && $_POST['find_bus']=="Find Bus" )
		{	$error =  validate_findbus_form();
			if( $error==0)
			{	/*$_SESSION['source_city'] =$_POST['source_city'];
				$_SESSION['destination_city']=$_POST['destination_city'];
				$_SESSION['date']= $_POST['date'];
				$_SESSION['day']=$day; */
				$url = './css2_findbus_script.php?source='.$source_city.'&destination='.$destination_city.'&date='.$date;
				redirect($url);
			}
		}
		
		$query1 = "SELECT DISTINCT source FROM route ORDER BY source ASC;";
		$result1 = mysql_query($query1, $db_connection) or die("query error". mysql_error());
		$query2 = "SELECT DISTINCT destination FROM route ORDER BY destination ASC;";
		$result2 = mysql_query($query2, $db_connection) or die("query error". mysql_error());
	?>
	
	<br><br>
	<form id="contactform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	<div class="field">
	<label for="source_city">From:</label>
	<select required name="source_city"  class="input2">
		<option style="display:none;" disabled="disabled"  <?php if ($source_city=="") {echo "selected='selected'"; }?> > Choose source city </option>
		<?php  
			while($row = mysql_fetch_array($result1))
			{	$city = ucwords($row["source"]);
				?>
				<option <?php if ($source_city==$city) {echo "selected='selected'";} ?> > <?php echo $city?> </option>
				<?php
			}
		?>
	</select>
	<span class="error">* <?php echo $source_cityErr;?></span>
	</div>
	
	<div class="field">
	<label for="destination_city">To:</label>
	<select required name="destination_city" class="input2">
		<option style="display:none;" disabled="disabled"  <?php if ($destination_city=="") {echo "selected='selected'"; }?> > Choose destination city </option>
		<?php  
			while($row = mysql_fetch_array($result2))
			{	$city= ucwords($row["destination"]);
				?>
				<option <?php if ($destination_city==$city) {echo "selected='selected'";} ?> > <?php echo $city?> </option>
				<?php
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
	<span class="error">*<?php echo $dateErr;?></span>
	</div>

	<input type="submit" name="find_bus" value="Find Bus" class="button" style="margin-left:270px"/>
	</form>
</div>
</div>
</div>
<?php mysql_close($db_connection);?>
<div class="footer">
<p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
</div>
</body>
</html>