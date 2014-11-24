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
<h1 class="serif">Schedule Delete</h1>
<?php

require 'login.php';


$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");    

$query = "select * from schedule";
//error_reporting(0);
$result = mysqli_query($con,$query) or die('Query "' . $query . '" failed: ' . mysql_error());

if (!$result) 
{ // add this check.
die("Schedule doesnt exist");
}


echo "<table border='1' id='ref'>

        <tr>
            <td><b>Routeid</b></td>

            <td><b>Busid</b></td>

            <td><b>Departure Time</b></td>

            <td><b>Arrival Tine</b></td>

            <td><b>Monday</b></td>

            <td><b>Tuesday</b></td>
			 <td><b>Wednesday</b></td>
			  <td><b>Thursday</b></td>
			   <td><b>Friday</b></td>
			    <td><b>Saturday</b></td>
				 <td><b>Sunday</b></td>

        </tr>";

                 

            while($row = mysqli_fetch_array($result))
			{

            echo "<tr>

                    <td>".$row['routeid']."</td>

                    <td>".$row['busid']."</td>

                    <td>".$row['departure_time']."</td>

                    <td>".$row['arrival_time']."</td>

                    <td>".$row['monday']."</td>
					
					   <td>".$row['tuesday']."</td>
					    <td>".$row['wednesday']."</td> 
						<td>".$row['thursday']."</td>
						<td>".$row['friday']."</td> 
						<td>".$row['saturday']."</td>
						<td>".$row['sunday']."</td>


                 

                </tr>";

            }

     

echo "</table>";


mysqli_close($con);




?>

<p>Please select the busid and routeid you wish to delete from schedule </p>
<?php
require 'login.php';
$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");  
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//$result = mysqli_query($con,"SELECT busid FROM schedule");

$result= mysqli_query($con,"SELECT routeid,busid  FROM schedule");
echo"<form action='dbschdel.php' method='post'>";

echo"<p>Routeid-Busid:</p>";
echo"<section class='container'>

      <select name='type' class='dropdown-select'>";
while($row = mysqli_fetch_array($result) )
  {	
  	$i=array($row['routeid'],$row['busid']);
$j=serialize($i);

	echo "<option value='$j' >".$i[0].'-'.$i[1]."</option>";  

  }
    echo "</select>";
	  


  	echo "</select>";
	echo"<input type='submit' name='Submit' value='Submit' />";
	echo "</form>"; 
  
  mysqli_close($con);
	?>

</body>
</html>