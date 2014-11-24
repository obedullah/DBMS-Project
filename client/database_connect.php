<?php
	$database = "obtrs";
	$server = "localhost";
	$db_connection = mysql_connect($server,"root","password");				
	if (!$db_connection) 
	{	die("Unable to connect to MySQL: " . mysql_error()); 
	}
	$db_found = mysql_select_db($database);
	if (!$db_found)
	{	die("Unable to connect to MySQL: " . mysql_error());
	}
?>