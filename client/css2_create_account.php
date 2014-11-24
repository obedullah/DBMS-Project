<?php 
	require_once'redir.php';
	require_once './database_connect.php';
	session_start();
	if (  isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] == true )  )
	{  echo "back to own account.";
		redirect('./css2_findbus.php');
	} 
	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign Up</title>
<link href="./css/2net2.css" rel="stylesheet" type="text/css" />
<link href="./css/form_css.css" rel="stylesheet" type="text/css" />
</head>

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
					echo"<li><a href='#'><span>Edit Details</span></a></li>";
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
         <?php require 'create_account_script.php';?>
    	 <p><h2>User Sign Up </h2></p>
		<form id="contactform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
        <div class="field">
		<label for="first_name">First name:</label>
		<input type="text" id="first_name" name="first_name" class="input" value= "<?php print $first_name ?>"/> 
		<span class="error">* <?php echo $first_nameErr;?> </span>
		</div>
		
		<div class="field">
		<label for="last_name">Last name:</label>
		<input type="text" id="last_name" name="last_name" class="input"  value="<?php print $last_name ?>" />
		<span class="error">*<?php echo $last_nameErr;?></span>
		</div>
		
		<div class="field">
		<label for="dob">Date of birth: </label>
		<?php
			$today = date("Y-m-d"); 
			$lastyear = strtotime("-100 year", strtotime($today));
		?>
		<input type="date" id="dob" max="<?php echo $today?>" min="<?php echo date("Y-m-d", $lastyear) ?>" name="dob" value="<?php print $dob ?>" class="input2"/>
		<span class="error">*<?php echo $dobErr;?></span>
		</div>
		
		<div class="field">
		<label for="email_id">Email:</label>
		<input type="email" id="email_id" name="email_id" class="input" value="<?php print $email_id ?>"/>
		<span class="error">*<?php echo $email_idErr;?></span>
		</div>
		
		<div class="field">
		<label for="password">Create password:</label>
		<input type="password" name="password1" value="" size="15" maxlength="20" class="input"/>
		<span class="error">* <?php echo $password1Err;?></span>
		</div>
        
        <div class="field">
        <label for="password2">Re-enter password:</label>
		<input type="password" name="password2" value="" size="15" maxlength="20" class="input"/>
		<span class="error">*<?php echo $password2Err;?></span>
		</div>
		
        <div class="field">
		<label for="gender">Gender:</label>
		<select required name="gender" class="input2" style="width: 100px" >
			<option style="display:none;" disabled="disabled"  <?php if ($gender=="") {echo "selected='selected'"; }?>> I am </option>
 			<option value="Male" <?php if ($gender=="Male") {echo "selected='selected'"; }?>> Male</option>
			<option value="Female"<?php if ($gender=="Female") {echo "selected='selected'"; }?>> Female</option>
		</select>
		<span class="error">* <?php echo $genderErr;?></span>
		</div>
		
         <div class="field">
		<input type="submit" name="signup" value="Create Account"  class="button" style="margin-left:310px"/>
		</div>
  		</div>
  </div>
  </div>
<?php mysql_close($db_connection);?>  
<div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
 </div>
</body>
</html>
