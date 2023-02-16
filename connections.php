<?php
session_start();
require("php/sessions.php");
require("php/eecon.php");
if($_GET['unfollow']){
$uzid=$_SESSION['uzid'];
$unfollowuzid=$_GET['unfollow'];
$unfollowdo=mysql_query("SELECT * FROM follows WHERE followuzid='$uzid' AND followinguzid='$unfollowuzid'");
$unfollowcheck=mysql_num_rows($unfollowdo);
if($unfollowcheck=="1"){
	$unfollower=mysql_query("DELETE FROM follows WHERE followuzid='$uzid' AND followinguzid='$unfollowuzid'");
	if($unfollower==true){echo "<script> window.location='connections.php' </script>";}
	else{echo "<script> window.location='connections.php' </script>";}
}
else{echo "<script> window.location='connections.php' </script>";}
}
elseif($_GET['block']){
$followuzid=$_SESSION['uzid'];
$followinguzid=$_GET['block'];
$blockbin="1";
$checkblockpf=mysql_query("SELECT * FROM follows WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");
$checkblockfp=mysql_query("SELECT * FROM follows WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");
$pfrows=mysql_num_rows($checkblockpf);
$fprows=mysql_num_rows($checkblockfp);
if($pfrows>0){mysql_query("UPDATE follows SET blockbin='$blockbin', controluzid='$followuzid' WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");}
else{mysql_query("INSERT INTO follows (followuzid, followinguzid, blockbin, controluzid) VALUES ('$followuzid', '$followinguzid', '$blockbin', '$followuzid')");}
if($fprows>0){mysql_query("UPDATE follows SET blockbin='$blockbin', controluzid='$followuzid' WHERE followuzid='$followinguzid' AND followinguzid='$followuzid'");}
else{mysql_query("INSERT INTO follows (followuzid, followinguzid, blockbin, controluzid) VALUES ('$followinguzid', '$followuzid', '$blockbin', '$followuzid')");}
echo "<script> window.location='connections.php' </script>";
}
?>
<html>
<head>
<title>What's New</title>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Bad+Script|Ubuntu|Lato|Tauri|Exo+2:100,200,300,400|Alegreya+Sans:100,200,300,400' rel='stylesheet' type='text/css'>
<link href='css/ee.css' rel='stylesheet' type='text/css'>
<link href='css/connections.css' rel='stylesheet' type='text/css'>
<?php include("php/stylesesh.php"); ?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/ee.js"></script>
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
<div id="main">
<div id="connections"><?php
echo "<table><tr>";
require("php/eecon.php");
$uzid=$_SESSION['uzid'];
$fido=mysql_query("SELECT * FROM follows WHERE followuzid='$uzid' AND blockbin!='1' ORDER BY followid DESC");
echo "<td id='following'><div class='title'>Following</div>";
while($figet=mysql_fetch_array($fido, MYSQL_BOTH)){
	$fiuzid=$figet['followinguzid'];
	$fiuzdo=mysql_query("SELECT * FROM uzee WHERE uzid='$fiuzid'");
	while($fiuzget=mysql_fetch_array($fiuzdo, MYSQL_BOTH)){echo "<div class='entry'><a class='name' href='profile.php?id=".$figet['followinguzid']."'>";
	if(file_exists($fiuzget['profpic'])){echo "<img src='".$fiuzget['profpic']."'/> ";}
	else{echo "<img src='img/default.png'/> ";}
	echo $fiuzget['fname']." ".$fiuzget['lname']."</a><a class='unfollow' href='connections.php?unfollow=".$figet['followinguzid']."'>Unfollow</a></div>";
	}
}
echo "</td>";
$frdo=mysql_query("SELECT * FROM follows WHERE followinguzid='$uzid' AND blockbin!='1' ORDER BY followid DESC");
echo "<td id='followers'><div class='title'>Followers</div>";
while($frget=mysql_fetch_array($frdo, MYSQL_BOTH)){
	$fruzid=$frget['followuzid'];
	$fruzdo=mysql_query("SELECT * FROM uzee WHERE uzid='$fruzid'");
	while($fruzget=mysql_fetch_array($fruzdo, MYSQL_BOTH)){echo "<div class='entry'><a class='name' href='profile.php?id=".$frget['followuzid']."'>";
	if(file_exists($fruzget['profpic'])){echo "<img src='".$fruzget['profpic']."'/> ";}
	else{echo "<img src='img/default.png'/> ";}
	echo $fruzget['fname']." ".$fruzget['lname']."</a><a class='block' href='connections.php?block=".$frget['followuzid']."'>Block</a></div>";
	}
}
echo "</td>";
echo "</tr></table>";
?></div>

<div id="mobileconnections"><?php
require("php/eecon.php");
$uzid=$_SESSION['uzid'];
$fido=mysql_query("SELECT * FROM follows WHERE followuzid='$uzid' AND blockbin!='1' ORDER BY followid DESC");
echo "<div id='following'><div class='title'>Following</div>";
while($figet=mysql_fetch_array($fido, MYSQL_BOTH)){
	$fiuzid=$figet['followinguzid'];
	$fiuzdo=mysql_query("SELECT * FROM uzee WHERE uzid='$fiuzid'");
	while($fiuzget=mysql_fetch_array($fiuzdo, MYSQL_BOTH)){echo "<div class='entry'><a class='name' href='profile.php?id=".$figet['followinguzid']."'>";
	if(file_exists($fiuzget['profpic'])){echo "<img src='".$fiuzget['profpic']."'/> ";}
	else{echo "<img src='img/default.png'/> ";}
	echo $fiuzget['fname']." ".$fiuzget['lname']."</a><a class='unfollow' href='connections.php?unfollow=".$figet['followinguzid']."'>Unfollow</a></div>";
	}
}
echo "</div>";
$frdo=mysql_query("SELECT * FROM follows WHERE followinguzid='$uzid' AND blockbin!='1' ORDER BY followid DESC");
echo "<div id='followers'><div class='title'>Followers</div>";
while($frget=mysql_fetch_array($frdo, MYSQL_BOTH)){
	$fruzid=$frget['followuzid'];
	$fruzdo=mysql_query("SELECT * FROM uzee WHERE uzid='$fruzid'");
	while($fruzget=mysql_fetch_array($fruzdo, MYSQL_BOTH)){echo "<div class='entry'><a class='name' href='profile.php?id=".$frget['followuzid']."'>";
	if(file_exists($fruzget['profpic'])){echo "<img src='".$fruzget['profpic']."'/> ";}
	else{echo "<img src='img/default.png'/> ";}
	echo $fruzget['fname']." ".$fruzget['lname']."</a><a class='block' href='connections.php?block=".$frget['followuzid']."'>Block</a></div>";
	}
}
echo "</div>";
?></div>

</div>
</body>
</html>