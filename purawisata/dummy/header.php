<?php
ob_start();
session_start();

include_once("inc/fungsi.php");
include_once("inc/fungsi_khusus.php");
include_once("inc/fungsi_site.php");
include_once("inc/config.php");
include_once("visitor.php");
$html_title = (!empty($html_title))? $html_title." - ".client : client;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="id" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?=$html_title?></title>
	<link rel="shortcut icon" href="favicon.ico" >
	<meta name="Description" content="" />
	<meta name="Keywords" content="" />
	<meta name="Author" content="CV Citraweb Nusa InfoMedia" />
	<link href="css/sop.css" rel="stylesheet" type="text/css"/>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
	<!--[if IE]>
		<link href="css/style_ie.css" rel="stylesheet" type="text/css">
	<![endif]-->
	<link type="text/css" href="plugins/themes/cupertino/jquery.ui.all.css" rel="stylesheet" />
	<link type="text/css" href="plugins/themes/cupertino/jquery.ui.theme.css" rel="stylesheet" />
	<link type="text/css" href="plugins/themes/cupertino/jquery.ui.dialog.css" rel="stylesheet" />
	<link type="text/css" href="plugins/slimbox2/slimbox2.css" type="text/css" rel="stylesheet" media="screen" />
	
	<script type="text/javascript" src="plugins/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="plugins/ui/jquery.ui.datepicker.min.js"></script>
	<script type="text/javascript" src="plugins/slimbox2/slimbox2.js"></script>
	<script type="text/javascript" src="plugins/showcase/jquery.showcase-2.0.2.min.js"></script>
</head>
<body>
<div class="header">

</div>