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
<td>Total Pengunjung</td>
<td>: <?=$visitor['jumlah']?></td>
</tr>
</table>
<div style="float:right">
Powered by Citraweb Nusa Infomedia
</div>
<?
include_once("footer.php");
?>