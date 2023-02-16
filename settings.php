<?php session_start(); require("php/sessions.php"); ?>
<html>
<head>
<title>Settings</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300|Alegreya+Sans:500,400,300' rel='stylesheet' type='text/css'>
<link href='css/ee.css' rel='stylesheet' type='text/css'>
<link href='css/settings.css' rel='stylesheet' type='text/css'>
<?php include("php/stylesesh.php"); ?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/ee.js"></script>
<script type="text/javascript" src="js/jscolor.js"></script>
</head>
<body>
<div id="topbar"><table cellspacing="0" cellpadding="0"><tr>
<td id="logo"><a href="discover.php"><img src="img/hmnw.png"/></a></td>
<td id="menu"><a class="link" href="discover.php">Discover</a><a class="link" href="shelf.php">Read</a><a class="link" href="write.php">Write</a></td>
<td id="search"><form action="search.php" method="post"/><input type="text" name="terms" id="terms" placeholder="Find something..."/><input type="submit" id="go" value="Go"/></form></td>
<td id="user"><?php if(file_exists($_SESSION['profpic'])){echo "<div id='button'><img src='".$_SESSION['profpic']."'/></div>";} else{echo "<div id='button'><img src='img/default.png'/></div>";} require("php/notifcheck.php"); if($notifct>0){echo "<a id='notifcount' href='updates.php'>".$notifct."</a>";} ?></td>
</tr></table>
<div id="usermenu">
<div class="mobileitem"><a href="discover.php">Discover</a></div>
<div class="mobileitem"><a href="read.php">Read</a></div>
<div class="mobileitem"><a href="write.php">Write</a></div>
<div class="mobileitem"><a href="search.php">Search</a></div>
<?php echo "<div class='item'><a href='profile.php?id=".$_SESSION['uzid']."'>".$_SESSION['fll']."</a></div>"; ?>
<div class="item"><a href="stories.php">My Stories</a></div>
<div class="item"><a href="shelf.php">My Shelf</a></div>
<div class="item"><a href="connections.php">My Connections</a></div>
<div class="item"><a href="updates.php">Updates</a></div>
<div class="item"><a href="settings.php">Settings</a></div>
<div class="item"><a href="help.php">Help</a></div>
<div class="item"><a onClick="exithmn()">Log Out</a></div>
</div></div>
<div id="main"><div id="settings"><table><tr>
<td id="sidesection">
<a class="backlink" id="backget">Back</a>
<a class="tablink" href="settings.php?tab=general">General</a>
<a class="tablink" href="settings.php?tab=email">Email</a>
<a class="tablink" href="settings.php?tab=password">Password</a>
<a class="tablink" href="settings.php?tab=design">Design</a>
<a class="tablink" href="settings.php?tab=profilepicture">Profile Picture</a>
<a class="tablink" href="settings.php?tab=profilecover">Profile Cover</a>
<a class="tablink" href="settings.php?tab=blocking">Blocking</a>
</td>
<td id="mainsection">
<?php
require("php/eecon.php");
if($_SESSION['update']=="0"){echo "<div class='saved'>Settings saved.</div>"; $_SESSION['update']="";}
elseif($_SESSION['update']=="1"){echo "<div class='error'>There was a problem saving your changes. Please try again later.</div>"; $_SESSION['update']="";}
elseif($_SESSION['update']=="2"){echo "<div class='error'>Missing/Invalid file type. Please upload images in JPEG/JPG/PNG/GIF format.</div>"; $_SESSION['update']="";}
if($_SESSION['eupdate']=="1"){echo "<div class='saved'>You may not use this email address as it is already being used on another account.</div>"; $_SESSION['eupdate']="";}

if($_SESSION['pupdate']=="0"){echo "<div class='saved'>New password saved.</div>"; $_SESSION['pupdate']="";}
elseif($_SESSION['pupdate']=="1"){echo "<div class='error'>There was a problem changing your password. Please try again later.</div>"; $_SESSION['pupdate']="";}
elseif($_SESSION['pupdate']=="2"){echo "<div class='error'>Looks like you missed something below. Please make sure your password is at least 8 characters long.</div>"; $_SESSION['pupdate']="";}
elseif($_SESSION['pupdate']=="3"){echo "<div class='error'>Current password is incorrect. You must provide this in order to change your password.</div>"; $_SESSION['pupdate']="";}

