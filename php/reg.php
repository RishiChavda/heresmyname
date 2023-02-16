<?php
session_start();
require("eecon.php");
if(isset($_POST)){
$fname = ucfirst(mysql_real_escape_string(htmlspecialchars($_POST['fname'])));
$lname = ucfirst(mysql_real_escape_string(htmlspecialchars($_POST['lname'])));
$email = ucfirst(mysql_real_escape_string(htmlspecialchars($_POST['email'])));
$password = md5(mysql_real_escape_string(htmlspecialchars($_POST['password'])));
$birthday="1";
$birthmonth="1";
$birthyear="1990";
$favqu="Heres-MY-Name";
$ame="I am ".$fname." and I am using HeresMyName.";
$datejoin=date("j F Y");
if(strlen($fname)<=2 || strlen($lname)<=2 || strlen($email)<=8 || strlen($password)<=8){if(strlen($fname)<=2){$_SESSION['fnameerror']="1";} if(strlen($lname)<=2){$_SESSION['lnameerror']="1";} if(strlen($email)<=8){$_SESSION['emailerror']="1";} if(strlen($password)<=8){$_SESSION['passerror']="1";} header("location: ../register.php");}
else{
$fname = ucfirst(strtolower($fname));
$lname = ucfirst(strtolower($lname));
$location = ucfirst(($location));
$occup = ucfirst(($occup));
$uschecker = mysql_query("SELECT * FROM uzee WHERE email='$email'");
if(mysql_num_rows($uschecker)==0){
$regq=mysql_query("INSERT INTO uzee(fname, lname, email, password, birthday, birthmonth, birthyear, favqu, ame, datejoin) VALUES ('$fname', '$lname', '$email', '$password', '$birthday', '$birthmonth', '$birthyear', '$favqu', '$ame', '$datejoin')");
if($regq==true){
		$to = $email;
		$subject='HeresMyName - Welcome!';
		$headers="From: "."accounts@heresmy.name"."\r\n";
		$headers.="MIME-Version: 1.0 \r\n";
		$headers.="Content-Type: text/html; charset=ISO-8859-1 \r\n";
		$message="<table style='margin:0; width:100%; min-width:250px; max-width:500px; background-color:#336CA6; border:3px solid #336CA6; font-family:Alegreya Sans; text-align:center;' cellpadding='0' cellspacing='0' border='0'><tr><td style='width:100%; text-align:center; padding:10px; font-size:20px; text-align:center;'><a style='color:#ffffff; text-decoration:none; display:block;' href='http://www.heresmy.name'>Here's My Name</a></td></tr><tr><td style='width:100%; text-align:justify; background-color:#ffffff; padding:20px;'><div style='font-family:Bad Script; font-size:15px; color:#333333;'>Hi ".$fname.",</div><br><div style='font-family:Alegreya Sans; font-size:15px; color:#555555;'>You've successfully created your HeresMyName account and can now begin your journey in to the world of stories!<br><br>This is simply a notification of your account register however if you have any other problems with your HeresMyName account, using the service, or have any other queries (complaints/suggestions/complements) you can reply to this email address with your issue and we'll get back to you as soon as possible.</div><br><br><div style='padding:10px; font-family:Alegreya Sans; font-size:15px; color:#555555;'>You can login to your new account by clicking <a style='font-size:15px; color:#336CA6; font-weight:bold; text-decoration:none;' href='http://heresmy.name/permit.php'>here</a>.</div><div style='font-family:Bad Script; font-size:25px; padding:10px; color:#336CA6;'>The HeresMyName Team</div></td></tr></table>";
	$email=htmlspecialchars(mysql_real_escape_string($_POST['email']));
	$password=htmlspecialchars(mysql_real_escape_string($_POST['password']));
	$userinfo=mysql_query("SELECT * FROM uzee WHERE email='$email' AND password='$password'");
	while($getsesh=mysql_fetch_array($userinfo, MYSQL_BOTH)){$_SESSION['logged']="1"; $_SESSION['uzid']=$getsesh['uzid']; $_SESSION['fn']=$getsesh['fname']; $_SESSION['ln']=$getsesh['lname']; $_SESSION['fll']=$getsesh['fname']." ".$getsesh['lname'];}
	mail($to, $subject, $message, $headers);
	header("location: ../permit.php?newreg");
}
else{header("location: ../error.php?noreg");}
}
else{header("location: ../permit.php?alreadyreg");}
}
}
?>