<?php session_start(); ?>
<html>
<head>
<title>Please login to continue</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Bad+Script|Exo+2|Alegreya+Sans:100,200,300,400' rel='stylesheet' type='text/css'><link href='css/home.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/home.js"></script>
</head>
<body>
<div id="topbar"><table><tr><td id="logo"><a href="index.php">Heres My Name</a></td>
<td id="search"></td>
<td id="user"><div id="menu"><a class="link" href="register.php">Create an account</a></div></td></tr></table></div>
<div id="page">
<div id="loginpage">
<div id="open">Welcome to Heres My Name</div><div id="homemessage">Please login to continue</div>
<?php
if(isset($_REQUEST['alreadyreg'])){echo "<div id='error'>There is already an account with that email address. Please login below.</div>";}
elseif(isset($_REQUEST['error'])){echo "<div id='error'>Account details incorrect. Please try again. <a id='forgotpass' href='forgotten.php'>Have you forgotten something?</a></div>";}
elseif(isset($_REQUEST['newreg'])){echo "<div id='good'>Great you've just registered your HeresMyName account! We've sent you a welcome email (be sure to check the Spam folder). You can now login with your email and password below.</div>";}
elseif(isset($_REQUEST['noauthority'])){echo "<div id='error'>You do not have permission to view that page.</div>";}
?>
<div id="logger"><form action="index.php?login" method="post"><input name="email" type="email" class="formfield" placeholder="Email Address"/> <input name="password" type="password" class="formfield" placeholder="Password"/><br><br><input type="submit" class="formbutton" value="Login"/></form><br><a id="forgotpass" href="forgotten.php">Forgotten something?</a></div>
<div id="down"><a id="link" href="http://www.heresmy.name">Go back to HeresMy.Name</a></div>
</div>
</div>
</body>
</html>