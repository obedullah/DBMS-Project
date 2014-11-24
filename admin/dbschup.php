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

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$con=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");  
$i = unserialize($_POST['type']);

$query = "select * from schedule where routeid=$i[0] and busid=$i[1] ";
$result=mysqli_query($con,$query) or die(header('Location : http://localhost/vish/scheduledel.php'));  
while($row = mysqli_fetch_array($result))
{	 $routeid=$row['routeid'];

                    $busid=$row['busid'];

                    $departure_time=$row['departure_time'];

                   $arrival_time=$row['arrival_time'];

                    $monday=$row['monday'];
					
					   $tuesday=$row['tuesday'];
					    $wednesday=$row['wednesday']; 
						$thursday=$row['thursday'];
						$friday=$row['friday'];
						$saturday=$row['saturday'];
						$sunday=$row['sunday'];


                 

              
}	


mysqli_close($con);
}



?>

<h1> SCHEDULE UPDATE</h1>
<h4>Please enter the values you want to update </h4>
	<form method="post" action="updatefinalsc.php"> 
    	
		<input type="hidden" id="routeid" name="routeid" value="<?php echo $routeid ?>" /> 
        <input type="hidden" id="busid" name="busid" value="<?php echo $busid ?>" /> 
    
        <table border="1" id="ref">
        <tr class="alt">
		<td>Routeid:</td>
        <td>
	    <?php echo $routeid ?>
        </td>
        </tr>
        <tr class="alt">
		<td>Busid:</td>
        <td>
	    <?php echo $busid ?>
        </td>
        </tr>  
		<tr class="alt">
		<td>Departure Time:</td>
		<td><input type="time" id="departure_time" name="departure_time" value="<?php echo $departure_time ?>" ></td> 
		</tr>
		<tr class="alt">
		<td>Arrival Time:</td>
		<td><input type="time" id="arrival_time" name="arrival_time" value="<?php echo $arrival_time ?>"  > </td>
	    </tr>
		<tr class='alt'>
        	<td>Monday:</td>
		<td><select name='monday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
        </td>
        </tr>
		
		
		
		<tr class="alt">
		<td>Tuesday:</td>
		<td><select name='tuesday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
        </td>
		</tr>
        <tr class="alt">
		<td>Wednesday:</td>
		<td><select name='wednesday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
        </td>
		</tr>
        <tr class="alt">
		<td>Thursday:</td>
		<td><select name='thursday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
        </td>
		</tr>
        <tr class="alt">
		<td>Friday:</td>
		<td><select name='friday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
        </td>
		</tr>
        <tr class="alt">
		<td>Saturday:</td>
		<td><select name='saturday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
        </td>
		</tr>
        <tr class="alt">
		<td>Sunday:</td>
		<td><select name='sunday'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
		</select>
        </td>
		</tr>
		
        
	<input type="submit" name="Submit" value="Submit" />
	</form>

<a href="scheduleupdate.php">Go back</a>
</body>
</html>



<html>
<head></head>
<body>
<br />

</body>
</html>