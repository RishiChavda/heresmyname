<?php
session_start();
require("eecon.php");
if(isset($_REQUEST['send'])){
$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
if(strlen($email)==0){header("location: ../forgotten.php?noemail");}
else{
	$fquery = mysql_query("SELECT * FROM uzee WHERE email='$email'");
	while($fmfa=mysql_fetch_array($fquery, MYSQL_BOTH)){
	$forgotuzid=$fmfa['uzid'];
	$forgotuz = $fmfa['fname'];
	$forgotemail = $fmfa['email'];
	$password = rand(100000,10000000);
	$dbpassword=md5($password);
	mysql_query("UPDATE uzee SET password='$dbpassword' WHERE uzid='$forgotuzid'");
	}
$to = $email;
$subject = 'HeresMyName - Your (forgotten) login details';
$headers = "From: "."accounts@heresmy.name"."\r\n";
$headers .= "MIME-Version: 1.0 \r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";
$message = "<table style='margin:0; width:100%; min-width:250px; max-width:500px; background-color:#336CA6; border:3px solid #336CA6; font-family:Alegreya Sans; text-align:center;' cellpadding='0' cellspacing='0' border='0'><tr><td style='width:100%; text-align:center; padding:10px; font-size:20px; text-align:center;'><a style='color:#ffffff; text-decoration:none; display:block;' href='http://www.heresmy.name'>Here's My Name</a></td></tr><tr><td style='width:100%; text-align:justify; background-color:#ffffff; padding:20px;'><div style='font-family:Bad Script; font-size:15px; color:#333333;'>Hi ".$forgotuz.",</div><br><div style='font-family:Alegreya Sans; font-size:15px; color:#555555;'>You've recently requested a new password for your HeresMyName account. Below is a number password which you can use to login (with this email address) and change your password to something more secure, as we strongly recommend you change this as soon as possible to ensure your account is safe.</div><br><br><a style='width:200px; color:#333333; padding:10px; border:3px solid #336CA6; text-align:center; text-decoration:none; display:block;'>".$password."</a><div style='padding:10px; font-family:Alegreya Sans; font-size:15px; color:#555555;'>You can login by clicking <a style='font-size:15px; color:#336CA6; font-weight:bold; text-decoration:none;' href='http://heresmy.name/permit.php'>here</a>.</div><div style='font-family:Bad Script; font-size:25px; padding:10px; color:#336CA6;'>The HeresMyName Team</div></td></tr></table>";
$forgottenemail = mail($to, $subject, $message, $headers);
if($forgottenemail=true){header("location: ../forgotten.php?sent");}
else{header("location: ../forgotten.php?nosent");}
} // 'email'
} // 'send'
?>