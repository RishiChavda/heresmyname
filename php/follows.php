<?php
session_start();
require("sessions.php");
require("eecon.php");
require("notify.php");
if($_GET['follow']){
$followuzid=$_SESSION['uzid'];
$followinguzid=mysql_real_escape_string(htmlspecialchars($_GET['follow']));
$followcheck=mysql_query("SELECT * FROM follows WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");
if(mysql_num_rows($followcheck)==0){
$followdo=mysql_query("INSERT INTO follows (followuzid, followinguzid) VALUES ('$followuzid', '$followinguzid')") or die(mysql_error());
if($followdo=true){notifyfollow($followinguzid); echo "<script> window.location='../profile.php?id=".$followinguzid."' </script>";}
else{echo "<script> window.location='../error.php?requestfailed' </script>";}
}
else{
while($followget=mysql_fetch_array($followcheck, MYSQL_BOTH)){
if($followget['blockbin']=="1"){header("location: ../404.php");}
else{header("location: ../profile.php?id=".$followinguzid);}
}}}
if(mysql_real_escape_string(htmlspecialchars($_GET['unfollow']))){
$followuzid=$_SESSION['uzid'];
$followinguzid=$_GET['unfollow'];
$followcheck=mysql_query("DELETE FROM follows WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");
if($followcheck==true){header("location: ../profile.php?id=".$followinguzid);}
else{header("location: ../error.php?requestfailed");}
}
if($_GET['block']){
$followuzid=$_SESSION['uzid'];
$followinguzid=mysql_real_escape_string(htmlspecialchars($_GET['block']));
$blockbin="1";
$checkblockpf=mysql_query("SELECT * FROM follows WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");
$checkblockfp=mysql_query("SELECT * FROM follows WHERE followuzid='$followinguzid' AND followinguzid='$followuzid'");
$pfrows=mysql_num_rows($checkblockpf);
$fprows=mysql_num_rows($checkblockfp);
if($pfrows>0){mysql_query("UPDATE follows SET blockbin='$blockbin', controluzid='$followuzid' WHERE followuzid='$followuzid' AND followinguzid='$followinguzid'");}
else{mysql_query("INSERT INTO follows (followuzid, followinguzid, blockbin, controluzid) VALUES ('$followuzid', '$followinguzid', '$blockbin', '$followuzid')");}
if($fprows>0){mysql_query("UPDATE follows SET blockbin='$blockbin', controluzid='$followuzid' WHERE followuzid='$followinguzid' AND followinguzid='$followuzid'");}
else{mysql_query("INSERT INTO follows (followuzid, followinguzid, blockbin, controluzid) VALUES ('$followinguzid', '$followuzid', '$blockbin', '$followuzid')");}
header("location: ../profile.php?id=".$_SESSION['uzid']);
}
?>