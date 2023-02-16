<?php session_start(); require("php/sessions.php"); ?>
<html>
<head>
<title>HeresMyName - Help</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Alegreya+Sans:100,200,300,400' rel='stylesheet' type='text/css'>
<link href='css/ee.css' rel='stylesheet' type='text/css'>
<link href='css/help.css' rel='stylesheet' type='text/css'>
<?php include("php/stylesesh.php"); ?>
<?php if(strlen($_SESSION['themecolour'])==6){echo "<style> body{background-color:#".$_SESSION['themecolour'].";} </style>";} ?>
</head>
<body>
<div id="topbar"><table cellspacing="0" cellpadding="0"><tr>
<td id="logo"><a href="discover.php"><img src="img/hmnw.png"/></a></td>
<td id="menu"><a class="link" href="discover.php">Discover</a><a class="link" href="shelf.php">Read</a><a class="link" href="write.php">Write</a></td>
<td id="search"><form action="search.php" method="post"/><input type="text" name="terms" id="terms" placeholder="Find something..."/><input type="submit" id="go" value="Go"/></form></td>
<td id="user"><?php if(file_exists($_SESSION['profpic'])){echo "<div id='button'><img src='".$_SESSION['profpic']."'/></div>";} else{echo "<div id='button'><img src='img/default.png'/></div>";} require("php/notifcheck.php"); if($notifct>0){echo "<a id='notifcount' href='updates.php'>".$notifct."</a>";} ?></td>
</tr></table>
<div id="usermenu">
<div class="mobileitem"><a href="discover.php">Discover</a></div>
<div class="mobileitem"><a href="read.php">Read</a></div>
<div class="mobileitem"><a href="write.php">Write</a></div>
<div class="mobileitem"><a href="search.php">Search</a></div>
<?php echo "<div class='item'><a href='profile.php?id=".$_SESSION['uzid']."'>".$_SESSION['fll']."</a></div>"; ?>
<div class="item"><a href="stories.php">My Stories</a></div>
<div class="item"><a href="shelf.php">My Shelf</a></div>
<div class="item"><a href="connections.php">My Connections</a></div>
<div class="item"><a href="updates.php">Updates</a></div>
<div class="item"><a href="settings.php">Settings</a></div>
<div class="item"><a href="help.php">Help</a></div>
<div class="item"><a onClick="exithmn()">Log Out</a></div>
</div></div>
<div id="main"><div id="bigmessage">Need a hand using HeresMyName?<br><a id="smallmessage">No problem. Enter your name, email address, and your problem and we'll get back to you as soon as possible.</a></div>
<?php
if($_SESSION['supportr']=="0"){echo "<div id='error'>You've forgotten something...</div>"; $_SESSION['supportr']="";}
elseif($_SESSION['supportr']=="1"){echo "<div id='good'>Support message sent. You should recieve an email shortly regarding your problem. Thank you.</div>"; $_SESSION['supportr']="";}
?>
<div id="support">
<form action="php/sendsupport.php" method="post">
<input type="text" class="supportfield" name="name" placeholder="Full name" required/>
<br>
<input type="email" class="supportfield" name="email" placeholder="Email address" required/>
<br>
<textarea id="supportarea" name="problem" placeholder="What's the problem?" required></textarea>
<br><br>
<input type="submit" id="supportbutton" value="Submit"/></form>
</div>
</div>
</body>
</html>