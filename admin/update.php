<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 


<?php

// define variables and set to empty values
$busidErr =  "";

$busid =  NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 echo "entered"; 
echo $_POST["busid"]; 
if ($_POST["busid"]==NULL)
     {$busidErr = "Busid is required";}
   else
   
	$busid=$_POST["busid"];
  
}
 
?>
<h1>UPDATE</h1>
<p>Please enter the busid you want to update </p>
	<form method="post" action="db2.php"> 
		<label for="busid">Busid:</label>
		<input type="text" id="busid" name="busid" /> 
		
		<br><br>
<input type="submit" name="Submit" value="Submit" />
	</form>

<a href="http://localhost/vish/redirect_form.php" >Go back</a>
</body>
</html>