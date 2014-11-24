<?php
	session_start();
?>
<?php
	require_once'redir.php';
	if( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false )
	{	redirect('./1910.html');
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sign In CSS</title>
	<link href="css/edit1.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
  <div class="header"><a href="#"><img src="images/bus.jpg" alt="VOSS TRAVELS" name="Insert_logo" width="113" height="113" id="Insert_logo" style="background-color:#CCC; display:block;" /></a> 
   </div>
  <div class="sidebar1">
    <ul class="nav">  
         <li><a href="http://localhost:8080/f1/css_findbus.php">Find Bus</a></li>
         <li><a href="http://localhost:8080/f1/css_bookticket1.php">Book Ticket</a></li>
		 <li><a href="sign_out.php">SignOut</a></li>
         <li><a href="">View Routes</a></li>
         <li><a href="">View Schedule of Next week</a></li>
         <li><a href="">Schemes</a></li>
         <li><a href="./cancelticket.php">Cancel Ticket</a></li>
         <li><a href="">Cancelled Buses</a></li>
         <li><a href="">Complaints</a></li>
    </ul>
  </div>
  
  <div class="content">
		 <h2>YOUR  ACCOUNT</h2>
		<?php
			if( isset($_SESSION['email_id']) )
			{	echo "<br><b>EMAIL-ID:".$_SESSION['email_id']."</b></br>";
			}
			if( isset($_SESSION['userid']) )
			{	echo "<br><b>USERID:".$_SESSION['userid']."</b></br>";
			}
		?>
    
    </div>
  <div class="footer">
    <p align="center">&copy; Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</div>
</body>
</html>
