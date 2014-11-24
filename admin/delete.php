
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
<h1>DELETE</h1>
<p>Bus Delete </p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		<label for="busid">Busid:</label>
		<input type="text" id="busid" name="busid" value= "<?php print $busid ?>" /> 
		<span class="error">* <?php echo $busidErr;?></span>
		<br><br>
<input type="submit" name="Submit" value="Submit" />
	</form>


</body>
</html>