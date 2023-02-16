<?php
session_start();
require("eecon.php");
require("sessions.php");
$texttake=array('\r\n','[PAGEBREAK]');
$textmake=array('<br>', '<br><br>');
if(isset($_POST['savedraft'])){
	$storyname=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storyname'])));
	if(strlen($storyname)=="0"){$storyname="Untitled - ".date("G:i:s j F Y");}
	$storypartname=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storypartname'])));
	$storyuzid=$_SESSION['uzid'];
	$storyrights=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storyrights'])));
	$storyrating=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storyrating'])));
	$storydescript=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storydescript'])));
	$storytext=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storytext'])));
	$storytime=time();
	$storyfont=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storyfont'])));
	$storycateo=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($_POST['storycato']))));
	$storycatet=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($_POST['storycatt']))));
	mysql_query("INSERT INTO draft(draftname, draftpartname, draftuzid, draftrights, draftrating, draftdescript, drafttext, drafttime, draftfont, draftcato, draftcatt) VALUES('$storyname', '$storypartname', '$storyuzid', '$storyrights', '$storyrating', '$storydescript', '$storytext', '$storytime', '$storyfont', '$storycateo', '$storycatet')");
	header("location: ../stories.php");
}
elseif(isset($_POST['savefull'])){
	$storyname=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($_POST['storyname']))));
	if(strlen($storyname)=="0"){$storyname="Untitled - ".date("G:i:s j F Y");}
	$storypartname=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($_POST['storypartname']))));
	$storyuzid=$_SESSION['uzid'];
	$storyrights=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storyrights'])));
	$storyrating=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storyrating'])));
	$storydescript=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storydescript'])));
	$storytext=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storytext'])));
	$storytime=time();
	$storyfont=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, $_POST['storyfont'])));
	$storycateo=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($_POST['storycato']))));
	$storycatet=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($_POST['storycatt']))));
	mysql_query("INSERT INTO story (storyname, storypartname, storyuzid, storyrights, storyrating, storydescript, storytext, storytime, storyfont, storycato, storycatt) VALUES('$storyname', '$storypartname', '$storyuzid', '$storyrights', '$storyrating', '$storydescript', '$storytext', '$storytime', '$storyfont', '$storycateo', '$storycatet')");
	header("location: ../stories.php");
}
else{$_SESSION['writemessage']=""; header("location: ../write.php");}
echo "<script> window.location='../write.php'; </script>";
?>