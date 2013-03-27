<?php
ob_start();
session_start();

$html_title = "Hubungi Kami";
include_once("header.php");

?>

<div class="judulmenu2">Hubungi Kami</div>
<div><?include_once("inc/modulHubungi.php");?></div>
	
<?php
include_once("footer.php");
?>