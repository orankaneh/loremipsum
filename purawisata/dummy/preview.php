<?php
include_once("header.php");
echo '<div id="editor_preview">&nbsp;</div>';
include_once("footer.php");
?>

<script type="text/javascript" language="JavaScript">
	document.getElementById("editor_preview").innerHTML = this.opener.getPreviewContent();
</script> 