<?php
session_start();
require("eecon.php");
require("sessions.php");
if($_GET['id']){
$shelfuzid=$_SESSION['uzid'];
$shelfstoryid=mysql_real_escape_string(htmlspecialchars($_GET['id']));
$storycheck=mysql_query("SELECT * FROM story WHERE storyid='$shelfstoryid'");
$storynum=mysql_num_rows($storycheck);
if($storynum=="1"){$shelfappend=mysql_query("INSERT INTO shelf(shelfuzid, shelfstoryid) VALUES('$shelfuzid', '$shelfstoryid')"); if($shelfappend==true){header("location: ../read.php?id=".$shelfstoryid);} else{header("location: ../read.php?id=".$shelfstoryid);}
}
else{header("location: ../read.php?id=".$shelfstoryid);}
}
elseif($_GET['del']){
$shelfuzid=$_SESSION['uzid'];
$shelfstoryid=mysql_real_escape_string(htmlspecialchars($_GET['id']));
$storycheck=mysql_query("SELECT * FROM story WHERE storyid='$shelfstoryid'");
$storynum=mysql_num_rows($storycheck);
if($storynum=="1"){$shelfappend=mysql_query("DELETE FROM shelf WHERE shelfuzid='$shelfuzid' AND shelfstoryid='$shelfstoryid'"); if($shelfappend==true){header("location: ../read.php?id=".$shelfstoryid);} else{header("location: ../read.php?id=".$shelfstoryid);}}
else{header("location: ../read.php?id=".$shelfstoryid);}
}
else{header("location: ../read.php?id=".$shelfstoryid);}
?>