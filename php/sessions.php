<?php
session_start();
require("eecon.php");
if($_SESSION['logged']=="1"){
$uzid=$_SESSION['uzid'];
$sessionquery = mysql_query("SELECT * FROM uzee WHERE uzid='$uzid'");
while($getsesh=mysql_fetch_array($sessionquery, MYSQL_BOTH)){
	$_SESSION['uzid']=$getsesh['uzid'];
	$_SESSION['fn']=$getsesh['fname'];
	$_SESSION['ln']=$getsesh['lname'];
	$_SESSION['fll']=$getsesh['fname']." ".$getsesh['lname'];
	$_SESSION['profpic']=str_replace("..", ".", $getsesh['profpic']);
	$_SESSION['themecolour']=$getsesh['themecolour'];
	$_SESSION['logged']="1";
	$_SESSION['super']=$getsesh['super'];
}
}
else{echo "<script> window.location='../permit.php' </script>";}
?>