if($_SESSION['profupdate']=="0"){echo "<div class='saved'>Removed profile picture.</div>"; $_SESSION['profupdate']="";}
elseif($_SESSION['profupdate']=="1"){echo "<div class='error'>Profile picture could not be removed at this moment. Please try again later.</div>"; $_SESSION['profupdate']="";}
if($_SESSION['backupdate']=="0"){echo "<div class='saved'>Removed cover picture.</div>"; $_SESSION['backupdate']="";}
elseif($_SESSION['backupdate']=="1"){echo "<div class='error'>Profile cover picture could not be removed at this moment. Please try again later.</div>"; $_SESSION['backupdate']="";}
if(!isset($_REQUEST['tab'])){echo "<script> window.location='settings.php?tab=general' </script>";}
if($_GET['tab']=="general"){
$getuzid=$_SESSION['uzid'];
$getdo=mysql_query("SELECT * FROM uzee WHERE uzid='$getuzid'");
while($aeget=mysql_fetch_array($getdo, MYSQL_BOTH)){
echo "<div class='tabcontainer'><div class='title'>General Info <a id='sideget'>Sections</a></div><form action='php/upset.php?general' method='post'><div class='section'><div class='fieldsub'>First name</div><input type='text' class='fieldin' maxlength='50' name='fname' value='".$aeget['fname']."'/><div class='linegap'></div><div class='fieldsub'>Last name</div><input type='text' class='fieldin' maxlength='50' name='lname' value='".$aeget['lname']."'/><div class='fieldinfo'>Forename/Surname</div></div><div class='section'><div class='fieldsub'>Birthday</div><input type='text' min='1' max='31' pattern='[0-9]*' onKeyPress='numbersonly(this, event)' class='smallfieldin' maxlength='2' name='birthday' value='".$aeget['birthday']."'/><input type='text' min='1' max='12' pattern='[0-9]*'onKeyPress='numbersonly(this, event)' class='smallfieldin' maxlength='2' name='birthmonth' value='".$aeget['birthmonth']."'/><input type='text' min='1950' max='2001' pattern='[0-9]*' onKeyPress='numbersonly(this, event)' class='longfieldin' maxlength='4' name='birthyear' value='".$aeget['birthyear']."'/><div class='fieldinfo'>(DD/MM/YYYY) E.g. 01/01/1990</div></div><div class='section'><div class='fieldsub'>Location</div><input type='text' class='fieldin' maxlength='50' name='location' value='".$aeget['location']."'/><div class='fieldinfo'>What country you live in</div></div><div class='section'><div class='fieldsub'>Occupation</div><input type='text' class='fieldin' maxlength='50' name='occup' value='".$aeget['occup']."'/><div class='fieldinfo'>E.g. Student, Dentist, Dinosaur Supervisor</div></div><div class='section'><div class='fieldsub'>Favourite Quote</div><input type='text' class='fieldin' name='favqu' value='".$aeget['favqu']."'/><div class='fieldinfo'>Try something deep</div></div><div class='section'><div class='fieldsub'>Website</div><input type='text' class='fieldin' name='uzurl' value='".$aeget['uzurl']."'/><div class='fieldinfo'>This will be shown on your profile page</div></div><div class='section'><div class='fieldsub'>About you</div><textarea class='bigtext' name='ame' maxlength='500'>".$aeget['ame']."</textarea><div class='fieldinfo'>What you do in your spare time, your interests, and what inspired you to write... And anything else your readers/followers ought to know!</div></div><div class='buttonbox'><input type='submit' class='savebutton' value='Save Changes'/></div></form></div>";
}}
if($_GET['tab']=="email"){
$getuzid=$_SESSION['uzid'];
$getdo=mysql_query("SELECT * FROM uzee WHERE uzid='$getuzid'");
while($aeget=mysql_fetch_array($getdo, MYSQL_BOTH)){echo "<div class='tabcontainer'><div class='title'>Account Settings <a id='sideget'>Sections</a></div><form action='php/upset.php?email' method='post'><div class='section'><div class='fieldsub'>Email Address</div><input type='email' class='fieldin' maxlength='50' name='email' value='".$aeget['email']."'/><div class='fieldinfo'>We will send your login details to this email address if you ever need them.</div></div>"; echo "<div class='buttonbox'><input type='submit' class='savebutton' value='Save Changes'/></div></form></div>";}}

if($_GET['tab']=="password"){
$getuzid=$_SESSION['uzid'];
$getdo=mysql_query("SELECT * FROM uzee WHERE uzid='$getuzid'");
while($aeget=mysql_fetch_array($getdo, MYSQL_BOTH)){echo "<div class='tabcontainer'><div class='title'>Password <a id='sideget'>Sections</a></div><form action='php/upset.php?password' method='post'><div class='section'><div class='fieldsub'>Password</div><input type='password' class='fieldin' maxlength='50' name='oldpass' placeholder='Current password'/><input type='password' class='fieldin' maxlength='50' name='newpass' placeholder='New password'/><div class='fieldinfo'>To aid security, please provide your current password as well as your new desired password</div></div>"; echo "<div class='buttonbox'><input type='submit' class='savebutton' value='Save Changes'/></div></form></div>";}}

