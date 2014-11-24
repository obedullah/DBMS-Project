<html>
<head></head>
<body>
<?php
//require 'update.php';
require 'login.php';

//if ($_SERVER["REQUEST_METHOD"] == "POST")
//{ //echo $busid1 . "=This is the fetched id";
$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");    
$busid1=$_POST['busid1'];
if($busid1 != NULL)
{
$query = "select * from bus where busid=$busid1";
error_reporting(0);
$result = mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());

if (!$result) 
{ // add this check.
die("Busid doesnt exist");

}

while($row = mysqli_fetch_array($result))
{	$busid=$row['busid'];
	$busregno=$row['busregno'];
	$capacity=$row['capacity'];
	$bustype=$row['bustype'];
	$fare=$row['fare'];
}	


mysqli_close($con);
}



?>
<?php
//echo "The desired row: ";
echo "<br>";
echo "<table border='1' >";
echo "<tr>";
echo "<td>";
echo "Reference Table";
echo "</td>";
echo "</tr>";
echo "<tr class='alt'>";
echo "<td>" ."Busid". "</td>";
echo "<td>" .$busid. "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" ."Bus Registration Number". "</td>";
echo "<td>" .$busregno. "</td>";
echo "</tr>";
echo "<tr class='alt'>";
echo "<td>" ."Capacity". "</td>";
echo "<td>" .$capacity. "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" ."Bustype". "</td>";
echo "<td>" .$bustype. "</td>";
echo "</tr>";
echo "<tr class='alt'>";
echo "<td>" ."Fare". "</td>";
echo "<td>" .$fare. "</td>";
echo "</tr>";
echo "<br>";
?>
<h1>UPDATE</h1>
<h4>Please enter the values you want to update </h4>
	<form method="post" action="updatefinal.php"> 
    	
		<input type="hidden" id="obusid" name="obusid" value="<?php echo $busid ?>" /> 
        <br><br>
		<label for="busid">Busid:</label>
		<input type="text" id="busid" name="busid" value="<?php echo $busid ?>" /> 
		
		<br><br>
		<label for="busregno">Bus Registration Number:</label>
		<input type="text" id="busregno" name="busregno" value="<?php echo $busregno ?>" /> 
		
		<br><br>
		<label for="capacity">Capacity:</label>
		<input type="text" id="capacity" name="capacity" value="<?php echo $capacity ?>"  /> 
	
		<br><br>
		<label for="bustype">Bus Type:</label>
		<input type="text" id="bustype" name="bustype" value="<?php echo $bustype ?>"  /> 
	
		<br><br>
		<label for="fare">Fare:</label>
		<input type="text" id="fare" name="fare" value="<?php echo $fare ?>"  /> 
		
		<br><br>
        
	<input type="submit" name="Submit" value="Submit" />
	</form>

<a href="http://localhost/vish/update.html">Go back</a>
</body>
</html>