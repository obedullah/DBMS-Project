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
	<title>Sign In</title>
</head>
<body>
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
</body>
</html>