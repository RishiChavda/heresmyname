<?php session_start(); require("php/sessions.php"); ?>
<html>
<head>
<title><?php echo "Searching '".htmlspecialchars(stripslashes(mysql_real_escape_string($_POST['terms'])))."'"; ?></title>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Bad+Script|Ubuntu|Lato|Tauri|Exo+2:100,200,300,400|Alegreya+Sans:400,300' rel='stylesheet' type='text/css'>
<link href='css/ee.css' rel='stylesheet' type='text/css'>
<link href='css/search.css' rel='stylesheet' type='text/css'>
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
<div id="main"><div id="searchbox">
<div id="mobilesearch"><form action="search.php" method="post"/><input type="text" name="terms" id="terms" placeholder="Find something..."/><input type="submit" id="go" value="Go"/></form></div>
<div id='heading'><?php echo "All results for '".htmlspecialchars(stripslashes(mysql_real_escape_string($_POST['terms'])))."'"; ?><div id='sort'><a id="showuser" class="sorters">People</a><a id="showstory" class="sorters">Stories</a></div></div><table><tr>
<td id="sidebar">
<?php
require("php/eecon.php");
$terms=htmlspecialchars(stripslashes(mysql_real_escape_string($_POST['terms'])));
echo "<a id='getuser' class='sorters'>People</a><a id='getstory' class='sorters'>Stories</a>";
echo "</td><td id='results'>";
$user=$terms;
$userdo=mysql_query("SELECT * FROM uzee WHERE fname='$user' OR lname='$user'");
if(mysql_num_rows($userdo)>0){
	while($userget=mysql_fetch_array($userdo)){
	echo "<div class='userentry'><a href='profile.php?id=".$userget['uzid']."'>";
	if(file_exists($userget['profpic'])){echo "<img class='pic' style='background-color:#".$userget['profcolour'].";' src='".$userget['profpic']."'/>";}
	else{echo "<img class='pic' style='background-color:#".$userget['profcolour'].";' src='img/default.png'/>";}
	echo "<span class='name'>".$userget['fname']." ".$userget['lname']."</span>";
	$followuzid=$_SESSION['uzid'];
	$followinguzid=$userget['uzid'];
	$followinguzid=$_GET['id'];
	$followcheck=mysql_query("SELECT * FROM follows WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");
	if(mysql_num_rows($followcheck)!=0){echo "<span class='follow'>Following</span>";}
	echo "</a></div>";
	}
}
else{echo "<div id='error'>No results found.</div>";}
$story=$terms;
$storydo=mysql_query("SELECT * FROM story WHERE storyname='$story' OR storypartname='$story'");
if(mysql_num_rows($storydo)>0){
	while($storyget=mysql_fetch_array($storydo)){
		$storyuzid=$storyget['storyuzid'];
		$userdo=mysql_query("SELECT * FROM uzee WHERE uzid='$storyuzid'");
			while($userget=mysql_fetch_array($userdo)){
			echo "<div class='storyentry'><a href='story.php?id=".$storyget['storyid']."'><div class='name'>".$storyget['storyname'];
			if(mysql_num_rows($userdo)>0){echo "<div class='writer'>By ".$userget['fname']." ".$userget['lname']."</div>";}
			$thid=$_SESSION['uzid'];
			$storyid=$storyget['storyid'];
			$followcheck=mysql_query("SELECT * FROM shelf WHERE shelfuzid='$thid' AND shelfstoryid='$storyid'");
			if(mysql_num_rows($followcheck)!="0"){echo "<span class='shelf'>Added to Shelf</span>";}
			echo "</div>";
			if(strlen($storyget['storyblurb'])>0){echo "<div class='blurb'>".substr($storyget['storyblurb'], 0, 100)."...</div>";}
			echo "</a></div>";
		}
	}
}
else{echo "<div id='error'>No results found.</div>";}
?>
</td>
</tr></table></div>
</div>
</body>
</html>