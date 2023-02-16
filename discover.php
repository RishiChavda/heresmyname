<?php
session_start();
require("php/eecon.php");
require("php/sessions.php");
if(isset($_GET['shelfappend'])){
$shelfuzid=$_SESSION['uzid'];
$storyid=$_GET['shelfappend'];
$checkshelf=mysql_query("SELECT * FROM shelf WHERE shelfuzid='$shelfuzid' AND shelfstoryid='$storyid'") or die(mysql_error());
if(mysql_num_rows($checkshelf)=="0"){$checkstory=mysql_query("SELECT * FROM story WHERE storyid='$storyid'"); if(mysql_num_rows($checkstory)>0){mysql_query("INSERT INTO shelf(shelfuzid, shelfstoryid) VALUES('$shelfuzid', '$storyid')");}}
header("location: shelf.php");
}
if(isset($_REQUEST['sharetome'])){
$newsuzid=$_SESSION['uzid'];
$newscapt=htmlspecialchars(stripslashes(mysql_real_escape_string($_POST['postcapt'])));
$newspostid=htmlspecialchars(stripslashes(mysql_real_escape_string($_POST['ptpid'])));
$newsdt=time();
mysql_query("INSERT INTO news(newsuzid, newscapt, newspostid, newsdt, newsform) VALUES('$newsuzid','$newscapt','$newspostid','$newsdt', '1')");
header("location: discover.php");
}
if(isset($_REQUEST['deletepost'])){
$postid=$_GET['deletepost'];
$checkq=mysql_query("SELECT * FROM news WHERE newsid='$postid'");
while($doq=mysql_fetch_array($checkq)){if($doq['newsuzid']==$_SESSION['uzid']){mysql_query("DELETE FROM news WHERE newsid='$postid'");}}
header("location: discover.php");
}
?>
<html>
<head>
<title>Discover</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Alegreya+Sans:400,300,200,100' rel='stylesheet' type='text/css'>
<link href='css/ee.css' rel='stylesheet' type='text/css'>
<link href='css/discover.css' rel='stylesheet' type='text/css'>
<?php include("php/stylesesh.php"); ?>
<?php if(isset($_GET['cat'])){echo "<style> #posts #sorter{display:block;} </style>";} ?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/ee.js"></script>
<style>
#topbar #servmsg{width:auto; height:auto; padding:10px; background-color:#ffffff; color:#336CA6; font-family:'Alegreya Sans'; font-size:15px; border-bottom:3px solid #336CA6; text-align:center;}
#topbar #servmsg a{color:#336CA6; text-decoration:underline;}
</style>
</head>
<body>
<div id="topbar"><div id="servmsg"><marquee behavior="alternate" scrollamount="10" direction="left">Hey there! Did you know HeresMyName has <a href="https://www.facebook.com/heresmynameofficial">Facebook</a> and <a href="https://twitter.com/HeresMyNameNews">Twitter</a>?</marquee></div><table cellspacing="0" cellpadding="0"><tr>
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
<div class="item"><a href="discover.php">Log Out</a></div>
</div></div>
<div id="wide"><div id="news"><table cellspacing="0"><tr>
<td id="sidebar"><?php echo "<div id='sideprof'><div id='user'><a id='name' href='profile.php?id=".$_SESSION['uzid']."'>".$_SESSION['fll']."</a><a id='proflink' href='profile.php?id=".$_SESSION['uzid']."'>Go to profile</a></div></div>"; ?>
<div id="sidemenu">
<?php
	// if($_SESSION['super']="1"){echo "<a class='item' href='xq1001/'>ADMIN</a>";}
