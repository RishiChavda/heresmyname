<?php
session_start();
require("eecon.php");
require("sessions.php");
$user=$_SESSION['uzid'];
if($user==""){$user="NO ID";}
$name=htmlspecialchars(mysql_real_escape_string($_POST['name']));
$email=htmlspecialchars(mysql_real_escape_string($_POST['email']));
$problem=htmlspecialchars(mysql_real_escape_string($_POST['problem']));
if(strlen($name)=="0" || strlen($email)=="0" || strlen($problem)=="0"){$_SESSION['supportr']="0"; header("location: ../help.php");}
else{mysql_query("INSERT INTO issues(isuzid, isname, isemail, isproblem) VALUES('$user', '$name', '$email', '$problem')"); $_SESSION['supportr']="1";}
header("location: ../help.php");
?>