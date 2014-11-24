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
$busidErr = $busregnoErr = $capacityErr = $bustypeErr = $fareErr = "";
$busregno = $bustype = "";
$busid = $fare = $capacity = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
// echo "entered"; 
echo $_POST["busid"]; 
if ($_POST["busid"]==NULL)
     {$busidErr = "Busid is required";}
   else
   
	$busid=$_POST["busid"];
	if ($_POST["capacity"]==NULL)
     {$capacityErr = "Capacity is required";}
   else
   { 
	$capacity=$_POST["capacity"];
	//echo "the fetched capacity is" . $capacity;
   }
if ($_POST["fare"]==NULL)
     {$fareErr = "Fare is required";}
   else
   
	$fare=$_POST["fare"];
if(empty($_POST["busregno"]))
	{ $busregnoErr = "Bus registration is required";}
	else $busregno=$_POST["busregno"];
if(empty($_POST["bustype"]))
	{ $bustypeErr = "Bus registration is required";}
	else $bustype=$_POST["bustype"];
  
}
 
?>

<p><h2>INSERT </h2></p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		<label for="busid">Busid:</label>
		<input type="text" id="busid" name="busid" value= "<?php print $busid ?>" /> 
		<span class="error">* <?php echo $busidErr;?></span>
		<br><br>
        <label for="busregno">Bus Registration Number:</label>
		<input type="text" id="busregno" name="busregno" value= "<?php print $busregno ?>" /> 
		<span class="error">* <?php echo $busregnoErr;?></span>
		<br><br>
		<label for="capacity">Capacity:</label>
		<input type="text" id="capacity" name="capacity" value= "<?php print $capacity ?>" /> 
		<span class="error">* <?php echo $capacityErr;?></span>
		<br><br>
		<label for="bustype">Bus Type:</label>
		<input type="text" id="bustype" name="bustype" value= "<?php print $bustype ?>" /> 
		<span class="error">* <?php echo $bustypeErr;?></span>
		<br><br>
		<label for="fare">Fare:</label>
		<input type="text" id="fare" name="fare" value= "<?php print $fare ?>" /> 
		<span class="error">* <?php echo $fareErr;?></span>
		<br><br>
<input type="submit" name="Submit" value="Submit" />
	</form>


</body>
</html>