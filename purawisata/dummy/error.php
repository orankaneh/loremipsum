<?php
ob_start();
session_start();

$id = $_GET['id'];
$info = '';
$from = ($_GET['f']=='a') ? "dalam/" : "";
if($id==0) {
	$info =
		'<div style="text-align:center">
			<p style="font-weight:bold;">
				<image alt="logo" src="images/sys_error.png"/><br/><br/><br/>
				There seems to be a problem with the MySQL server, sorry for the inconvenience.<br/>
				We should be back shortly.<br/><br/>
				<a href="'.$from.'index.php">Try Again</a>
			</p>
		</div>';
} else if ($id==1) {
	$info =
		'<div style="text-align:center">
			<p style="font-weight:bold;">
				<image alt="logo" src="images/sys_error.png"/><br/><br/><br/>
				Your Javascript is disabled. Please enable it.<br/><br/>
				<a href="'.$from.'index.php">Try Again</a>
			</p>
		</div>';
}

?>

<html>
	<head>
	</head>
	<body>
		<?=$info?>
	</body>
</html>