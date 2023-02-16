<?php session_start(); require("php/sessions.php"); ?>
<html>
<head>
<?php
require("php/eecon.php");
if(isset($_GET['favethis'])){
$readeruzid=$_SESSION['uzid'];
$storyid=$_GET['favethis'];
$checkstory=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
if(mysql_num_rows($checkstory)>0){
$checkfave=mysql_query("SELECT * FROM faves WHERE favuzid='$readeruzid' AND favstoryid='$storyid'");
if(mysql_num_rows($checkfave)=="0"){
	$newsuzid=$_SESSION['uzid'];
	$newsdt=time();
	$newsuzid=$_SESSION['uzid'];
	$favenews=$_SESSION['fll']." favourited this story";
	$newsform="2";
	mysql_query("INSERT INTO faves(favuzid, favstoryid) VALUES('$readeruzid', '$storyid')") or die(mysql_error());
	mysql_query("INSERT INTO news(newsuzid, newscapt, newspostid, newsdt, newsform) VALUES('$newsuzid','$favenews','$storyid','$newsdt', '$newsform')") or die(mysql_error());
	echo "<script> window.location='read.php?id=".$storyid."'; </script>";
}}}

elseif(isset($_GET['unfavethis'])){
	$readeruzid=$_SESSION['uzid'];
	$storyid=$_GET['unfavethis'];
	mysql_query("DELETE FROM faves WHERE favuzid='$readeruzid' AND favstoryid='$storyid'");
	echo "<script> window.location='read.php?id=".$storyid."'; </script>";
}

elseif(isset($_GET['shelfappend'])){
	$shelfuzid=$_SESSION['uzid'];
	$storyid=$_GET['shelfappend'];
	$checkshelf=mysql_query("SELECT * FROM shelf WHERE shelfuzid='$shelfuzid' AND shelfstoryid='$storyid'");
	if(mysql_num_rows($checkshelf)=="0"){
	$checkstory=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
	if(mysql_num_rows($checkstory)>0){mysql_query("INSERT INTO shelf(shelfuzid, shelfstoryid) VALUES('$shelfuzid', '$storyid')");}
	}
	echo "<script> window.location='shelf.php'; </script>";
}

elseif(isset($_GET['shelfremove'])){
	$shelfuzid=$_SESSION['uzid'];
	$storyid=$_GET['shelfremove'];
	$shelfcheck=mysql_query("SELECT * FROM shelf WHERE shelfuzid='$shelfuzid' AND shelfstoryid='$storyid'");
	if(mysql_num_rows($shelfcheck)>0){mysql_query("DELETE FROM shelf WHERE shelfuzid='$shelfuzid' AND shelfstoryid='$storyid'");}
	echo "<script> window.location='shelf.php'; </script>";
}

