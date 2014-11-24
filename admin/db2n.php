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
<style>
#ref
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
width:100%;
border-collapse:collapse;
}
#ref td, #ref th 
{
font-size:1em;
border:1px solid #98bf21;
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


$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");    
$busid=$_POST['type'];
if($busid != NULL)
{
$query = "select * from bus where busid=$busid";
error_reporting(0);
$result = mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());

if (!$result) 
{ // add this check.
die("Busid doesnt exist");
}

while($row = mysqli_fetch_array($result))
{	$busid=$row['busid'];
	$busregno=$row['busregno'];
	$capacity=$row['capacity'];
	$bustype=$row['bustype'];
	$fare=$row['fare'];
}	


mysqli_close($con);
}



?>

<h1> BUS UPDATE</h1>
<h4>Please enter the values you want to update </h4>
	<form method="post" action="updatefinal.php"> 
    	
		<input type="hidden" id="obusid" name="obusid" value="<?php echo $busid ?>" /> 
    
        <table border="1" id="ref">
        <tr class="alt">
		<td>Busid:</td>
        <td>
	    <?php echo $busid ?>
        </td>
        </tr> 
		<tr>
		<td>Bus Registration Number:</td>
		<td><input type="text" id="busregno" name="busregno" value="<?php echo $busregno ?>" ></td> 
		</tr>
		<tr class="alt">
		<td>Capacity:</td>
		<td><input type="text" id="capacity" name="capacity" value="<?php echo $capacity ?>"  > </td>
	    </tr>
		<tr>
		<td>Bus Type:</td>
		<td><input type="text" id="bustype" name="bustype" value="<?php echo $bustype ?>"  > </td>
		</tr>
		<tr class="alt">
		<td>Fare:</td>
		<td><input type="text" id="fare" name="fare" value="<?php echo $fare ?>"  ></td> 
		</tr>
		
        
	<input type="submit" name="Submit" value="Submit" />
	</form>

<a href="busupdate.php">Go back</a>
</body>
</html>