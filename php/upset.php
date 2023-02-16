<?php
session_start();
require("sessions.php");
require("eecon.php");
if(!$_POST){header("../settings.php");}
$setuzid=$_SESSION['uzid'];
$setdo=mysql_query("SELECT * FROM uzee WHERE uzid='$setuzid'");
while($setget=mysql_fetch_array($setdo)){
if(isset($_REQUEST['general'])){	
$fname = htmlspecialchars(mysql_real_escape_string($_POST['fname']));
if(strlen($fname)<1){$fname=$setget['fname'];}
$lname = htmlspecialchars(mysql_real_escape_string($_POST['lname']));
if(strlen($lname)<1){$lname=$setget['lname'];}
$birthday = htmlspecialchars(mysql_real_escape_string($_POST['birthday']));
if(strlen($birthday)<1){$birthday=$setget['birthday'];}
$birthmonth = htmlspecialchars(mysql_real_escape_string($_POST['birthmonth']));
if(strlen($birthmonth)<1){$birthmonth=$setget['birthmonth'];}
$birthyear = htmlspecialchars(mysql_real_escape_string($_POST['birthyear']));
if(strlen($birthyear)<1){$birthyear=$setget['birthyear'];}
$location = htmlspecialchars(mysql_real_escape_string($_POST['location']));
if(strlen($location)<1){$location=$setget['location'];}
$occup = htmlspecialchars(mysql_real_escape_string($_POST['occup']));
if(strlen($occup)<1){$occup=$setget['occup'];}
$favqu = htmlspecialchars(mysql_real_escape_string($_POST['favqu']));
if(strlen($favqu)<1){$favqu=$setget['favqu'];}
$uzurl = htmlspecialchars(mysql_real_escape_string($_POST['uzurl']));
if(strlen($uzurl)<1){$uzurl=$setget['uzurl'];}
$ame = htmlspecialchars(mysql_real_escape_string($_POST['ame']));
if(strlen($ame)<1){$ame=$setget['ame'];}
$fname = ucfirst(strtolower($fname));
$lname = ucfirst(strtolower($lname));
$location = ucfirst(strtolower($location));
$occup = ucfirst(strtolower($occup));
$updategeneral=mysql_query("UPDATE uzee SET fname='$fname', lname='$lname', birthday='$birthday', birthmonth='$birthmonth', birthyear='$birthyear', location='$location', occup='$occup', favqu='$favqu', uzurl='$uzurl', ame='$ame' WHERE uzid='$setuzid'");
if($updategeneral==true){$_SESSION['update']="0"; header("location: ../settings.php?tab=general");}
else{$_SESSION['update']="1"; header("location: ../settings.php?tab=general");}
}

if(isset($_REQUEST['email'])){
$setuzid=$_SESSION['uzid'];
$newemail = htmlspecialchars(mysql_real_escape_string($_POST['email']));
$emailcheck=mysql_query("SELECT * FROM uzee WHERE email='$newemail'");
if(mysql_num_rows($emailcheck)>0){$_SESSION['eupdate']="1";}
else{
	if(strlen($newemail)>=8){$updatemail=mysql_query("UPDATE uzee SET email='$newemail' WHERE uzid='$setuzid'"); if($updatemail==true){$_SESSION['update']="0";} else{$_SESSION['update']="1";}}
	else{$_SESSION['update']="1";}
}
header("location: ../settings.php?tab=email");
}

if(isset($_REQUEST['password'])){
$setuzid=$_SESSION['uzid'];
$oldpass = md5(htmlspecialchars(mysql_real_escape_string($_POST['oldpass'])));
$newpass = md5(htmlspecialchars(mysql_real_escape_string($_POST['newpass'])));
if(strlen($oldpass)>7){
if(strlen($newpass)>7){
if($oldpass==$setget['password']){
$passchange=mysql_query("UPDATE uzee SET password='$newpass' WHERE uzid='$setuzid'") or die(mysql_error());
if($passchange==true){$_SESSION['pupdate']="0";}
else{$_SESSION['pupdate']="1";}
}
else{$_SESSION['pupdate']="3";}
}
else{$_SESSION['pupdate']="2";}
}
else{$_SESSION['pupdate']="2";}
header("location: ../settings.php?tab=password");
}

if(isset($_REQUEST['design'])){
$themecolour = htmlspecialchars(mysql_real_escape_string($_POST['themecolour']));
if(strlen($themecolour)!=6){$themecolour=$setget['themecolour'];}
$profcolour = htmlspecialchars(mysql_real_escape_string($_POST['profcolour']));
if(strlen($profcolour)!=6){$profcolour=$setget['profcolour'];}
$updatedesign=mysql_query("UPDATE uzee SET themecolour='$themecolour', profcolour='$profcolour' WHERE uzid='$setuzid'");
if($updatedesign==true){$_SESSION['update']="0"; header("location: ../settings.php?tab=design");}
else{$_SESSION['update']="1"; header("location: ../settings.php?tab=design");}
}
if(isset($_REQUEST['profilepicture'])){
if($_FILES['newprofpic']['size'] > 0){
require("eecon.php");
require("sessions.php");
$uzid=$_SESSION['uzid'];
$target = "../user/".basename($_FILES['newprofpic']['name']); 
function findexts ($filename){
$filename = strtolower($filename);
$exts = split("[/\\.]", $filename);
$n = count($exts)-1; 
$exts = ".".$exts[$n]; 
return $exts;
}
$ext = findexts($_FILES['newprofpic']['name']);
$types = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');
if(in_array($_FILES['newprofpic']['type'], $types)){
$ran = rand();
$target = $target.$ran.$ext;
$newname = $ran.$ext;
$filelocation = "../user/".$ran.$ext;
$ppreplace=mysql_query("SELECT * FROM uzee WHERE uzid='$uzid'");
while($ppdo=mysql_fetch_array($ppreplace)){
$current=$ppdo['profpic'];
if(file_exists($current)){unlink($current);}
$rancheck=mysql_query("SELECT * FROM uzee WHERE profpic='$filelocation'");
	if(mysql_num_rows($rancheck)==0){
		move_uploaded_file($_FILES['newprofpic']['tmp_name'], $filelocation);
		mysql_query("UPDATE uzee SET profpic='$filelocation' WHERE uzid='$uzid'");
		$_SESSION['update']=="0";
		header("location: ../settings.php?tab=profilepicture");
	}
	else{$_SESSION['update']="1"; header("location: ../settings.php?tab=profilepicture");}
}
}
else{$_SESSION['update']="2"; header("location: ../settings.php?tab=profilepicture");}
}
else{$_SESSION['update']="2"; header("location: ../settings.php?tab=profilepicture");}
}
if(isset($_REQUEST['coverpic'])){
if($_FILES['newbackpic']['size'] > 0){
require("eecon.php");
require("sessions.php");
$uzid=$_SESSION['uzid'];
$target = "../user/".basename( $_FILES['newbackpic']['name']); 
function findexts ($filename){
$filename = strtolower($filename);
$exts = split("[/\\.]", $filename);
$n = count($exts)-1; 
$exts = ".".$exts[$n]; 
return $exts; 
}
$ext = findexts($_FILES['newbackpic']['name']); 
$types = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');
if(in_array($_FILES['newbackpic']['type'], $types)){
$ran = rand();
$target = $target.$ran.$ext;
$newname = $ran.$ext;
$filelocation = "../user/".$ran.$ext;
$bbreplace=mysql_query("SELECT * FROM uzee WHERE uzid='$uzid'");
while($bbdo=mysql_fetch_array($bbreplace)){
$current=$bbdo['backpic'];
if(file_exists($current)){unlink($current);}
$rancheck=mysql_query("SELECT * FROM uzee WHERE backpic='$filelocation'");
	if(mysql_num_rows($rancheck)==0){
		move_uploaded_file($_FILES['newbackpic']['tmp_name'], $filelocation);
		mysql_query("UPDATE uzee SET backpic='$filelocation' WHERE uzid='$uzid'");
		header("location: ../settings.php?tab=profilecover");
	}
	else{$_SESSION['update']="1"; header("location: ../settings.php?tab=profilecover");}
}
}
else{$_SESSION['update']="2"; header("location: ../settings.php?tab=profilecover");}
}
else{$_SESSION['update']="2"; header("location: ../settings.php?tab=profilecover");}
}
if($_GET['unfollow']){
$followuzid=$_SESSION['uzid'];
$followinguzid=$_GET['unfollow'];
$blockbin="1";
$checkblockdo=mysql_query("SELECT * FROM follows WHERE followuzid='$followuzid' AND followinguzid='$followinguzid' AND controluzid='$followuzid'");
while($checkget=mysql_fetch_array($checkblockdo)){
if($checkget['controluzid']==$followuzid){
	$unblockid=$checkget['followid'];
	$unblockdo=mysql_query("DELETE FROM follows WHERE followid='$unblockid'");
	if($unblockdo==true){$_SESSION['update']=="0";}
	else{$_SESSION['update']=="1";}
	$ctid=$_SESSION['uzid'];
	$ctdo=mysql_query("SELECT * FROM follows WHERE followinguzid='$ctid' AND blockbin='$blockbin' AND controluzid='$ctid'");
	$ctcnt=mysql_num_rows($ctdo);
	if($ctcnt>0){mysql_query("DELETE FROM follows WHERE followinguzid='$ctid' AND blockbin='$blockbin' AND controluzid='$ctid'");}
}
else{$_SESSION['update']=="1";}
}
header("location: ../settings.php?tab=blocking");
}
if(isset($_REQUEST['profpicdel'])){
require("eecon.php");
$setuzid=$_SESSION['uzid'];
$getprofpic=mysql_query("SELECT * FROM uzee WHERE uzid='$setuzid'");
while($getpath=mysql_fetch_array($getprofpic)){
if(file_exists($getpath['profpic'])){
	$del=unlink($getpath['profpic']);
	if($del==true){
		$dbdel=mysql_query("UPDATE uzee SET profpic='' WHERE uzid='$setuzid'");
		if($dbdel==true){$_SESSION['profupdate']="0";}
		else{$_SESSION['profupdate']="1";}
	}
	else{$_SESSION['profupdate']="1";}
}
else{$_SESSION['profupdate']="1";}
header("location: ../settings.php?tab=profilepicture");
}
}
if(isset($_REQUEST['backpicdel'])){
require("eecon.php");
$setuzid=$_SESSION['uzid'];
$getbackpic=mysql_query("SELECT * FROM uzee WHERE uzid='$setuzid'");
while($getpath=mysql_fetch_array($getbackpic)){
if(file_exists($getpath['backpic'])){
	$del=unlink($getpath['backpic']);
	if($del==true){
		$dbdel=mysql_query("UPDATE uzee SET backpic='' WHERE uzid='$setuzid'");
		if($dbdel==true){$_SESSION['backupdate']="0";}
		else{$_SESSION['backupdate']="1";}
	}
	else{$_SESSION['backupdate']="1";}
}
else{$_SESSION['backupdate']="1";}
header("location: ../settings.php?tab=profilecover");
}
}
}
?>