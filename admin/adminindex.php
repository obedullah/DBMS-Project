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
<style>
 #cssmenu ul {
  margin: 0;
  padding: 0;
}
#cssmenu li {
  margin: 0;
  padding: 0;
}
#cssmenu a {
  margin: 0;
  padding: 0;
}
#cssmenu ul {
  list-style: none;
}
#cssmenu a {
  text-decoration: none;
}
#cssmenu {
  height: 70px;
  background-color: #232323;
  box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.4);
  width: auto;
}
#cssmenu > ul > li {
  float: left;
  margin-left: 15px;
  position: relative;
}
#cssmenu > ul > li > a {
  color: #a0a0a0;
  font-family: Verdana, 'Lucida Grande';
  font-size: 15px;
  line-height: 70px;
  padding: 15px 20px;
  -webkit-transition: color .15s;
  -moz-transition: color .15s;
  -o-transition: color .15s;
  transition: color .15s;
}
#cssmenu > ul > li > a:hover {
  color: #ffffff;
}
#cssmenu > ul > li > ul {
  opacity: 0;
  visibility: hidden;
  padding: 16px 0 20px 0;
  background-color: #fafafa;
  text-align: left;
  position: absolute;
  top: 55px;
  left: 50%;
  margin-left: -90px;
  width: 180px;
  -webkit-transition: all .3s .1s;
  -moz-transition: all .3s .1s;
  -o-transition: all .3s .1s;
  transition: all .3s .1s;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
  -moz-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
}
#cssmenu > ul > li:hover > ul {
  opacity: 1;
  top: 65px;
  visibility: visible;
}
#cssmenu > ul > li > ul:before {
  content: '';
  display: block;
  border-color: transparent transparent #fafafa transparent;
  border-style: solid;
  border-width: 10px;
  position: absolute;
  top: -20px;
  left: 50%;
  margin-left: -10px;
}
#cssmenu > ul ul > li {
  position: relative;
}
#cssmenu ul ul a {
  color: #323232;
  font-family: Verdana, 'Lucida Grande';
  font-size: 13px;
  background-color: #fafafa;
  padding: 5px 8px 7px 16px;
  display: block;
  -webkit-transition: background-color 0.1s;
  -moz-transition: background-color 0.1s;
  -o-transition: background-color 0.1s;
  transition: background-color 0.1s;
}
#cssmenu ul ul a:hover {
  background-color: #f0f0f0;
}
#cssmenu ul ul ul {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  top: -16px;
  left: 206px;
  padding: 16px 0 20px 0;
  background-color: #fafafa;
  text-align: left;
  width: 180px;
  -webkit-transition: all .3s;
  -moz-transition: all .3s;
  -o-transition: all .3s;
  transition: all .3s;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
  -moz-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
}
#cssmenu ul ul > li:hover > ul {
  opacity: 1;
  left: 190px;
  visibility: visible;
}
#cssmenu ul ul a:hover {
  background-color: #cc2c24;
  color: #f0f0f0;
}
h1.serif{font-family:"Lucida Console",Times,serif;text-align:right;font-size:50px}
p.serif{font-family:"Lucida Console",Times,serif;text-align:right; color:#F93}
 

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
	   <li><a href='./compl_show.php'><span>Complaints</span></a> 
   		</li>
	 <li class='last'><a href='http://localhost/client/css2_findbus.php'><span>Client Side</span></a></li>  
</ul>
</div>
<h1 class="serif">Welcome Admin</h1>
<p class="serif">This page will allow you to access the official VOSS database system.<br><br > You may create, update, delete according to the current requirements.</p> 

</body>
</html>
