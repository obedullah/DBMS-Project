
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HOME PAGE</title>
<link href="./css/2net2.css" rel="stylesheet" type="text/css" />
<link href="./css/form_css.css" rel="stylesheet" type="text/css" />

<link href="./css/about.css" rel="stylesheet" type="text/css" media="screen">

</head>

<body>
	    <div id='topbar'>
        <ul>
			<?php 
				if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true )
				{	 echo"<li><a href='./css2_sign_out.php'><span>Sign Out</span></a>";
				}
			?>
			 <?php
				 if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false )
                 {	echo "<li><a href='./css2_create_account.php'>Create Account</a></li>";
					echo "<li><a href='./css2_sign_in.php'>Login</a></li>";
				 }
			?>
		    <li class='active'><a href='0211.php'><img src="images/home-icon.jpg" width="30" height="30" style="margin-top:15px" background="#000"></a></li>
			<?php 
				if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true )		
				{ echo "<li style='float:left; margin-left:50px' class='has-sub'><a href='#'><span>Welcome ". $_SESSION['name'] ."</span></a>";
				  echo"<ul>";
					echo"<li><a href='user_past_tickets.php'><span>Past Tickets</span></a></li>";
					echo"<li><a href='user_details.php'><span>View Details</span></a></li>";
				  echo"</ul>";
				  echo"</li>";
				}
			?>
		</ul>
		</div>
  
  <div id="tablestruct">
  <div id="row">
          <div class="sidebar2">
              <ul class="nav">  
				
                </ul>
        </div>
  	
    	<div class="content">
		
		<p><font size="20" color="blue"><br>Contact Us</font></p>
		
		 <!-- We will make a simple accordian with hover effects 
The markup will have a list with images and the titles-->
<div class="accordian">
	<ul>
		<li>
			<div class="image_title">
				<a href="#"></a>
			</div>
			<a href="#">
				<img src="images/1.JPG"/>
			</a>
		</li>
		<li>
			<div class="image_title">
				<a href="#">Toy Story 2</a>
			</div>
			<a href="#">
				<img src="images/2.JPG"/>
			</a>
		</li>
		<li>
			<div class="image_title">
				<a href="#">Wall-E</a>
			</div>
			<a href="#">
				<img src="images/3.JPG"/>
			</a>
		</li>
		<li>
			<div class="image_title">
				<a href="#">Up</a>
			</div>
			<a href="#">
				<img src="images/4.JPG"/>
			</a>
		</li>
		<li>
			<div class="image_title">
				<a href="#">Cars 2</a>
			</div>
			<a href="#">
				<img src="images/5.JPG"/>
			</a>
		</li>
	</ul>
</div>


<p>Welcome to ONLINE BUS TICKET RESERVATION SYSTEM (OBTRS). VOSS Travel Agencies is a domestic transportation company that runs  vehicles all over the country.
 We have several branches at different locations of the country. With OBTRS there is no need to go to the counter to buy bus ticket or ask for bus schedule 
 or queue up for hours to get bustickets.
 </p>
 <br>
 <p>
 Project By :
  <br>
 Vishakha Singh
  <br>
 Obedullah Ansari
  <br>
 Surbhi Aggarwal
  <br>
 Shamim Biswas
 </p>
 
  		</div>
  </div>
  </div>
  
  <div class="footer">
    <p align="center">&copy Copyright 2013 &bull;  VOSS TRAVELS &bull;  ALL RIGHTS RESERVED</p>
  </div>
</body>
</html>
<html>





