<?php session_start(); require("php/sessions.php"); ?>
<html>
<head>
<title>Write something</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans|Open+Sans|Roboto|Lato|Tauri|Raleway|Arimo' rel='stylesheet' type='text/css'>
<link href='css/write.css' rel='stylesheet' type='text/css'>
<?php include("php/stylesesh.php"); ?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/storyshows.js"></script>
</head>
<body><form action="php/newstory.php" method="post">
<div id="topbar">
<div id="topbuttons"><a class="toplink" href="discover.php"><img src="img/hmnw.png"/></a> <?php if(file_exists($_SESSION['profpic'])){echo "<a class='toplink' href='profile.php?id=".$_SESSION['uzid']."'><img src='".$_SESSION['profpic']."'/></a>";} else{echo "<a class='toplink' href='profile.php?id=".$_SESSION['uzid']."'><img src='img/default.png'/></a>";} ?></div>
<div id="mainopt">
<div id="names"><input type="text" name="storyname" class="fieldin" placeholder="Story name"/> <input type="text" name="storypartname" class="fieldin" placeholder="Chapter/Part name"/></div>
<div id="subs"><input type='submit' name='savedraft' id='savedraft' value='Save as Draft'/> <input type='submit' name='savefull' id='savefull' value='Save and Publish'/></div>
<div id="opens"><a id='openblurb'>Write Blurb</a><a id='openmore'>More options</a></div>
</div>
<div id="moreopt">
<select name='storyrights' class='attselect'><option value='1' selected>Privacy</option><option value='1'>Anyone</option><option value='2'>Only Followers</option><option value='3'>Only Mutual Followers</option><option value='4'>No One</option></select><br>
<select name='storyrating' class='attselect'><option value='Universal (Anyone)' selected>Preferreed audience</option><option value='Universal (Anyone)'>Universal (Anyone)</option><option value='Parental Guidance (Language, violence)'>Parental Guidance (Language, violence)</option><option value='15 (Sexual themes, violence, language, drugs)'>15 (Sexual themes, violence, language, drugs)</option><option value='18 (Adult themes, extreme language)'>18 (Adult themes, extreme language)</option></select><br>
<select name='storycato' class='attselect'><option value='free' selected>Category 1</option><option value='science'>Science</option><option value='humour'>Humour</option><option value='biography'>Biography</option><option value='action'>Action</option><option value='mystery'>Mystery</option><option value='horror'>Horror</option><option value='fantasy'>Fantasy</option><option value='romance'>Romance</option><option value='supernatural'>Supernatural</option><option value='drama'>Drama</option><option value='war'>War</option><option value='religion'>Religion</option><option value='short'>Short</option></select>
<select name='storycatt' class='attselect'><option value='free' selected>Category 2</option><option value='science'>Science</option><option value='humour'>Humour</option><option value='biography'>Biography</option><option value='action'>Action</option><option value='mystery'>Mystery</option><option value='horror'>Horror</option><option value='fantasy'>Fantasy</option><option value='romance'>Romance</option><option value='supernatural'>Supernatural</option><option value='drama'>Drama</option><option value='war'>War</option><option value='religion'>Religion</option><option value='short'>Short</option></select><br>
<select name="storyfont" id="storyfont" class="attselect"><option value="Alegreya Sans">Story Font</option><option value="Alegreya Sans">Alegreya Sans</option><option value="Open Sans">Open Sans</option><option value="Roboto">Roboto</option><option value="Lato">Lato</option><option value="Tauri">Tauri</option><option value="Raleway">Raleway</option><option value="Arimo">Arimo</option></select>
<div class="codehints">For line breaks, insert "[PAGEBREAK]" (without quotation marks).</div>
</div>
</div>
<div id="main">
<div id="blurbbox"><div class="title">Blurb/Description</div><textarea id='storydescript' class="storyin" name='storydescript' autocomplete='off' spellcheck='true' placeholder='You can use this space for including any information regarding your story. This can be descriptions in the form of blurbs, which will then be displayed on the information page for this story. We highly recommend you provide, at the very least, a rough summary of the story that you are writing to make sure as many people as possible want to read your story!'></textarea></div>
<div id="storybox"><div class="title">Your whole story</div><textarea id='storytext' class="storyin" name='storytext' autocomplete='off' spellcheck='true' placeholder='This is the main content; the whole story.'></textarea></div>
</div>
</form></body>
</html>