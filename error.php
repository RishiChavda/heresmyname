<?php session_start(); ?>
<html>
<head>
<title>Well... This is awkward.</title>
<meta name="description" content="HeresMyName is a powerful story-sharing community."/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link href='img/hmnb.png' type='image/png' rel='icon'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300,700|Alegreya+Sans:400,300' rel='stylesheet' type='text/css'>
<link href='css/errors.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/errormove.js"></script>
</head>
<body>
<div id="dragbox"><div id="topbar">HeresMyName</div>
<?php
if(isset($_REQUEST['nodb'])){echo "<div id='errormsg'>Server connection failed</div><div id='errordescript'>The HeresMyName website is currently experiencing some server issues. Please try again at a later time.</div><a id='backlink' href='http://heresmy.name'>Click here to go back</a>";}
elseif(isset($_REQUEST['noreg'])){echo "<div id='errormsg'>Cannot register account</div><div id='errordescript'>System cannot create your account at this moment. Please try again later.</div><a id='backlink' href='permit.php'>Click here to login</a>";}
elseif(isset($_REQUEST['nopermit'])){echo "<div id='errormsg'>Unauthorised user request</div><div id='errordescript'>You are not authorised to make this change. The piece of work you are trying to access or change may not be yours to edit or may have been removed.</div><a id='backlink' href='discover.php'>Click here to go home</a>";}
elseif(isset($_REQUEST['requestfailed'])){echo "<div id='errormsg'>User request failed</div><div id='errordescript'>Current server issues are preventing your request/action at this moment. Please try again later.</div><a id='backlink' href='discover.php'>Click here to go home</a>";}
else{echo "<script> window.location='404.php' </script>";}
?>
</div>
</body>
</html>