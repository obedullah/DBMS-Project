
<?php

//require 'login.php';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");    

$busregno=$_POST['busregno'];
$capacity=$_POST['capacity'];
$bustype=$_POST['bustype'];
$fare=$_POST['fare'];
$query = "insert into bus(busregno,capacity,bustype,fare) values('$busregno',$capacity,'$bustype',$fare)";
$result=mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());  

echo "New Bus Added" ;

mysqli_close($con);
}

?>
