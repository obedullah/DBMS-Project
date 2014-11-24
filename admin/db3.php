
<?php
require 'delete.php';
require 'login.php';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");    
if($busid != NULL)
{
$query = "delete from bus where busid=$busid";
$result=mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());  

echo "Bus Deleted" ;

mysqli_close($con);
}
}
?>
<html>
<head></head>
<body>
<br />
<a href="http://localhost/vish/adminindex.html">Go back</a>
</body>
</html>