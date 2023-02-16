<?php
session_start();
require("eecon.php");
require("sessions.php");
$notifuzid=$_SESSION['uzid'];
$notifdo=mysql_query("SELECT * FROM notifs WHERE notifuzid='$notifuzid' AND notifseen=''");
$notifct=mysql_num_rows($notifdo);
?>