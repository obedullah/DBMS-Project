<?php
	session_start();
	require_once'../client/redir.php';
	require_once './login.php';
	if( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false || !isset($_SESSION['type']) || $_SESSION['type']=='normal' )
	{	redirect('../client/0211.php');
	}
?>
<?php  
 
require 'login.php';

$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");   
 
$busregno = $_POST['busregno'];  
$capacity = $_POST['capacity'];  
$bustype = $_POST['bustype'];  
$fare = $_POST['fare'];
$obusid=$_POST['obusid'];
$query = "update bus set busid=$obusid, busregno='$busregno', capacity=$capacity, bustype='$bustype', fare=$fare where busid=$obusid";


$result=mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());  




echo "Bus Updated" ;




mysqli_close($con);

?>
<br><br>
<a href="adminindex.php">go back</a>