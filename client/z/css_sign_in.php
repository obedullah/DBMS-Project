<?php 
	require_once'redir.php';
	session_start();
	if (  isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] == true )  )
	{  echo "back to own account.";
		//redirect('./useraccount.php');
		redirect('./css_useraccount.php');
	} 
	
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign In CSS</title>
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
    <?php require_once 'sign_in_script.php';?>
	<p><h2>User Log In </h2></p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		
		<label for="email_id">Email:</label>
		<input type="text" id="email_id" name="email_id" value="<?php print $email_id ?>" />
		<span class="error">* <?php echo $email_idErr;?> </span>
		<br><br>
		
		<label for="password">Password:</label>
		<input type="password" name="password" value="" size="15" maxlength="20" />
		<span class="error">* <?php echo $passwordErr;?> </span>
		<br><br>

		<input type="submit" name="Submit" value="Submit" />
	</form>
    <br><a href="./css_create_account.php">Create an account</a>
  </div>
 
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</div>
</body>
</html>