if($_GET['tab']=="design"){
$getuzid=$_SESSION['uzid'];
$getdo=mysql_query("SELECT * FROM uzee WHERE uzid='$getuzid'");
while($aeget=mysql_fetch_array($getdo, MYSQL_BOTH)){echo "<div class='tabcontainer'><div class='title'>Design <a id='sideget'>Sections</a></div><form action='php/upset.php?design'method='post'><div class='section'><div class='fieldsub'>Theme Colour</div><input type='text' class='colourin' maxlength='6' name='themecolour' id='themecolour' value='".$aeget['themecolour']."'/><div class='fieldinfo'>(Click for colour picker)</div></div><div class='section'><div class='fieldsub'>Profile Colour</div><input type='text' class='colourin' maxlength='6' name='profcolour' value='".$aeget['profcolour']."'/><div class='fieldinfo'>(Click for colour picker)</div></div><div class='buttonbox'><input type='submit' class='savebutton' value='Save Changes'/></div></form></div>";}}
if($_GET['tab']=="profilepicture"){
$getuzid=$_SESSION['uzid'];
$getdo=mysql_query("SELECT * FROM uzee WHERE uzid='$getuzid'");
while($aeget=mysql_fetch_array($getdo, MYSQL_BOTH)){echo "<div class='tabcontainer'><div class='title'>Profile Picture <a id='sideget'>Sections</a></div><form enctype='multipart/form-data' action='php/upset.php?profilepicture' method='post'><div class='csection'>";
$profpic=str_replace("..", ".", $aeget['profpic']);
if(file_exists($profpic)){echo "<img class='currentprofpic' src='".$aeget['profpic']."'/>";}
else{echo "<img class='currentprofpic' src='img/default.png'/><br><br><div class='nopic'>Default image shown. You can replace this by uploading another image.</div>";}
echo "<br><br><label id='newprofpic' class='filelabel' for='fileprofpic'>Upload New Profile Picture</label><div class='linegap'></div><a class='filedel' href='php/upset.php?profpicdel'>Remove current picture</a></div><input type='file' class='filein' id='fileprofpic' name='newprofpic' accept='image/*'/><div class='buttonbox'><input type='submit' class='savebutton' value='Save Changes'/></div></div></form></div>";}}
if($_GET['tab']=="profilecover"){
$getuzid=$_SESSION['uzid'];
$getdo=mysql_query("SELECT * FROM uzee WHERE uzid='$getuzid'");
while($aeget=mysql_fetch_array($getdo, MYSQL_BOTH)){echo "<div class='tabcontainer'><div class='title'>Profile Cover <a id='sideget'>Sections</a></div><form enctype='multipart/form-data' action='php/upset.php?coverpic' method='post'><div class='csection'>";
$backpic=str_replace("..", ".", $aeget['backpic']);
if(file_exists($backpic)){echo "<img class='currentbackpic' src='".$aeget['backpic']."'/>";}
else{echo "<br><br><div class='nopic'>Note: As you have not provided a profile cover picture, your theme colour will be displayed instead.</div>";}
echo "<br><br><label class='filelabel' for='filebackpic' accept='image/*'>Upload New Cover Picture</label><div class='linegap'></div><a class='filedel' href='php/upset.php?backpicdel'>Remove current picture</a></div><input type='file' class='filein' id='filebackpic' name='newbackpic'/><div class='buttonbox'><input type='submit' class='savebutton' value='Save Changes'/></div></div></form></div>";}}
if($_GET['tab']=="blocking"){
require("php/eecon.php");
$followuzid=$_SESSION['uzid'];
$blockbin="1";
echo "<div class='tabcontainer'><div class='title'>Blocking <a id='sideget'>Sections</a></div>";
$blockdo=mysql_query("SELECT * FROM follows WHERE followinguzid!='$followuzid' AND blockbin='$blockbin' AND controluzid='$followuzid'") or die(mysql_error());
while($blockget=mysql_fetch_array($blockdo, MYSQL_BOTH)){
	$foreignuzid=$blockget['followinguzid'];
	$foreigndo=mysql_query("SELECT * FROM uzee WHERE uzid='$foreignuzid'") or die(mysql_error());
	while($forget=mysql_fetch_array($foreigndo, MYSQL_BOTH)){
	echo "<div class='conentry'><a class='name'>";
	if(file_exists($forget['profpic'])){echo "<img src='".$forget['profpic']."'/>";}
	else{echo "<img src='img/default.png'/>";}
	echo $forget['fname']." ".$forget['lname']."</a><a class='unblock' href='php/upset.php?unfollow=".$forget['uzid']."'>Unblock</a></div>";
	}
}
echo "</div>";}
?>
</td>
</tr></table></div></div>
</body>
</html>