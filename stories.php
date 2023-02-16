<?php
session_start();
require("php/sessions.php");
require("php/eecon.php");
if(isset($_GET['deletestory'])){
$uzid=$_SESSION['uzid'];
$storyid=$_GET['deletestory'];
$storycheck=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
while($storyget=mysql_fetch_array($storycheck)){
if($uzid==$storyget['storyuzid']){if(mysql_num_rows($storycheck)>0){mysql_query("DELETE FROM story WHERE storyid='$storyid'"); mysql_query("DELETE FROM shelf WHERE shelfstoryid='$storyid'");}}
else{header("location: stories.php");}
}
header("location: stories.php");
}
if(isset($_GET['deletedraft'])){
$uzid=$_SESSION['uzid'];
$draftid=$_GET['deletedraft'];
$draftcheck=mysql_query("SELECT * FROM draft WHERE draftid='$draftid'");
while($draftget=mysql_fetch_array($draftcheck)){
if($uzid==$draftget['draftuzid']){if(mysql_num_rows($draftcheck)>0){mysql_query("DELETE FROM draft WHERE draftid='$draftid'");}}
else{header("location: stories.php");}
}
header("location: stories.php");
}
if(isset($_GET['createstory'])){
	$uzid=$_SESSION['uzid'];
	$draftid=$_GET['createstory'];
	$draftcheck=mysql_query("SELECT * FROM draft WHERE draftid='$draftid'");
	if(mysql_num_rows($draftcheck)>0){
	while($draftget=mysql_fetch_array($draftcheck)){
	if($uzid==$draftget['draftuzid']){
		$storyname=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $draftget['draftname'])));
		$storypartname=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $draftget['draftpartname'])));
		$storyuzid=$_SESSION['uzid'];
		$storyrights=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $draftget['draftrights'])));
		$storyrating=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $draftget['draftrating'])));
		$storydescript=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $draftget['draftdescript'])));
		$storytext=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $draftget['drafttext'])));
		$storytime=time();
		$storyfont=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $draftget['draftfont'])));
		$storycateo=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($draftget['draftcato']))));
		$storycatet=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($draftget['draftcatt']))));
		$createstory=mysql_query("INSERT INTO story (storyname, storypartname, storyuzid, storyrights, storyrating, storydescript, storytext, storytime, storyfont, storycato, storycatt) VALUES('$storyname', '$storypartname', '$storyuzid', '$storyrights', '$storyrating', '$storydescript', '$storytext', '$storytime', '$storyfont', '$storycateo', '$storycatet')");
		if($createstory==true){header("location: ../stories.php");}
		else{header("location: ../error.php?requestfailed");}
	}
	else{} // User is not creator
	} // While loop
	}
	else{} // No draft exists
}
?>
<html>
<head>
<title>Your Stories/Drafts</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Alegreya+Sans:400,300' rel='stylesheet' type='text/css'>
<link href='css/ee.css' rel='stylesheet' type='text/css'>
<link href='css/stories.css' rel='stylesheet' type='text/css'>
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
require("php/eecon.php");
$uzid=$_SESSION['uzid'];
echo "<div id='main'><div id='stories'><table><tr>";
$storydo=mysql_query("SELECT * FROM story WHERE storyuzid='$uzid' ORDER BY storyid DESC");
echo "<td id='storylist'><div class='title'>Stories (".mysql_num_rows($storydo).")</div>";
while($storyget=mysql_fetch_array($storydo)){echo "<div class='entry'><div class='options'><a href='read.php?id=".$storyget['storyid']."'>Read</a><a href='story.php?id=".$storyget['storyid']."'>Info</a><a href='editstory.php?id=".$storyget['storyid']."'>Edit</a><a class='deleteconf' href='stories.php?deletestory=".$storyget['storyid']."'>Delete</a></div><div class='storyname'>".$storyget['storyname']."</div></div>";}
echo "</td>";
$uzid=$_SESSION['uzid'];
$draftdo=mysql_query("SELECT * FROM draft WHERE draftuzid='$uzid' ORDER BY draftid DESC");
echo "<td id='draftlist'><div class='title'>Drafts (".mysql_num_rows($draftdo).")</div>";
while($draftget=mysql_fetch_array($draftdo)){echo "<div class='entry'><div class='options'><a class='' href='editdraft.php?id=".$draftget['draftid']."'>Edit</a><a class='makestory' href='stories.php?createstory=".$draftget['draftid']."'>Create Story</a><a class='deleteconf' href='stories.php?deletedraft=".$draftget['draftid']."'>Delete</a></div><div class='storyname'>".$draftget['draftname']."</div></div>";}
echo "</td>";
echo "</tr></table>";
echo "<div id='mobilestories'>";
$uzid=$_SESSION['uzid'];
echo "<div id='main'><div id='stories'><table><tr>";
$storydo=mysql_query("SELECT * FROM story WHERE storyuzid='$uzid' ORDER BY storyid DESC");
echo "<div id='storylist'><div class='title'>Stories (".mysql_num_rows($storydo).")</div>";
while($storyget=mysql_fetch_array($storydo)){echo "<div class='entry'><div class='options'><a href='read.php?id=".$storyget['storyid']."'>Read</a><a href='story.php?id=".$storyget['storyid']."'>Info</a><a href='editstory.php?id=".$storyget['storyid']."'>Edit</a><a class='deleteconf' href='stories.php?deletestory=".$storyget['storyid']."'>Delete</a></div><div class='storyname'>".$storyget['storyname']."</div></div>";}
echo "</div>";
$uzid=$_SESSION['uzid'];
$draftdo=mysql_query("SELECT * FROM draft WHERE draftuzid='$uzid' ORDER BY draftid DESC");
echo "<div id='draftlist'><div class='title'>Drafts (".mysql_num_rows($draftdo).")</div>";
while($draftget=mysql_fetch_array($draftdo)){echo "<div class='entry'><div class='options'><a class='' href='editdraft.php?id=".$draftget['draftid']."'>Edit</a><a class='makestory' href='stories.php?createstory=".$draftget['draftid']."'>Create Story</a><a class='deleteconf' href='stories.php?deletedraft=".$draftget['draftid']."'>Delete</a></div><div class='storyname'>".$draftget['draftname']."</div></div>";}
echo "</div></div></div>";
?>
</body>
</html>