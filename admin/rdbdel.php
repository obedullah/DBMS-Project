<?php
require 'login.php';

$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");    
$rd=$_POST['type'];
echo $rd ;
$query = "delete from route where routeid=$rd";
$result=mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());  

echo "Route Deleted" ;

mysqli_close($con);

?>
<html>
<head></head>
<body>
<br />
<a href="http://localhost/vish/adminindex.html">Go back</a>
</body>
</html>
