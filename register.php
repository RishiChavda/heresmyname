<?php session_start(); ?>
<html>
<head>
<title>Create an HMN account</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Bad+Script|Exo+2|Alegreya+Sans:100,200,300,400' rel='stylesheet' type='text/css'><link href='css/home.css' rel='stylesheet' type='text/css'>
<link href='css/home.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/home.js"></script>
</head>
<body id="books">
<div id="topbar"><table><tr><td id="logo"><a href="index.php">Heres My Name</a></td>
<td id="search"></td>
<td id="user"><div id="menu"><a class="link" href="permit.php">Login</a></div></td></tr></table></div>
<div id="page">
<div id="regpage">
<div id="regger"><div id="open">Enter the magical world of stories</div><table><tr>
<td id="textside">
<div id="bohead">Magic <a href="http://www.amazon.com/Egghead-Cant-Survive-Ideas-Alone/dp/1455519146">By Bo Burnham</a></div>
<div id="botext">Read this to yourself. Read it silently.<br>Don't move your lips. Don't make a sound.<br>Listen to yourself. Listen without hearing anything.<br>What a wonderfully weird thing, huh?<br>NOW MAKE THIS PART LOUD!<br>SCREAM IT IN YOUR MIND!<br>DROWN EVERYTHING OUT.<br>Now, hear a whisper. A tiny whisper.<br><br>Now, read this next line with your best crotchety old-man voice:<br>"Hello there, sonny. Does your town have a post office?"<br>Awesome! Who was that? Whose voice was that?<br>It sure wasn't yours!<br><br>How do you do that?<br>How?!<br>Must be magic.</div>
</td>
<td id="formside"><form action="php/reg.php" method="post">
<input type="text" class="regfield" name="fname" placeholder="First Name"/>
<br><?php if($_SESSION['fnameerror']=="1"){echo "<div class='fielderror'>First name is too short/empty.</div>"; $_SESSION['fnameerror']="";} ?><br><br><br>
<input type="text" class="regfield" name="lname" placeholder="Surname"/>
<br><?php if($_SESSION['lnameerror']=="1"){echo "<div class='fielderror'>Surname is too short/empty.</div>"; $_SESSION['lnameerror']="";} ?><br><br><br>
<input type="email" class="regfield" name="email" placeholder="Email Address"/>
<br><?php if($_SESSION['emailerror']=="1"){echo "<div class='fielderror'>Email address  must be at least 8 characters long.</div>"; $_SESSION['emailerror']="";} ?><br><br><br>
<input type="password" class="regfield" name="password" placeholder="Password"/>
<br><?php if($_SESSION['passerror']=="1"){echo "<div class='fielderror'>Password must be at least 8 characters long.</div>"; $_SESSION['passerror']="";} ?><br><br><br>
<input type="submit" class="regbutton" value="Create my account"/>
</form></td>
</tr></table></div>
</div>
</div>
</body>
</html>