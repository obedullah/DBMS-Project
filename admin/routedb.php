<?php

require 'login.php';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");    
$routeid=$_POST['routeid'];
$source=$_POST['source'];
$destination=$_POST['destination'];
$distance=$_POST['distance'];

$query = "insert into route values($routeid,'$source','$destination',$distance)";
$result=mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());  

echo "New Route Added" ;

mysqli_close($con);
}

?>
<br><br>
<a href="http://localhost/vish/adminindex.html">go back</a>