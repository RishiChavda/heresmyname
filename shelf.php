<?php
session_start();
require("php/sessions.php");
require("php/eecon.php");
if(isset($_REQUEST['delete'])){
	$shelfid=$_GET['delete'];
	$shelfcheck=mysql_query("SELECT * FROM shelf WHERE shelfid='$shelfid'");
	if(mysql_num_rows($shelfcheck)>0){mysql_query("DELETE FROM shelf WHERE shelfid='$shelfid'");}
	header("location: shelf.php");
}
?>
<html>
<head>
<title>Your Shelf</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Alegreya+Sans:400,300' rel='stylesheet' type='text/css'>
<link href='css/ee.css' rel='stylesheet' type='text/css'>
<link href='css/shelf.css' rel='stylesheet' type='text/css'>
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
<?php
echo "<div id='main'><div id='shelfmain'><div id='title'>Your Shelf</div>";
require("php/eecon.php");
$uzid=$_SESSION['uzid'];
$shelfdo=mysql_query("SELECT * FROM shelf WHERE shelfuzid='$uzid'");
if(mysql_num_rows($shelfdo)>0){
while($shelfget=mysql_fetch_array($shelfdo, MYSQL_BOTH)){
	$storyids=$shelfget['shelfstoryid'];
	$storydo=mysql_query("SELECT * FROM story WHERE storyid='$storyids'");
	while($storyget=mysql_fetch_array($storydo, MYSQL_BOTH)){
		$storyuzid=$storyget['storyuzid'];
		$uzdo=mysql_query("SELECT * FROM uzee WHERE uzid='$storyuzid'");
		while($uzget=mysql_fetch_array($uzdo, MYSQL_BOTH)){
			echo "<div class='item'>";
			echo "<div class='delete'><a href='shelf.php?delete=".$shelfget['shelfid']."'>Remove from Shelf</a></div>";
			echo "<a href='read.php?id=".$storyget['storyid']."'><div class='name'>".substr($storyget['storyname'],0,50);
			if(strlen($storyget['storypartname'])>0){echo " - ".substr($storyget['storypartname'],0,50);}
			echo "</div>";
			echo "<div class='writer'>".$uzget['fname']." ".$uzget['lname']."</div>";
			echo "<div class='rating'>".$storyget['storyrating']."</div></a>";
			echo "<div class='bottomdel'><a href='shelf.php?delete=".$shelfget['shelfid']."'>Remove from Shelf</a></div>";
			echo "</div>";
		}
	}
}
}
else{echo "<div id='nostory'>You haven't added any stories to your Shelf. You can do this by clicking the 'Add to Shelf' button whenever you see a story.</div>";}
echo "</div></div>";
?>
</body>
</html>