<?php
	session_start();
	require_once'../client/redir.php';
	require_once './login.php';
	if( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false || !isset($_SESSION['type']) || $_SESSION['type']=='normal' )
	{	redirect('../client/0211.php');
	}
?>
<html>
<head>
   
     <link href="menu.css" rel="stylesheet">
        <link href="form.css" rel="stylesheet">
     	
     <style>
	 h1.serif{font-family:"Lucida Console",Times,serif;text-align:left;font-size:50px;color:#F96}
#ref
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
width:100%;
border-collapse:collapse;
}
#ref td, #ref th 
{
font-size:1em;
border:1px solid #F96;
padding:3px 7px 2px 7px;
}
#ref th 
{
font-size:1.1em;
text-align:left;
padding-top:5px;
padding-bottom:4px;
background-color:#A7C942;
color:#ffffff;
}
#ref tr.alt td 
{
color:#000000;
background-color:#EAF2D3;
}
</style>

</head>
<body>
<div id='cssmenu'>
<ul>
   <li class='active'><a href='adminindex.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Bus</span></a>
      <ul>
         <li><a href="buscreate.php"><span>Create</span></a></li>
          <li><a href="busdel.php"><span>Delete</span></a></li>
         <li class='last'><a href="busupdate.php"><span>Update</span></a></li>
      </ul>
   </li>
   <li><a href='#'><span>Route</span></a> 
   		<ul>
         <li><a href='distance.php'><span>Create</span></a></li>
          <li><a href='routedel.php'><span>Delete</span></a></li>
         <li class='last'><a href='routeupdate.php'><span>Update</span></a></li>
      </ul></li>
   <li class='last'><a href='#'><span>Schedule</span></a> <ul>
         <li><a href='schedulecreate.php'><span>Create</span></a></li>
          <li><a href='scheduledel.php'><span>Delete</span></a></li>
         <li class='last'><a href='scheduleupdate.php'><span>Update</span></a></li>
      </ul></li>
</ul>
</div>
 <?php
require 'login.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{$i = unserialize($_POST['type']);
$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");    
$query = "delete from schedule where routeid=$i[0] and busid=$i[1] ";
$result=mysqli_query($con,$query) or die(header('Location : scheduledel.php'));  

echo "Schedule Deleted" ;

mysqli_close($con);
}
?>
<html>
<head></head>
<body>
<br />
<a href="adminindex.php">Go back</a>
</body>
</html>