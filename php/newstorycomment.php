<?php
session_start();
require("sessions.php");
require("eecon.php");
require("notify.php");
if(isset($_POST['storycomment']) && strlen($_POST['storycomment'])>0){
$storyid=htmlspecialchars(mysql_real_escape_string($_POST['storyid']));
$storycheck=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
	while($storyinfo=mysql_fetch_array($storycheck)){
		if(mysql_num_rows($storycheck)>0){
		$commentstoryid=htmlspecialchars(mysql_real_escape_string($_POST['storyid']));
		$commentuzid=$_SESSION['uzid'];
		$commentcont=htmlspecialchars(mysql_real_escape_string($_POST['storycomment']));
		$commentdt=time();
		$commentdo=mysql_query("INSERT INTO storycomments(commentstoryid, commentuzid, commentcont, commentdt) VALUES('$commentstoryid', '$commentuzid', '$commentcont', '$commentdt')");
		if($commentdo==true){if($storyinfo['storyuzid']!=$_SESSION['uzid']){notifywriter($storyinfo['storyuzid'], $storyid, $storyinfo['storyname'],"");}
		echo "<script> window.location='../story.php?id=".$commentstoryid."' </script>";
		}
		}
	}
}
else{header("location: ../stories.php");}
?>