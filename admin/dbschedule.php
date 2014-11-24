
<?php

require 'login.php';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");    

$busid=$_POST['type'];
$routeid=$_POST['type1'];
$departure_time=$_POST['departure_time'];

$arrival_time=$_POST['arrival_time'];
$monday=$_POST['monday'];

$tuesday=$_POST['tuesday'];
$wednesday=$_POST['wednesday'];
$thursday=$_POST['thursday'];
$friday=$_POST['friday'];
$saturday=$_POST['saturday'];
$sunday=$_POST['sunday'];
$query = "insert into schedule
values($routeid,$busid,'$departure_time','$arrival_time',$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday)";
$result=mysqli_query($con,$query) or die(header('Location: schedulecreate.php'));  

echo 'New Schedule Added' ;

mysqli_close($con);
}

?>
<br><br>
<a href="./adminindex.php">go back</a>