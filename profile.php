<?php
session_start();
require("php/sessions.php");
require("php/eecon.php");
if(isset($_GET['shelfappend'])){
	$shelfuzid=$_SESSION['uzid'];
	$storyid=$_GET['shelfappend'];
	$checkshelf=mysql_query("SELECT * FROM shelf WHERE shelfuzid='$shelfuzid' AND shelfstoryid='$storyid'") or die(mysql_error());
	if(mysql_num_rows($checkshelf)=="0"){
		$checkstory=mysql_query("SELECT * FROM story WHERE storyid='$storyid'") or die(mysql_error());
		if(mysql_num_rows($checkstory)>0){mysql_query("INSERT INTO shelf(shelfuzid, shelfstoryid) VALUES('$shelfuzid', '$storyid')");}
	}
	header("location: shelf.php");
}
elseif(isset($_REQUEST['sharetome'])){
	$newsuzid=$_SESSION['uzid'];
	$newscapt=htmlspecialchars(mysql_real_escape_string($_POST['postcapt']));
	$newspostid=htmlspecialchars(mysql_real_escape_string($_POST['ptpid']));
	$newsdt=time();
	$newsform="1";
	mysql_query("INSERT INTO news(newsuzid, newscapt, newspostid, newsdt, newsform) VALUES('$newsuzid','$newscapt','$newspostid','$newsdt', '$newsform')");
	header("location: profile.php");
}
elseif(isset($_REQUEST['deletepost'])){
	$postid=$_GET['deletepost'];
	$checkq=mysql_query("SELECT * FROM news WHERE newsid='$postid'");
	while($doq=mysql_fetch_array($checkq)){if($doq['newsuzid']==$_SESSION['uzid']){mysql_query("DELETE FROM news WHERE newsid='$postid'");}}
	header("location: profile.php?id=".$_SESSION['uzid']);
}
elseif(!$_GET['id'] || $_GET['id']==""){echo "<script> window.location='profile.php?id=".$_SESSION['uzid']."' </script>";}
else{$profid=$_GET['id'];
$profdo=mysql_query("SELECT * FROM uzee WHERE uzid='$profid'");
if(mysql_num_rows($profdo)!=1){echo "<script> window.location='404.php' </script>";}
else{
while($profinfo=mysql_fetch_array($profdo)){
echo "<title>".$profinfo['fname']." ".$profinfo['lname']."</title>";
$followuzid=$_SESSION['uzid'];
$followinguzid=$_GET['id'];
$checkblockpf=mysql_query("SELECT * FROM follows WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");
$checkblockfp=mysql_query("SELECT * FROM follows WHERE followuzid='$followinguzid' AND followinguzid='$followuzid'");
while($pfget=mysql_fetch_array($checkblockpf, MYSQL_BOTH)){if($pfget['blockbin']=="1"){echo "<script> window.location='404.php' </script>";}}
while($fpget=mysql_fetch_array($checkblockfp, MYSQL_BOTH)){if($fpget['blockbin']=="1"){echo "<script> window.location='404.php' </script>";}}
?>
<html>
<head>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Alegreya+Sans:400,300' rel='stylesheet' type='text/css'>
<link href='css/ee.css' rel='stylesheet' type='text/css'>
<link href='css/profile.css' rel='stylesheet' type='text/css'>
<?php include("php/stylesesh.php"); ?>
<?php
if(strlen($profinfo['profcolour'])==6){
echo "<style>";
echo "#profpic img{background-color:#".$profinfo['profcolour']."; border:3px solid #".$profinfo['profcolour'].";}";
echo "#cover #profpic img{background-color:#".$profinfo['profcolour'].";}";
echo "#cover #info #name{color:#".$profinfo['profcolour'].";}";
echo "#cover #info #quote{color:#".$profinfo['profcolour'].";}";
echo "#cover #info #sub .infobit{color:#".$profinfo['profcolour'].";}";
echo "#cover #info #sub .infobit a{color:#".$profinfo['profcolour'].";}";
echo "#wide .story:hover{border:1px solid #".$profinfo['profcolour']."; background-color:#".$profinfo['profcolour'].";}";
echo "#wide .story .links a{background-color:#".$profinfo['profcolour'].";}";
echo "#wide .story .links a:hover{color:#".$profinfo['profcolour'].";}";
echo "#wide .title{color:#".$profinfo['profcolour'].";}";
echo "#wide #nostory{color:#".$profinfo['profcolour'].";}";
echo "#wide #shared .post .top .postpic{background-color:#".$profinfo['profcolour'].";}";
echo "</style>";
}
?>
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
<div id="wide"><?php
$backpic=str_replace("..", ".", $profinfo['backpic']);
if(file_exists($backpic)){echo "<div id='cover' style='background:url(".$profinfo['backpic'].") no-repeat center center; -webkit-background-size:cover; -moz-background-size:cover; -o-background-size:cover; background-size:cover; vertical-align:middle; text-align:center; padding:10px 0px 0px 0px;'>";}
else{echo "<div id='cover' style='background-color:#".$profinfo['themecolour'].";'>";}
$profpic=str_replace("..", ".", $profinfo['profpic']);
if(file_exists($profpic)){	echo "<div id='profpic'><img src='".$profinfo['profpic']."'/></div>";}
else{echo "<div id='profpic'><img src='img/default.png'/></div>";}
echo "<div id='info'>";
echo "<div id='name'>".$profinfo['fname']." ".$profinfo['lname']."</div>";
echo "<div id='quote'>".$profinfo['favqu']."</div>";
echo "<div id='sub'>";
if(strlen($profinfo['occup'])>0){echo "<span class='infobit'>".$profinfo['occup']."</span>";}
if(strlen($profinfo['location'])>0){echo "<span class='infobit'>Lives in ".$profinfo['location']."</span>";}
if(strlen($profinfo['uzurl'])>0){echo "<span class='infobit'><a href='http://".$profinfo['uzurl']."'>".$profinfo['uzurl']."</a></span>";}
echo "</div>";
require("php/eecon.php");
$followuzid=$_SESSION['uzid'];
$followinguzid=$_GET['id'];
if($followuzid!=$followinguzid){
$followuzid=$_SESSION['uzid'];
$followinguzid=$_GET['id'];
$followcheck=mysql_query("SELECT * FROM follows WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");
$followcount=mysql_num_rows($followcheck);
if($followcount=="0"){echo "<a id='followlink' href='php/follows.php?follow=".$_GET['id']."'>Follow</a> <a id='blocklink' href='php/follows.php?block=".$_GET['id']."'>Block</a>";}
else{echo "<a id='followstatus'>Following </a><a id='followlink' href='php/follows.php?unfollow=".$_GET['id']."'>Unfollow</a> <a id='blocklink' href='php/follows.php?block=".$_GET['id']."'>Block</a>";}
}
echo "</div>";
echo "</div>";
?>
<div id="leftinfo">
<div id="ame"><?php echo $profinfo['ame'];?></div>
</div>
<div id="rightmain"><div class="title">Stories</div><?php
require("php/eecon.php");
$profid=$_GET['id'];
$storyget=mysql_query("SELECT * FROM story WHERE storyuzid='$profid' ORDER BY storytime DESC");
$storycount=mysql_num_rows($storyget);
if($storycount>0){
while($bget=mysql_fetch_array($storyget, MYSQL_BOTH)){
	echo "<div class='story'><div class='name'>".substr($bget['storyname'],0,50)."</div>";
	if(strlen($bget['storypartnamename'])!=0){echo "<div class='sub'>".substr($bget['storypartnamename'],0,50)."</div>";}
	echo "<div class='links'><a href='read.php?id=".$bget['storyid']."'>Read</a> <a href='story.php?id=".$bget['storyid']."'>Info</a>";
	if($_SESSION['uzid']==$_GET['id']){echo " <a href='editstory.php?id=".$bget['storyid']."'>Edit</a>";}
	echo "</div>";
	echo "</div>";
}
}
else{echo "<div id='nostory'>This user hasn't written any stories (yet).</div>";}
}}
?>
<div id="shared"><div class="title">Shared</div>
<div id="newshare"><form action="profile.php?sharetome" method="post"><input type="hidden" id="ptpid" name="ptpid" value=""/><textarea class="postcapt" name="postcapt" placeholder="Write something..."></textarea><input type="submit" class="postshare" value="Share this post"/></form></div>
<?php
require("php/eecon.php");
require("php/timeago.php");
$followuzid=$_GET['id'];
$postlist=mysql_query("SELECT * FROM news WHERE newsuzid='$followuzid' AND newsform='1' ORDER BY newsid DESC");
if(mysql_num_rows($postlist)>0){
while($getpost=mysql_fetch_array($postlist, MYSQL_BOTH)){
$storyid=$getpost['newspostid'];
$storylist=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
while($getstory=mysql_fetch_array($storylist, MYSQL_BOTH)){
$postuzid=$getpost['newsuzid'];
$userlist=mysql_query("SELECT * FROM uzee WHERE uzid='$postuzid'");
while($getuser=mysql_fetch_array($userlist, MYSQL_BOTH)){echo "<div class='post'><div class='top'>"; if(file_exists($getuser['profpic'])){echo "<img class='postpic' src='".$getuser['profpic']."'/><a class='name' href='profile.php?id='".$getpost['newsid']."'>".$getuser['fname']." ".$getuser['lname']."</a>";} else{echo "<img class='postpic' src='img/default.png'/><a class='name' href='profile.php?id='".$getfollower['followinguzid']."'>".$getuser['fname']." ".$getuser['lname']."</a>";} echo "<div class='timestamp'>Posted ".ago($getpost['newsdt'])." ago</div></div><div class='caption'>".$getpost['newscapt']."</div><div class='window'>".$getstory['storyname']."<br>".$getstory['storypartname']."</div>";} echo "<div class='opts'><a id='".$getpost['newspostid']."' class='openshare' href='#shared'>Share</a><a class='option' href='read.php?id=".$getpost['newspostid']."'>Read now</a><a class='option' href='profile.php?shelfappend=".$getpost['newspostid']."'>Add to Shelf</a><a class='option' href='story.php?id=".$getpost['newspostid']."'>Comments</a>"; if($_GET['id']==$_SESSION['uzid']){echo "<a class='option' href='profile.php?deletepost=".$getpost['newsid']."'>Delete</a>";} echo "</div></div>";}}}
else{echo "<div id='nocontent'>User has not shared any content...</div>";}
} // onClick='scrollpageup()'
?>
</div>
</div>
</div>
</body>
</html>