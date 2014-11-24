<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link href="menu.css" rel="stylesheet">
   <link href="form.css" rel="stylesheet">
</head>

<body>
<div id='cssmenu'>
<ul>
   <li class='active'><a href='adminindex.html'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Bus</span></a>
      <ul>
         <li><a href="http://localhost/vish/buscreate.php"><span>Create</span></a></li>
          <li><a href="http://localhost/vish/busdel.php"><span>Delete</span></a></li>
         <li class='last'><a href="http://localhost/vish/busupdate.php"><span>Update</span></a></li>
      </ul>
   </li>
   <li><a href='#'><span>Route</span></a> 
   		<ul>
         <li><a href='distance.php'><span>Create</span></a></li>
          <li><a href='http://localhost/vish/routedel.php'><span>Delete</span></a></li>
         <li class='last'><a href='http://localhost/vish/routeupdate.php'><span>Update</span></a></li>
      </ul></li>
   <li class='last'><a href='#'><span>Schedule</span></a> <ul>
         <li><a href='schedulecreate.php'><span>Create</span></a></li>
          <li><a href='scheduledel.php'><span>Delete</span></a></li>
         <li class='last'><a href='scheduleupdate.php'><span>Update</span></a></li>
      </ul></li>
</ul>
</div>
<h1 class="serif">Route Create</h1>

	<form method="post" action="routedb.php"> 
		<label for="routeid">Routeid:</label>
		<input type="text" id="routeid" name="routeid" required /> 
	
		
		<label for="source">Source:</label>
		<input type="text" id="source" name="source" required /> 
		
		<label for="destination">Destination:</label>
		<input type="text" id="destination" name="destination" required /> 
		
		<label for="distance">Distance:</label>
		<input type="text" id="distance" name="distance" required /> 
	
	
	
        <fieldset>
	<input type="submit" name="Submit" value="Submit" />
    </fieldset>
	</form>


</body>
</html>
