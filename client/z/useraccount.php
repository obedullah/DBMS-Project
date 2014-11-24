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
	<title>User Account</title>
</head>

<body>
<div id="wrapper">
    <div id ="top">
        <p><h1>Bus Management System</h1></p>
        <div id="logo">
        	<img src="images/bus.jpg" width="125" height="118">
        </div>
        <div id="social_media">
        	<p>For additional info please call:99999</p>
            <ul>
            	<li><a href="https://www.facebook.com/"><img src="images/fb.jpg" width="25" height="21"></a></li>
        </div>
    </div>
    
    <div id="navbar">
            <ul>
                <li><a href="http://localhost:8080/f1/create_account.php">Create Account</a></li>
                <li><a href="http://localhost:8080/f1/sign_in.php">Login</a></li>
                <li><a href="http://localhost:8080/f1/2findbus.php">Find Bus</a></li>
                <li><a href="http://localhost:8080/f1/book2.php">Book Ticket</a></li>
				<li><a href="sign_out.php">SignOut</a></li>
                <li><a href="">View Routes</a></li>
                <li><a href="">View Schedule of Next week</a></li>
                <li><a href="">Schemes</a></li>
                <li><a href="">Cancel Ticket</a></li>
                <li><a href="">Cancelled Buses</a></li>
                <li><a href="">Complaints</a></li>
            </ul>
    </div>

    <div id="content">
        <h2>YOUR  ACCOUNT</h2>
		<?php
			if( isset($_SESSION['email_id']) )
			{	echo "<br><b>EMAIL-ID:".$_SESSION['email_id']."</b></br>";
			}
			if( isset($_SESSION['userid']) )
			{	echo "<br><b>USERID:".$_SESSION['userid']."</b></br>";
			}
			echo "login=".$_SESSION['logged_in'];
		?>
    </div>
        
    <div id="footer">
        <p>Footer</p>
        <p>&copy;Copyright 2013 &bull;All Rights Reserved </p>
    </div>
</div>
</body>
</html>
