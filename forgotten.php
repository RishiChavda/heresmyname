<?php session_start(); ?>
<html>
<head>
<title>Forgotten something?</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Bad+Script|Exo+2|Alegreya+Sans:100,200,300,400' rel='stylesheet' type='text/css'><link href='css/home.css' rel='stylesheet' type='text/css'>
<link href='css/home.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/home.js"></script>
</head>
<body>
<div id="topbar"><table><tr><td id="logo"><a href="index.php">Heres My Name</a></td>
<td id="search"></td>
<td id="user"><div id="menu"><a class="link" href="register.php">Create an account</a></div></td></tr></table></div>
<div id="page">
<div id="loginpage">
<div id='open'>Welcome to Heres My Name</div><div id='homemessage'>Forgotton your account details? Pop your email in the box below and we'll remind you.</div>
<?php
if(isset($_REQUEST['sent'])){echo "<div id='good'>We have sent you an email with information on how to reset your password. Remember to check your Spam folder. You may login <a href='permit.php'>here</a>.</div>";} 
if(isset($_REQUEST['nosent'])){echo "<div id='error'>Account not found. <a href='register.php'>Do you need to create an account?</a></div>";}
if(isset($_REQUEST['noemail'])){echo "<div id='error'>To find out your login details for your account, you must enter a valid email address. <a href='register.php'>Do you need to create an account?</a></div>";}
?>
<div id="logger"><form action="php/forgot.php?send" method="post"><input name="email" type="email" class="longformfield" placeholder="Email Address"/><br><br><input type="submit" class="formbutton" value="Send "/></form><br><a id="forgotpass" href="permit.php">Remembered something?</a></div>
<div id="down"><a id="link" href="http://www.heresmy.name">Go back to HeresMy.Name</a></div>
</div>
</div>
</body>
</html>