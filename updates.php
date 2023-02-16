<?php
session_start();
require("php/sessions.php");
require("php/eecon.php");
if(isset($_REQUEST['markallread'])){$thid=$_SESSION['uzid']; mysql_query("UPDATE notifs SET notifseen='1' WHERE notifuzid='$thid'"); echo "<script> window.location='../updates.php' </script>";}
if(isset($_GET['del'])){$notifid=$_GET['del']; mysql_query("DELETE FROM notifs WHERE notifid='$notifid'"); echo "<script> window.location='../updates.php' </script>";}
if(isset($_GET['gotoevent'])){
	$notifid=$_GET['gotoevent'];
	$notifdo=mysql_query("SELECT * FROM notifs WHERE notifid=$notifid");
	while($notifget=mysql_fetch_array($notifdo)){
	mysql_query("UPDATE notifs SET notifseen='1' WHERE notifid='$notifid'");
	if(strlen($notifget['notiflink'])>0){echo "<script> window.location='../".$notifget['notiflink']."' </script>";}
	else{echo "<script> window.location='../updates.php' </script>";}
	}
}
?>
<html>
<head>
<title>Updates</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Alegreya+Sans:100,200,300,400' rel='stylesheet' type='text/css'>
<link href='css/ee.css' rel='stylesheet' type='text/css'>
<link href='css/notifs.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/ee.js"></script>
<?php include("php/stylesesh.php"); ?>
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
<div id="wide">
<div id="notifs"><div class="title">Updates from your network <a class="option" href="updates.php?markallread">(Mark all as read)</a></div>
<?php
require("php/eecon.php");
require("php/timeago.php");
$thid=$_SESSION['uzid'];
$notifdo=mysql_query("SELECT * FROM notifs WHERE notifuzid='$thid' ORDER BY notifid DESC");
while($notifget=mysql_fetch_array($notifdo)){
	if($notifget['notifseen']!="1"){echo "<div class='ntseenitem'>";}
	else{echo "<div class='yeseenitem'>";}
	echo "<a class='del' href='updates.php?del=".$notifget['notifid']."'>Delete</a><a class='event' href='updates.php?gotoevent=".$notifget['notifid']."'>".$notifget['notifmsg']."</a><a class='time' href='updates.php?gotoevent=".$notifget['notifid']."'>".ago($notifget['notifdt'])." ago</a>";
	echo "</div>";
}
?>
</div></div>
</body>
</html>