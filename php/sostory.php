<?php
session_start();
require("eecon.php");
require("sessions.php");
$texttake=array('\r\n','[PAGEBREAK]');
$textmake=array('<br>', '<br><br>');
if(isset($_GET['id'])){
	$storyid=mysql_real_escape_string(htmlspecialchars($_GET['id']));
	$checkstory=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
	if(mysql_num_rows($checkstory)>0){
	while($getstory=mysql_fetch_array($checkstory)){
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
	$storycato=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($_POST['storycato']))));
	$storycatt=mysql_real_escape_string(htmlspecialchars(str_replace($texttake, $textmake, ucfirst($_POST['storycatt']))));
	if($_SESSION['uzid']==$getstory['storyuzid']){
	$updatedo=mysql_query("UPDATE story SET	storyname='$storyname', storypartname='$storypartname', storyrights='$storyrights', storyrating='$storyrating', storydescript='$storydescript', storytext='$storytext', storytime='$storytime', storyfont='$storyfont', storycato='$storycato', storycatt='$storycatt' WHERE storyid='$storyid' AND storyuzid='$storyuzid'");
	if($updatedo==true){header("location: ../editstory.php?id=".$storyid);}
	else{header("location: ../error.php?requestfailed");}
	}
	else{echo "You are not the creator of this story...";}
	}  // End 'getstory'
	}
	else{header("location: ../error.php?requestfailed");}
}
else{$_SESSION['writemessage']=""; header("location: ../write.php");}
echo "-- END --";
?>