?>
<a class="item" href="stories.php">My Stories</a>
<a class="item" href="shelf.php">My Shelf</a>
<a class="item" href="connections.php">My Connections</a>
<a class="item" href="updates.php">Updates</a>
<a class="item" href="settings.php">Settings</a>
<a class="item" href="help.php">Help</a>
<a class="item" onClick="exithmn()">Log Out</a>
</div>
<div id="sidestory"><div id="subtitle">Your stories</div><?php
require("php/eecon.php");
$storyuzid=$_SESSION['uzid'];
$getstories=mysql_query("SELECT * FROM story WHERE storyuzid='$storyuzid' ORDER BY storytime DESC");
$storycount=mysql_num_rows($getstories);
if($storycount=="0"){echo "<div id='nostory'>Nothing to show... Yet!</div>";}
else{while($showstory=mysql_fetch_array($getstories)){echo "<div class='storyitem'>".$showstory['storyname']."<a class='link' href='editstory.php?id=".$showstory['storyid']."'>Edit</a><a class='link' href='read.php?id=".$showstory['storyid']."'>Read</a></div>";}}
?>
</div>
</td>
<td id="posts"><div id="newshare"><form action="discover.php?sharetome" method="post"><input type="hidden" id="ptpid" name="ptpid" value=""/><textarea class="postcapt" name="postcapt" placeholder="Write something..."></textarea><input type="submit" class="postshare" value="Share this post"/></form></div>
<div id="getsort">Sort stories</div>
<div id="sorter"><a class='sortopt' href='discover.php?cat=all'>Show all</a><a class='sortopt' href='discover.php?cat=science'>Science</a><a class='sortopt' href='discover.php?cat=humour'>Humour</a><a class='sortopt' href='discover.php?cat=biography'>Biography</a><a class='sortopt' href='discover.php?cat=action'>Action</a><a class='sortopt' href='discover.php?cat=mystery'>Mystery</a><a class='sortopt' href='discover.php?cat=horror'>Horror</a><a class='sortopt' href='discover.php?cat=fantasy'>Fantasy</a><a class='sortopt' href='discover.php?cat=romance'>Romance</a><a class='sortopt' href='discover.php?cat=supernatural'>Supernatural</a><a class='sortopt' href='discover.php?cat=drama'>Drama</a><a class='sortopt' href='discover.php?cat=war'>War</a><a class='sortopt' href='discover.php?cat=religion'>Religion</a><a class='sortopt' href='discover.php?cat=short'>Short</a><a class='sortopt' href='discover.php?cat=free'>Uncategorised</a></div>
<?php
require("php/eecon.php");
require("php/timeago.php");
if(isset($_GET['cat'])){$catname=$_GET['cat']; $getcats=mysql_query("SELECT * FROM story WHERE storycato='$catname' OR storycatt='$catname' ORDER BY storyid DESC"); if($catname==="all"){$getcats=mysql_query("SELECT * FROM story ORDER BY storyid DESC");} while($getstory=mysql_fetch_array($getcats)){$storyuzid=$getstory['storyuzid']; $userinfo=mysql_query("SELECT * FROM uzee WHERE uzid='$storyuzid'"); while($getuser=mysql_fetch_array($userinfo)){echo "<div class='post'><div class='top'>"; if(file_exists($getuser['profpic'])){echo "<img class='postpic' style='background-color:#".$getuser['profcolour'].";' src='".$getuser['profpic']."'/><a class='name' href='profile.php?id=".$getuser['uzid']."'>".$getuser['fname']." ".$getuser['lname']."</a>";} else{echo "<img class='postpic' style='background-color:#".$getuser['profcolour'].";' src='img/default.png'/><a class='name' href='profile.php?id=".$getuser['uzid']."'>".$getuser['fname']." ".$getuser['lname']."</a>";} echo "<div class='timestamp'><a href='discover.php?cat=".$getstory['storycato']."'>".ucfirst($getstory['storycato'])."</a>/<a href='discover.php?cat=".$getstory['storycatt']."'>".ucfirst($getstory['storycatt'])."</a></div></div><div class='window'>".substr($getstory['storyname'],0,50); if(strlen($getstory['storypartname'])!=0){echo " - ".substr($getstory['storypartname'],0,50);} echo "</div><div class='opts'><a class='option' href='story.php?id=".$getstory['storyid']."'>Info</a><a class='option' href='read.php?id=".$getstory['storyid']."'>Read now</a></div></div>";}}}
else{
$followuzid=$_SESSION['uzid'];
$followlist=mysql_query("SELECT * FROM follows WHERE followuzid='$followuzid' AND Blockbin=''");
if(mysql_num_rows($followlist)){
while($getfollower=mysql_fetch_array($followlist, MYSQL_BOTH)){
$fuzid=$getfollower['followinguzid'];
$thid=$_SESSION['uzid'];
$postlist=mysql_query("SELECT * FROM news WHERE newsuzid='$fuzid' ORDER BY newsid DESC");
$postlist=mysql_query("SELECT * FROM news WHERE newsuzid='$fuzid' OR newsuzid='$thid' ORDER BY newsid DESC");
while($getpost=mysql_fetch_array($postlist, MYSQL_BOTH)){
$storyid=$getpost['newspostid'];
$storylist=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
while($getstory=mysql_fetch_array($storylist, MYSQL_BOTH)){
$postuzid=$getpost['newsuzid'];
$userlist=mysql_query("SELECT * FROM uzee WHERE uzid='$postuzid'");
while($getuser=mysql_fetch_array($userlist, MYSQL_BOTH)){
if($getpost['newsform']=="1"){echo "<div class='post'><div class='top'>"; if(file_exists($getuser['profpic'])){echo "<img class='postpic' src='".$getuser['profpic']."'/><a class='name' href='profile.php?id=".$getuser['uzid']."'>".$getuser['fname']." ".$getuser['lname']."</a>";} else{echo "<img class='postpic' src='img/default.png'/><a class='name' href='profile.php?id=".$getuser['uzid']."'>".$getuser['fname']." ".$getuser['lname']."</a>";} echo "<div class='timestamp'>Posted ".ago($getpost['newsdt'])." ago</div></div><div class='caption'>".$getpost['newscapt']."</div><div class='window'>".$getstory['storyname']; if(strlen($getstory['storypartnamename'])>0){echo "<br>".$getstory['storypartname'];} echo "</div><div class='opts'><a class='option' href='discover.php?shelfappend='".$getpost['newspostid']."'>Add to Shelf</a><a id='x' class='openshare'>Share</a><a class='option' href='story.php?id=".$getpost['newspostid']."'>Info</a><a class='option' href='read.php?id=".$getpost['newspostid']."'>Read now</a>"; if($getuser['uzid']==$_SESSION['uzid']){echo "<a class='option' href='discover.php?deletepost=".$getpost['newsid']."'>Delete</a>";} echo "</div></div>";}
elseif($getpost['newsform']=="2"){echo "<div class='post'><div class='top'>"; if(file_exists($getuser['profpic'])){echo "<img class='postpic' src='".$getuser['profpic']."'/><a class='name' href='profile.php?id=".$getuser['uzid']."'>".$getuser['fname']." ".$getuser['lname']."</a>";} else{echo "<img class='postpic' src='img/default.png'/><a class='name' href='profile.php?id=".$getuser['uzid']."'>".$getuser['fname']." ".$getuser['lname']."</a>";} echo "<a class='timestamp'>favourited this story.</a></div>"; echo "<div class='window'>".$getstory['storyname']."<br>".$getstory['storypartname']."</div><div class='opts'><a class='option' href='story.php?id=".$getpost['newspostid']."'>Info</a><a class='option' href='read.php?id=".$getpost['newspostid']."'>Read now</a></div></div>";}
} // End While($getuser)
} // End While($getstory)
} // End While($getpost)
} // End If ($getfollower)
} // End If ($followlist)
else{
$storylist=mysql_query("SELECT * FROM story WHERE featured='1'");
while($getstory=mysql_fetch_array($storylist, MYSQL_BOTH)){echo "<div class='spost'><div class='top'><img class='postpic' src='img/hmnw.png'/><a class='sname'>HeresMyName</a><a class='timestamp'>Featured post</a></div><div class='window'>".$getstory['storyname']."<br>".$getstory['storypartname']."</div><div class='opts'><a class='option' href='story.php?id=".$getstory['storyid']."'>Info</a><a class='option' href='read.php?id=".$getstory['storyid']."'>Read now</a></div></div>";} // End While($getstory)
} // End ELSE 'Features'
} // End ELSE !$_GET['Cat']
?>
</td>
<td id="notifs"><div class="heading">What you missed</div><?php
$thid=$_SESSION['uzid'];
$notifdo=mysql_query("SELECT * FROM notifs WHERE notifuzid='$thid' ORDER BY notifid DESC LIMIT 15");
if(mysql_num_rows($notifdo)>"0"){
while($notifget=mysql_fetch_array($notifdo)){if($notifget['notifseen']!="1"){echo "<div class='ntseenitem'>";} else{echo "<div class='yeseenitem'>";} echo "<a class='event' href='updates.php?gotoevent=".$notifget['notifid']."'>".$notifget['notifmsg']."</a><a class='time' href='updates.php?gotoevent=".$notifget['notifid']."'>".ago($notifget['notifdt'])." ago</a></div>";}}
else{echo "<div id='nocontent'>Nothing to show here...</div>";}
?></td>
</tr></table></div></div>
</body>
</html>