elseif(isset($_GET['id'])){
require("php/eecon.php");
$storyid=$_GET['id'];
$storydo=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
$storycount=mysql_num_rows($storydo);
if($storycount==0){echo "<script> window.location='404.php'; </script>";}
else{
while($storyinfo=mysql_fetch_array($storydo)){
$rights=$storyinfo['storyrights'];
if($rights=="2"){
$followuzid=$_SESSION['uzid'];
$followinguzid=$storyinfo['storyuzid'];
$followcheck=mysql_query("SELECT * FROM follows WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");
$followcount=mysql_num_rows($followcheck);
if($followcount=="0"){if($_SESSION['uzid']!=$storyinfo['storyuzid']){echo "<script> window.location='404.php' </script>";}}
}
elseif($rights=="3"){
$followuzid=$_SESSION['uzid'];
$followinguzid=$storyinfo['storyuzid'];
$readercheck=mysql_query("SELECT * FROM follows WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");
$readernum=mysql_num_rows($readercheck);
$writercheck=mysql_query("SELECT * FROM follows WHERE followuzid='$followinguzid' AND followinguzid='$followuzid'");
$writernum=mysql_num_rows($writercheck);
if($readernum=="0" || $writernum=="0"){if($_SESSION['uzid']!=$storyinfo['storyuzid']){echo "<script> window.location='404.php' </script>";}}
}
elseif($rights=="4"){$udid=$_SESSION['uzid']; $thid=$storyinfo['storyuzid']; if($udid!==$thid){echo "<script> window.location='404.php' </script>";}}
echo "<title>Reading '".$storyinfo['storyname']."'</title>";
?>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans|Open+Sans|Roboto|Lato|Tauri|Raleway|Arimo' rel='stylesheet' type='text/css'>
<link href='css/read.css' rel='stylesheet' type='text/css'>
<?php include("php/stylesesh.php"); ?>
<?php if(strlen($storyinfo['storyfont'])>0){echo "<style> #main #blurbbox #storydescript{font-family:'".$storyinfo['storyfont']."';} #main #storybox #storytext{font-family:'".$storyinfo['storyfont']."';} </style>";} ?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/storyshows.js"></script>
</head>
<body>
<div id="topbar">
<div id="topbuttons"><a class="toplink" href="discover.php"><img src="img/hmnw.png"/></a> <?php if(file_exists($_SESSION['profpic'])){echo "<a class='toplink' href='profile.php?id=".$_SESSION['uzid']."'><img src='".$_SESSION['profpic']."'/></a>";} else{echo "<a class='toplink' href='profile.php?id=".$_SESSION['uzid']."'><img src='img/default.png'/></a>";} ?></div>
<?php
$writerid=$storyinfo['storyuzid'];
$writerdo=mysql_query("SELECT * FROM uzee WHERE uzid='$writerid'");
if(mysql_num_rows($writerdo)>0){
	while($writerget=mysql_fetch_array($writerdo)){
	echo "<div id='names'><a id='storyname' href='story.php?id=".$storyinfo['storyid']."'>".$storyinfo['storyname'];
	if(strlen($storyinfo['storypartname'])>0){echo "<a id='storypart'>".$storyinfo['storypartname']."</a>";}
	echo "</a><a id='writer' href='profile.php?id=".$storyinfo['storyuzid']."'>By ".$writerget['fname']." ".$writerget['lname']."</a></div>";
	}
}
else{echo "<div id='names'><a id='storyname'>".$storyinfo['storyname']."</a>"; if(strlen($storyinfo['storypartname'])>0){echo "<a id='storypart'>".$storyinfo['storypartname']."</a>";} echo "</div>";}
?>
<div id="mainopts"><?php
if(strlen($storyinfo['storydescript'])>0){echo "<a id='openblurb'>Open Blurb</a>";}
$favuzid=$_SESSION['uzid'];
$favstoryid=$_GET['id'];
$checkfav=mysql_query("SELECT * FROM faves WHERE favuzid='$favuzid' AND favstoryid='$favstoryid'");
if(mysql_num_rows($checkfav)=="0"){echo "<a id='favourite' href='read.php?favethis=".$storyinfo['storyid']."'>Favourite</a>";}
else{echo "<a id='favourite' href='read.php?unfavethis=".$storyinfo['storyid']."'>Unfavourite</a>";}
$shelfuzid=$_SESSION['uzid'];
$storyid=$_GET['id'];
$checkshelf=mysql_query("SELECT * FROM shelf WHERE shelfuzid='$shelfuzid' AND shelfstoryid='$storyid'");
if(mysql_num_rows($checkshelf)=="0"){echo "<a id='shelfappend' href='read.php?shelfappend=".$storyinfo['storyid']."'>Add to Shelf</a>";}
else{echo "<a id='shelfappend' href='read.php?shelfremove=".$storyinfo['storyid']."'>Remove from Shelf</a>";}
?></div>
</div>
<div id="main">
<?php
$texttake=array('[PAGEBREAK]');
$textmake=array('<br><br>');
if(strlen($storyinfo['storydescript'])>0){echo "<div id='blurbbox'><div class='title'>Blurb/Description</div><div id='storydescript'>".nl2br(str_replace($texttake, $textmake, $storyinfo['storydescript']))."</div></div>";}
echo "<div id='storybox'><div id='storytext'>".nl2br(str_replace($texttake, $textmake, $storyinfo['storytext']))."</div></div>";
?>
</div>
<?php
}
}
}
else{echo "<script> window.location='stories.php' </script>";}
?>
</body>
</html>