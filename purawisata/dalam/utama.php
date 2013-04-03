<?php
ob_start();
session_start();
$judulnya = "WELCOME ADMIN";
include_once("header.php");
include_once("../inc/fungsi.php");
$visitor=statistik_pengunjung();
?>
<fieldset>
<legend style="font-weight:bold;">Statistik Visitor</legend>
<table cellspacing="15" cellspacing="15">
<tr>
<td>Tanggal Hari Ini</td>
<td>:  <?=date("Y-m-d")?></td>
</tr>
<tr>
<td>Jumlah Pengunjung Hari Ini</td>
<td>: <?=$visitor['jmtd']?></td>
</tr>
<tr>
<td>Jumlah IP Pengunjung Hari Ini</td>
<td>: <?=$visitor['perip']?></td>
</tr>
<tr>
<td>Total Pengunjung</td>
<td>: <?=$visitor['jumlah']?></td>
</tr>
<tr>
<td colspan="2">
<a href="http://info.flagcounter.com/sXiU"><img src="http://s03.flagcounter.com/count/sXiU/bg_FFFFFF/txt_000000/border_CCCCCC/columns_2/maxflags_10/viewers_3/labels_0/pageviews_1/flags_0/" alt="Flag Counter" border="0"></a>
</td>
</tr>
</table>
<?
include_once("footer.php");
?>