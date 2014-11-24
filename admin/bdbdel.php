<?php
//require 'login.php';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");    
$rd=$_POST['type'];
//echo $rd ;
$query = "delete from bus where busid=$rd";
$result=mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());  

echo "<br><br>Bus " .$rd . " Deleted" ;

mysqli_close($con);
}

?>
