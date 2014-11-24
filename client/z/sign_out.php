<?php 
	require_once'redir.php';
	session_start();
	if (  isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] == true )  )
	{  echo "Signing Out";
		$_SESSION['logged_in']=false;
		session_destroy();
		redirect('./1910.html');
		//redirect('./0211.php');
	}
	else
	{	redirect("./1910.html");
		//redirect('./0211.php');
		exit();
	}
?>

signout