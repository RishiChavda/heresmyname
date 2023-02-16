<?php
session_start();
require("php/eecon.php");
if($_SESSION['logged']=="1"){header("location: discover.php");}
if(isset($_REQUEST['login'])){
if($_POST){
$email=strtolower(htmlspecialchars(stripslashes(mysql_real_escape_string($_POST['email']))));
$password=md5(strtolower(htmlspecialchars(stripslashes(mysql_real_escape_string($_POST['password'])))));
$query=mysql_query("SELECT * FROM uzee WHERE email='$email' AND password='$password'");
$count=mysql_num_rows($query);
if($count==1){
while($loginsessionarray=mysql_fetch_array($query, MYSQL_BOTH)){
$_SESSION['logged']="1";
$_SESSION['uzid']=$loginsessionarray['uzid'];
$_SESSION['fn']=$loginsessionarray['fname'];
$_SESSION['ln']=$loginsessionarray['lname'];
$_SESSION['fll']=$loginsessionarray['fname']." ".$loginsessionarray['lname'];
$_SESSION['profpic']=$loginsessionarray['profpic'];
$_SESSION['email']=$loginsessionarray['email'];
$_SESSION['password']=$loginsessionarray['password'];
$_SESSION['super']=$loginsessionarray['super'];
}
header("location: discover.php");
}
else{header("location: permit.php?error");}
}
else{header("location: http://heresmy.name");}
}
?><html>
<head>
<title>Here's My Name</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400|Bad+Script|Exo+2|Alegreya+Sans:100,200,300,400' rel='stylesheet' type='text/css'><link href='css/home.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/home.js"></script>
</head>
<body>
<div id="topbar"><table><tr><td id="logo"><a id="word" href="http://heresmy.name">Heres My Name</a><a id="pic" href="http://heresmy.name"><img src="img/hmnb.png"/></a></td>
<td id="user"><div id="menu"><a class="link" href="register.php">Signup</a> <a id="login" class="link" href="#loginbox">Login</a></div></td></tr></table></div>
<div id="loginbox"><div id="heading">Login</div><form action="index.php?login" method="post">
<input name="email" type="email" class="formfield" placeholder="Email Address"/> <input name="password" type="password" class="formfield" placeholder="Password"/><br><br><input type="submit" class="formbutton" value="Login"/></form><br><a id="forgotpass" href="forgotten.php">Forgotten something?</a><div id="closeloginbox" class="bottomclose">Close</div></div>
<div id="page">
<div id="intro">
<div id="open">Welcome to Heres My Name</div>
<div id="sub">The place where stories live and people are written</div>
<div id="down"><a id="link" href="#about">learn more</a></div>
</div>
<div id="about"><table><tr><td id="words"><div id="heading">Here's my name... (And here's my story)</div><div id="descript">HeresMyName is a powerful story-sharing community for people all around the world to read, share, and write stories.<br><br>Here at HMN, we aim to create a seamless relationship between readers and writers, to allow people to easily write their material and get it noticed by the right people as well as giving readers the freedom of accessing the types of stories they love.<br><br>From short stories to full length novels; this is certainly the place to be.<br><br><a class="link" href="register.php">Register free today!</a></div></td><td id="picture"><img src="img/bookview.png"/></td></tr></table></div>
<div id="copyright">Copyright &copy; HeresMyName 2014</div>
</div>
</body>
</html>