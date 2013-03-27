<?php
ob_start();
session_start();
include_once("../inc/config.php");
$kuery='UPDATE '.tabel_user.' SET status_online="0",
		last_ip="'.$_SERVER['REMOTE_ADDR'].'" WHERE id_user ="'.$_SESSION['admSession']['id'].'"';
mysql_query($kuery,$tulis);

session_destroy();
header("location:index.php");
?>
