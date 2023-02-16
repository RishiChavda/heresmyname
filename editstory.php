<?php
session_start();
require("php/sessions.php");
require("php/eecon.php");
if(isset($_GET['id'])){ // Editing existing story
require("php/eecon.php");
$storyid=$_GET['id'];
$uzid=$_SESSION['uzid'];
$storyfind=mysql_query("SELECT * FROM story WHERE storyid='$storyid'");
if(mysql_num_rows($storyfind)==0){header("location: write.php");}
else{
while($storyget=mysql_fetch_array($storyfind)){
$udid=$_SESSION['uzid'];
$thid=$storyget['storyuzid'];
if($udid!==$thid){header("location: error.php?nopermit");}
else{
$userfind=mysql_query("SELECT * FROM uzee WHERE uzid='$udid'");
while($userget=mysql_fetch_array($userfind)){
?>
<html>
<head>
<title><?php echo "Editing '".$storyget['storyname']."'"; ?></title>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans|Open+Sans|Roboto|Lato|Tauri|Raleway|Arimo' rel='stylesheet' type='text/css'>
<link href='css/write.css' rel='stylesheet' type='text/css'>
<?php include("php/stylesesh.php"); ?>
<?php
if(strlen($storyget['storyfont'])>0){echo "<style> #main .title{font-family:'".$storyget['storyfont']."';} #main .storyin{font-family:'".$storyget['storyfont']."';} #main #blurbbox{font-family:'".$storyget['storyfont']."';} #main #storybox{font-family:'".$storyget['storyfont']."';} </style>";}
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/write.js"></script>
</head>
<body>
<?php echo "<form action='php/sostory.php?id=".$storyget['storyid']."' method='post'>"; ?>
<div id="topbar">
<div id="topbuttons"><a class="toplink" href="discover.php"><img src="img/hmnw.png"/></a> <?php if(file_exists($_SESSION['profpic'])){echo "<a class='toplink' href='profile.php?id=".$_SESSION['uzid']."'><img src='".$_SESSION['profpic']."'/></a>";} else{echo "<a class='toplink' href='profile.php?id=".$_SESSION['uzid']."'><img src='img/default.png'/></a>";} ?></div>
<div id="mainopt">
<?php include("php/timeago.php"); echo "<a id='saved'>Last saved ".ago($storyget['storytime'])."</a>"; ?>
<div id="names">
<?php
echo "<input type='text' class='fieldin' name='storyname' value='".$storyget['storyname']."' required/>";
if(strlen($storyget['storypartname'])>0){echo "<input type='text' class='fieldin' name='storypartname' value='".$storyget['storypartname']."'/>";}
else{echo "<input type='text' class='fieldin' name='storypartname' placeholder='Chapter/Part name'/>";}
?>
</div>

<div id="subs"><input type='submit' name='savefull' id='savefull' value='Save Changes'/></div>
<div id="opens"><a id='openblurb'>Write Blurb</a><a id='openmore'>More info</a></div>
</div>
<div id="moreopt">
<?php
echo "<select name='storyrights' class='attselect'><option value='".$storyget['storyrights']."' selected>Privacy</option><option value='1'>Anyone</option><option value='2'>Only Followers</option><option value='3'>Only Mutual Followers</option><option value='4'>No One</option></select><br>";
echo "<select name='storyrating' class='attselect'><option value='".$storyget['storyrating']."' selected>Preferred audience</option><option value='Universal (Anyone)'>Universal (Anyone)</option><option value='Parental Guidance (Language, violence)'>Parental Guidance (Language, violence)</option><option value='15 (Sexual themes, violence, language, drugs)'>15 (Sexual themes, violence, language, drugs)</option><option value='18 (Adult themes, extreme language)'>18 (Adult themes, extreme language)</option></select><br>";
echo "<select name='storycato' class='attselect'><option value='".$storyget['storycato']."' selected>Current Category (".$storyget['storycato'].")</option><option value='free'>None</option><option value='science'>Science</option><option value='humour'>Humour</option><option value='biography'>Biography</option><option value='action'>Action</option><option value='mystery'>Mystery</option><option value='horror'>Horror</option><option value='fantasy'>Fantasy</option><option value='romance'>Romance</option><option value='supernatural'>Supernatural</option><option value='drama'>Drama</option><option value='war'>War</option><option value='religion'>Religion</option><option value='short'>Short</option></select>";
echo "<select name='storycatt' class='attselect'><option value='".$storyget['storycatt']."' selected>Current Category (".$storyget['storycatt'].")</option><option value='free'>None</option><option value='science'>Science</option><option value='humour'>Humour</option><option value='biography'>Biography</option><option value='action'>Action</option><option value='mystery'>Mystery</option><option value='horror'>Horror</option><option value='fantasy'>Fantasy</option><option value='romance'>Romance</option><option value='supernatural'>Supernatural</option><option value='drama'>Drama</option><option value='war'>War</option><option value='religion'>Religion</option><option value='short'>Short</option></select><br>";
echo "<select name='draftfont' class='attselect' id='storyfont'><option value='".$storyget['storyfont']."'>Current Font (".$storyget['storyfont'].")</option><option value='Alegreya Sans'>Alegreya Sans</option><option value='Open Sans'>Open Sans</option><option value='Roboto'>Roboto</option><option value='Lato'>Lato</option><option value='Tauri'>Tauri</option><option value='Raleway'>Raleway</option><option value='Arimo'>Arimo</option></select>";
echo '<div class="codehints">For line breaks, insert "[PAGEBREAK]" (without quotation marks).</div>';
?>
</div>
</div>
<div id="main">
<div id="blurbbox"><div class="title">Blurb/Description</div><?php
$textmake=array('[PAGEBREAK]');
$texttake=array('<br><br>');
echo "<textarea id='storydescript' class='storyin' name='storydescript' spellcheck='true' autocomplete='off' placeholder='You can use this space for including any information regarding your story. This can be descriptions in the form of blurbs, which will then be displayed on the information page for this story. We highly recommend you provide, at the very least, a rough summary of the story that you are writing to make sure as many people as possible want to read your story!'>".str_replace($texttake, $textmake, $storyget['storydescript'])."</textarea>"; ?></div>
<div id="storybox"><div class="title">Your whole story</div><?php
echo "<textarea id='storytext' class='storyin' name='storytext' spellcheck='true' autocomplete='off' placeholder='This is the main content; the whole story.'>".str_replace($texttake, $textmake, $storyget['storytext'])."</textarea>";
?></div>
</div>
</form></body>
</html>
<?php
}
}
}
}
}
?>