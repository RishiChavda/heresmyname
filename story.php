<?php
session_start();
require("php/sessions.php");
require("php/eecon.php");
require("php/notify.php");
if(isset($_GET['deletecomment'])){$commentid=$_GET['deletecomment']; $commentcheck=mysql_query("SELECT * FROM storycomments WHERE commentid='$commentid'"); $commentcount=mysql_num_rows($commentcheck); while($commentget=mysql_fetch_array($commentcheck)){if($commentget['commentuzid']==$_SESSION['uzid']){if($commentcount>0){mysql_query("DELETE FROM storycomments WHERE commentid='$commentid'");}} echo "<script> window.location='story.php?id=".$commentget['commentstoryid']."' </script>";}}
elseif(isset($_GET['fave'])){
$readeruzid=$_SESSION['uzid'];
$storyid=$_GET['fave'];
$checkstory=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
if(mysql_num_rows($checkstory)>0){
$checkfave=mysql_query("SELECT * FROM faves WHERE favuzid='$readeruzid' AND favstoryid='$storyid'");
if(mysql_num_rows($checkfave)=="0"){
while($storygetinfo=mysql_fetch_array($checkstory)){
$newsuzid=$_SESSION['uzid'];
$favenews=$_SESSION['fll']." favourited this story";
$newsdt=time();
$newsform="2";
mysql_query("INSERT INTO faves(favuzid, favstoryid) VALUES('$readeruzid', '$storyid')");
mysql_query("INSERT INTO news(newsuzid, newscapt, newspostid, newsdt, newsform) VALUES('$newsuzid','$favenews','$storyid','$newsdt', '$newsform')");
if($_SESSION['uzid']!==$storygetinfo['storyuzid']){notifywriter($storygetinfo['storyuzid'],$storyid,$storygetinfo['storyname'],"1");}
echo "<script> window.location='story.php?id=".$storyid."' </script>";
}}}}
elseif(isset($_GET['unfave'])){
$readeruzid=$_SESSION['uzid'];
$storyid=$_GET['unfave'];
mysql_query("DELETE FROM faves WHERE favuzid='$readeruzid' AND favstoryid='$storyid'");
echo "<script> window.location='story.php?id=".$storyid."' </script>";
}
elseif(isset($_GET['shelfappend'])){
$shelfuzid=$_SESSION['uzid'];
$storyid=$_GET['shelfappend'];
$checkshelf=mysql_query("SELECT * FROM shelf WHERE shelfuzid='$shelfuzid' AND shelfstoryid='$storyid'");
if(mysql_num_rows($checkshelf)=="0"){
$checkstory=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
if(mysql_num_rows($checkstory)>0){mysql_query("INSERT INTO shelf(shelfuzid, shelfstoryid) VALUES('$shelfuzid', '$storyid')");}
}
echo "<script> window.location='story.php?id=".$storyid."' </script>";
}
elseif(isset($_GET['shelfremove'])){
$shelfuzid=$_SESSION['uzid'];
$storyid=$_GET['shelfremove'];
$shelfcheck=mysql_query("SELECT * FROM shelf WHERE shelfuzid='$shelfuzid' AND shelfstoryid='$storyid'");
if(mysql_num_rows($shelfcheck)>0){mysql_query("DELETE FROM shelf WHERE shelfuzid='$shelfuzid' AND shelfstoryid='$storyid'");}
echo "<script> window.location='story.php?id=".$storyid."' </script>";
}
elseif(isset($_REQUEST['sharetome'])){
	$newsuzid=$_SESSION['uzid'];
	$newscapt=htmlspecialchars(stripslashes(mysql_real_escape_string($_POST['postcapt'])));
	$newspostid=htmlspecialchars(stripslashes(mysql_real_escape_string($_POST['ptpid'])));
	$newsdt=time();
	mysql_query("INSERT INTO news(newsuzid, newscapt, newspostid, newsdt) VALUES('$newsuzid','$newscapt','$newspostid','$newsdt')");
	header("location: story.php?id=".$newspostid);
}
elseif(isset($_GET['id'])){
$storyid=$_GET['id'];
$storydo=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
$storycount=mysql_num_rows($storydo);
if($storycount==0){echo "<script> window.location='404.php'; </script>";}
else{
while($storyinfo=mysql_fetch_array($storydo, MYSQL_BOTH)){
$writerid=$storyinfo['storyuzid'];
$storyname=$storyinfo['storyname'];
$writerdo=mysql_query("SELECT * FROM uzee WHERE uzid='$writerid'");#
while($userinfo=mysql_fetch_array($writerdo)){
echo "<html><head>";
echo "<title>".$storyname."</title>";
?>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Alegreya+Sans:500,400,300' rel='stylesheet' type='text/css'>
<link href='css/ee.css' rel='stylesheet' type='text/css'>
<link href='css/story.css' rel='stylesheet' type='text/css'>
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
<div id="wide"><div id="story">
<div id="names"><?php
if(strlen($storyinfo['storypartname'])>0){echo "<a id='story'>".$storyinfo['storyname']." - ".$storyinfo['storypartname']."</a>";}
else{echo "<a id='story'>".$storyinfo['storyname']."</a>";}
$writerid=$storyinfo['storyuzid'];
$checkuser=mysql_query("SELECT * FROM uzee WHERE uzid='$writerid'");
if(mysql_num_rows($checkuser)==1){echo "<a id='writer' href='profile.php?id=".$userinfo['uzid']."'>By ".$userinfo['fname']." ".$userinfo['lname']."</a>";}
echo "<div id='atts'>";
echo "<a class='infobit'>".$storyinfo['storyrating']."</a>";
if($storyinfo['storyrights']=="4"){echo "<a class='infobit'>No one (except the writer) can read this</a>";}
elseif($storyinfo['storyrights']=="3"){echo "<a class='infobit'>Only mutual followers of the writer can read this</a>";}
elseif($storyinfo['storyrights']=="2"){echo "<a class='infobit'>Only followers of the writer can read this</a>";}
elseif($storyinfo['storyrights']=="1"){echo "<a class='infobit'>Anyone can read this</a>";}
else{echo "<a class='infobit'>Anyone can read this</a>";}
echo "<a class='infobit'>".ucfirst($storyinfo['storycato'])."/".ucfirst($storyinfo['storycatt'])."</a>";
$favstoryid=$_GET['id'];
$favstorydo=mysql_query("SELECT * FROM faves WHERE favstoryid='$favstoryid'");
$favcount=mysql_num_rows($favstorydo);
if($favcount=="0"){echo "<a id='favecount' class='infobit'>No favourites</a>";}
elseif($favcount=="1"){echo "<a id='favecount' class='infobit'>1 favourite</a>";}
else{echo "<a id='favecount' class='infobit'>".mysql_num_rows($favstorydo)." favourites</a>";}
echo "</div>";
?>
</div>
<div id="descript"><?php
if(strlen($storyinfo['storydescript'])>0){echo $storyinfo['storydescript'];}
else{echo "The writer has not included a description for this story.";}
?></div>
<?php echo "<div id='newshare'><form action='story.php?sharetome' method='post'><input type='hidden' id='ptpid' name='ptpid' value='".$_GET['id']."'/><textarea class='postcapt' name='postcapt' placeholder='Write something...'></textarea><input type='submit' class='postshare' value='Share this post'/></form></div>"; ?>
<div id="buttons"><?php
echo "<a class='acts' href='read.php?id=".$storyinfo['storyid']."'>Read Now</a>";
echo "<a class='acts' id='sharestory'>Share</a>";
$shelfuzid=$_SESSION['uzid']; $storyid=$_GET['id'];
$checkshelf=mysql_query("SELECT * FROM shelf WHERE shelfuzid='$shelfuzid' AND shelfstoryid='$storyid'");
if(mysql_num_rows($checkshelf)=="0"){echo "<a class='acts' href='story.php?shelfappend=".$storyinfo['storyid']."'>Add to Shelf</a>";}
else{echo "<a class='facts' href='story.php?shelfremove=".$storyinfo['storyid']."'>Remove from Shelf</a>";}
$favuzid=$_SESSION['uzid']; $favstoryid=$_GET['id'];
$checkfav=mysql_query("SELECT * FROM faves WHERE favuzid='$favuzid' AND favstoryid='$favstoryid'");
if(mysql_num_rows($checkfav)=="0"){echo "<a class='acts' href='story.php?fave=".$storyinfo['storyid']."'>Favourite</a>";}
else{echo "<a class='facts' href='story.php?unfave=".$storyinfo['storyid']."'>Unfavourite</a>";}
echo "<a class='acts' id='showcomments'>Comments</a>";
if($_SESSION['uzid']==$storyinfo['storyuzid']){echo "<a class='acts' href='editstory.php?id=".$storyinfo['storyid']."'>Edit</a>";}
?></div>
<?php
require("php/eecon.php");
require("php/timeago.php");
$storyid=$_GET['id'];
$storyinfo=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
while($storyget=mysql_fetch_array($storyinfo, MYSQL_BOTH)){
$commentstoryid=$_GET['id'];
$commdo=mysql_query("SELECT * FROM storycomments WHERE commentstoryid='$commentstoryid' ORDER BY commentid DESC");
echo "<div id='comments'><div id='title'>Comments (".mysql_num_rows($commdo).")</div>";
while($commget=mysql_fetch_array($commdo, MYSQL_BOTH)){
$commuserid=$commget['commentuzid'];
$commuserdo=mysql_query("SELECT * FROM uzee WHERE uzid='$commuserid'");
while($commuserget=mysql_fetch_array($commuserdo, MYSQL_BOTH)){
echo "<div class='post'>";
if($commget['commentuzid']==$_SESSION['uzid'] || $storyget['storyuzid']==$_SESSION['uzid']){echo "<a class='del' href='story.php?deletecomment=".$commget['commentid']."'>Delete</a>";}
echo "<div class='top'><a class='name' href='profile.php?id=".$commget['commentuzid']."'> ".$commuserget['fname']." ".$commuserget['lname']."</a><a class='time'>posted ".ago(strtotime($commget['commentdt']))." ago</a></div><div class='content'>".$commget['commentcont']."</div></div>";}}
echo "<div id='postcomment'><form action='php/newstorycomment.php' method='post'><input type='hidden' name='storyid' value='".$_GET['id']."'/><textarea id='commentcontent' name='storycomment' placeholder='Write a comment...'></textarea><input type='submit' id='postnew' value='Post'/></form></div>";
echo "</div></div>";
echo "</div>";
}
}
}
}
}
else{echo "<script> window.location='stories.php' </script>";}
?>
</div>
</div>
</body>
</html>