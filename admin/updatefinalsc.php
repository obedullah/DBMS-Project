<?php  
 
require 'login.php';

$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");   
 
$routeid=$_POST['routeid'];
$busid=$_POST['busid'];
$departure_time=$_POST['departure_time'];
$arrival_time=$_POST['arrival_time'];
$monday=$_POST['monday'];

$tuesday=$_POST['tuesday'];
$wednesday=$_POST['wednesday'];
$thursday=$_POST['thursday'];
$friday=$_POST['friday'];
$saturday=$_POST['saturday'];
$sunday=$_POST['sunday'];
$query = "update schedule set departure_time='$departure_time', arrival_time='$arrival_time', monday=$monday, tuesday=$tuesday,wednesday=$wednesday, thursday=$thursday, friday=$friday, saturday=$saturday, sunday=$sunday where routeid=$routeid and busid=$busid";


$result=mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());  




echo "Schedule Updated" ;




mysqli_close($con);

?>
<br><br>
<a href="adminindex.php">go back</a>