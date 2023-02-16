<?php
session_start();
$_SESSION['logged']="";
$_SESSION['super']="";
session_destroy();
header("location: http://www.heresmy.name");
?>