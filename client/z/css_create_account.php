<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sign Up CSS</title>
	<link href="css/edit1.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
  <div class="header"><a href="#"><img src="images/bus.jpg" alt="VOSS TRAVELS" name="Insert_logo" width="113" height="113" id="Insert_logo" style="background-color:#CCC; display:block;" /></a> 
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
    <?php require 'create_account_script.php';?>
    <p><h2>User Sign Up </h2></p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		<label for="first_name">First name:</label>
		<input type="text" id="first_name" name="first_name" value= "<?php print $first_name ?>"/> 
		<span class="error">* <?php echo $first_nameErr;?></span>
		<br><br>
		
		<label for="last_name">Last name:</label>
		<input type="text" id="last_name" name="last_name" value="<?php print $last_name ?>" />
		<span class="error">* <?php echo $last_nameErr;?></span>
		<br><br>
		
		<label for="email_id">Email:</label>
		<input type="email" id="email_id" name="email_id" value="<?php print $email_id ?>" />
		<span class="error">* <?php echo $email_idErr;?></span>
		<br><br>
		
		<label for="password">Create password:</label>
		<input type="password" name="password1" value="" size="15" maxlength="20" />
		<span class="error">* <?php echo $password1Err;?></span>
		<br><br>
		
		<label for="password2">Re-enter password:</label>
		<input type="password" name="password2" value="" size="15" maxlength="20" />
		<span class="error">* <?php echo $password2Err;?></span>
		<br><br>
		
		<label for="gender">Gender:</label>
		<select required name="gender" >
			<option style="display:none;" disabled="disabled"  <?php if ($gender=="") {echo "selected='selected'"; }?> > I am </option>
 			<option value="Male" <?php if ($gender=="Male") {echo "selected='selected'"; }?> > Male</option>
			<option value="Female" <?php if ($gender=="Female") {echo "selected='selected'"; }?> > Female</option>
		</select>
		<span class="error">* <?php echo $genderErr;?></span>
		<br><br>
		
		<input type="submit" name="Submit" value="Submit" />
	</form>
    
    </div>
  <div class="footer">
    <p align="center">&copy; Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</div>
</body>
</html>
