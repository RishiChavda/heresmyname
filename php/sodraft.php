<?php
session_start();
require("eecon.php");
require("sessions.php");
$texttake=array('\r\n','[PAGEBREAK]');
$textmake=array('<br>', '<br><br>');
if(isset($_GET['id'])){
	$draftid=mysql_real_escape_string(htmlspecialchars($_GET['id']));
	$checkdraft=mysql_query("SELECT * FROM draft WHERE draftid='$draftid'");
	if(mysql_num_rows($checkdraft)){
	while($getdraft=mysql_fetch_array($checkdraft)){
	$draftname=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['draftname'])));
	if(strlen($storyname)=="0"){$storyname="Untitled - ".date("G:i:s j F Y");}
	$draftpartname=mysql_real_escape_string(htmlspecialchars($_POST['draftpartname']));
	$draftuzid=$_SESSION['uzid'];
	$draftrights=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['draftrights'])));
	$draftrating=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['draftrating'])));
	$draftdescript=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['draftdescript'])));
	$drafttext=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['drafttext'])));
	$drafttime=time();
	$draftfont=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['draftfont'])));
	$draftcato=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($_POST['draftcato']))));
	$draftcatt=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($_POST['draftcatt']))));
	if($draftuzid==$getdraft['draftuzid']){
	$updatedo=mysql_query("UPDATE draft SET	draftname='$draftname', draftpartname='$draftpartname', draftrights='$draftrights', draftrating='$draftrating', draftdescript='$draftdescript', drafttext='$drafttext', drafttime='$drafttime', draftfont='$draftfont', draftcato='$draftcato', draftcatt='$draftcatt' WHERE draftid='$draftid'") or die(mysql_error());
	if($updatedo==true){header("location: ../editdraft.php?id=".$draftid);}
	else{header("location: ../error.php?requestfailed");}
	}
	}
	}
	else{header("location: ../error.php?requestfailed");}
}
else{$_SESSION['writemessage']=""; header("location: ../write.php");}
?>