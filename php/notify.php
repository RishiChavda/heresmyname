<?php
session_start();
require("eecon.php");
require("sessions.php");
function notifyfollow($uzid){
	$notifuzid=mysql_real_escape_string(htmlspecialchars($_GET['follow']));
	$uzdo=mysql_query("SELECT * FROM uzee WHERE uzid='$notifuzid'");
	$uzct=mysql_num_rows($uzdo);
	$notifmsg=$_SESSION['fll']." started following you";
	$notiflink="profile.php?id=";
	$notiflink.=$_SESSION['uzid'];
	$notifdt=time();
	$notifseen="";
	mysql_query("INSERT INTO notifs(notifuzid, notifmsg, notiflink, notifdt, notifseen) VALUES('$notifuzid', '$notifmsg', '$notiflink', '$notifdt', '$notifseen')");
}
function notifywriter($uzid, $storyid, $storyname, $eventmsg){
	$writeruzid=$uzid;
	$notifmsg=$_SESSION['fll']." commented on your story";
	if($eventmsg=="1"){$notifmsg=$_SESSION['fll']." favourited your story.";}
	$notiflink="story.php?id=";
	$notiflink.=$storyid;
	$notifdt=time();
	mysql_query("INSERT INTO notifs(notifuzid, notifmsg, notiflink, notifdt) VALUES('$writeruzid', '$notifmsg', '$notiflink', '$notifdt')");
}
?>