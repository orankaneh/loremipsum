<? 
error_reporting(0);
ob_start();
@session_start();
include_once("../inc/fungsi.php");
include_once("../inc/fungsi_khusus.php");
include_once("../inc/fungsi_site.php");
include_once("../inc/config.php");
include_once('../editor/wysiwygPro.class.php');

if(strlen($judulnya)<1) { $judulnya = client; }
else {
	$judulnya .= " - ".client;
}

// cek login
if (ereg("index.php", $_SERVER['PHP_SELF'])) {
	if (isset($_SESSION["admSession"])) {
		header("location:utama.php");
		exit;
	}
} else {
	if (!isset($_SESSION["admSession"])) {
		header("location:index.php");
		exit;
	}
}

// cek hak akses
if($checkApp==true) isBolehAkses($minLevel,$hakAksesAplikasi,$_SESSION['admSession']['id_aplikasi'],true);

// pengaturan manual
$manualUI = "";
$manualId = "";


if(strlen($manualId)>0) $manualUI = '<div align="right" style="padding:3px;"><a title="" id="help" href="manual.php?p='.$manualId.'" rel="manual.php?p='.$manualId.'"><img border="0" src="../plugins/cluetip-1.0.6/images/help.png"/></a></div>';

// setting layout
$layoutPosition = "center";
$layoutHeaderID = "headerMimin";
$layoutLogo = false;
if(!ereg("index.php",$_SERVER['PHP_SELF'])) {
	$layoutPosition = "left";
	$layoutHeaderID = "headerMimin2";
	$layoutLogo = true;
}
?>
<html>
<head>
	<title><?=$judulnya?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<meta name="Author" content="CV Citraweb Nusa InfoMedia" />
	<link rel="stylesheet" href="../css/style_admin.css" type="text/css">
	<!--[if IE]>
		<link href="../css/style_admin_ie.css" rel="stylesheet" type="text/css">
	<![endif]-->
	<script type="text/javascript" src="../plugins/jquery-1.4.2.min.js"></script>
	
	<!--plugin-->
	<link href="../plugins/cluetip-1.0.6/jquery.cluetip.css" type="text/css" rel="stylesheet">
	<link type="text/css" href="../plugins/themes/smoothness/jquery.ui.all.css" rel="stylesheet" />
	<link type="text/css" href="../plugins/themes/smoothness/jquery.ui.theme.css" rel="stylesheet" />
	<link type="text/css" href="../plugins/themes/smoothness/jquery.ui.dialog.css" rel="stylesheet" />
	
	<script type="text/javascript" src="../plugins/cluetip-1.0.6/jquery.cluetip.min.js"></script>
	<script type="text/javascript" language="javascript" src="../plugins/ui/jquery.ui.core.min.js"></script>
	<script type="text/javascript" language="javascript" src="../plugins/ui/jquery.ui.position.min.js"></script>
	<script type="text/javascript" language="javascript" src="../plugins/ui/jquery.ui.widget.min.js"></script>
	<script type="text/javascript" language="javascript" src="../plugins/ui/jquery.ui.dialog.min.js"></script>
	<script type="text/javascript" language="javascript" src="../plugins/ui/jquery.ui.datepicker.min.js"></script>
	
	<script type="text/javascript">
	function bantuan(id) {
		$("#isihelp_"+id).toggle();
	}
	jQuery(document).ready(function() {
		$('.menu-hori').find('li')
			.hover(function () { $(this).addClass("sfhover"); },
	               function () { $(this).removeClass("sfhover"); });
		$('#help').cluetip({
			sticky: true,
			activation: 'click',
			closePosition: 'title',
			arrows: true,
			width: 500,
			height: 'auto'
		});
	});
	</script>
</head>
<body>
	<table align="<?=$layoutPosition?>" width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td class="kiri" align="left">				
				<div id="<?=$layoutHeaderID?>">
				<? if($layoutLogo==true) { ?>
					<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="left" valign="middle">
								<a style="padding-left:50px;" href="../index.php"><img border="0" alt="logo" src="../images/adm/logo_dalam.png"/></a>
							</td>
							<td align="right" valign="middle">
								<div style="padding-right:30px;color:#FFF;">
									<span style="font-size:20px;">Administrator Area</span>								
								</div>
							</td>
						</tr>
					</table>
				<? } else { echo "&nbsp;"; } ?>
				</div>
			</td>
		</tr>
		<tr>
			<td valign="top" align="left">
				<table width="100%" class="menuyah">
				<tr>
					<?=menuAdmin();?>
					<td valign="top" align="left" id="a_container">
					<?=$manualUI?>