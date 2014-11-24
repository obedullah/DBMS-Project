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

<h1 class="serif">Schedule Create</h1>
<p>Please select the busid and routeid you wish to create a schedule for</p>
<?php
require 'login.php';
$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");  
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT busid FROM bus");
$result1 = mysqli_query($con,"SELECT routeid FROM route");
echo"<form action='dbschedule.php' method='post'>";

echo"<p>Busid:</p>";
echo"<section class='container'>

      <select name='type' class='dropdown-select'>";
while($row = mysqli_fetch_array($result))
  {	$i=$row['busid'];	
 

echo "<option value=\"".$i."\" >".$i."</option>"; 

  

  }
    	echo "</select>";
	  

echo"<p>Routeid:</p>";
echo"<section class='container'>

      <select name='type1' class='dropdown-select'>";
	

  while($row = mysqli_fetch_array($result1))
  {	$j=$row['routeid'];	
 

echo "<option value=\"".$j."\" >".$j."</option>"; 

  

  }
  	echo "</select>;
	  

	<label for='departure_time'>Departure Time:</label>
		<input type='time' id='departure_time' name='departure_time' required /> 
		<label for='arrival_time'>Arrival Time:</label>
		<input type='time' id='arrival_time' name='arrival_time' required /> 
		<label for='monday'>Monday:</label>
		<select name='monday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
		
		<label for='tuesday'>Tuesday:</label>
	<select name='tuesday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
		
		<label for='wednesday'>Wednesday:</label>
		<select name='wednesday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
	
		
		<label for='thursday'>Thursday:</label>
		<select name='thursday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>

		
		<label for='friday'>Friday:</label>
		<select name='friday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
	
		
		<label for='saturday'>Saturday:</label>
		<select name='saturday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
	
		
		<label for='sunday'>Sunday:</label>
		<select name='sunday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>";
	
	echo"<input type='submit' name='Submit' value='Submit' />";
	echo "</form>"; 
  
  mysqli_close($con);
?>

</body>
</html