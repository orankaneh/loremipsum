<?php
ob_start();
session_start();
include_once("header.php");

echo genSitemap("detail.php?id=","");

include_once("footer.php");
?>