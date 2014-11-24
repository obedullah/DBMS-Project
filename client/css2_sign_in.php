<?php 
	require_once'redir.php';
	session_start();
	if (  isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] == true )  )
	{  echo "back to own account.";
		redirect('./css2_findbus.php');
	} 
	
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign In</title>
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
       	<?php require_once 'css2_sign_in_script.php';?>
		<p><h2>User Log In </h2></p>
		<form id="contactform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		
		<div class="field">
		<label for="email_id">Email:</label>
		<input class="input" type="email" id="email_id" name="email_id" value="<?php print $email_id ?>" />
		<span class="error">* <?php echo $email_idErr;?> </span>
		</div>
		
		<div class="field">
		<label for="password">Password:</label>
		<input class="input" type="password" name="password" value="" size="15" maxlength="20" />
		<span class="error">* <?php echo $passwordErr;?> </span>
		</div>

		<div class="field">
		<!--input class="button" type="submit" name="Submit" value="Submit" style="margin-left:300px"/-->
		<input class="button" type="submit" name="sign_in" value="Sign In" style="margin-left:300px"/>
		</div>
		<a style="margin-left:270px" href="./css2_create_account.php">Create an account</a>
		</form>    
  		</div>
  </div>
  </div>
  
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
 </div>
</body>
</html>
