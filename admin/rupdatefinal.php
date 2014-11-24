<?php  
 
require 'login.php';

$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");   
 
$source = $_POST['source'];  
$destination = $_POST['destination'];  
$distance = $_POST['distance'];  
$orouteid=$_POST['orouteid'];

$query = "update route set routeid=$orouteid, source='$source', destination='$destination', distance=$distance where routeid=$orouteid";


$result=mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());  




echo "Route Updated" ;




mysqli_close($con);

?>
<br><br>
<a href="adminindex.php">go back</a>