<?php
	session_start();
	require_once'../client/redir.php';
	require_once './login.php';
	if( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false || !isset($_SESSION['type']) || $_SESSION['type']=='normal' )
	{	redirect('../client/0211.php');
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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

<h1 class="serif">Create</h1>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

	
		
		<label for="busregno">Bus Registration Number:</label>
		<input type="text" id="busregno" name="busregno" required /> 
		
		<label for="capacity">Capacity:</label>
		<input type="text" id="capacity" name="capacity" value="40" required /> 
		
		<label for="bustype">Bus Type:</label>
		<input type="text" id="bustype" name="bustype" required /> 
	
		<label for="fare">Fare:</label>
		<input type="text" id="fare" name="fare" required /> 
	
        <fieldset>
	<input type="submit" name="Submit" value="Submit" />
    </fieldset>
	</form>
	
	<?php require_once './db.php'; ?>


</body>
</html>