<?php
ob_start();
session_start();

$html_title = "Daftar Tamu";
include_once("header.php");

$judul = "Daftar Tamu";
$isi = "";

if($_GET) {
	$PageNo = $_GET['PageNo'];
}

$titikFolder = "";
$sql = "select * from ".tabel_tamu." where status='1' and id_parent='0' and kategori='pengunjung' order by id desc";
$arrH = barHalaman($sql, $PageNo, 10, $link, "images/search_left.gif", "images/search_left_off.gif", "images/search_right.gif", "images/search_right_off.gif", "S", "id");

$res = mysql_query($arrH['sql'],$baca);
$i = 0;
$arr = array();
$maxTeks = 30;
while($row=mysql_fetch_object($res)) {
	$arr[$i]['no'] = $arrH['idx']+$i;
	$arr[$i]['id'] = $row->id;
	$arr[$i]['nama'] = $row->nama;
	$arr[$i]['email'] = $row->email;
	$arr[$i]['url'] = $row->url;
	$arr[$i]['alamat'] = $row->alamat;
	$arr[$i]['pesan'] = $row->isi;
	$arr[$i]['tgl'] = $row->tgl_guest;
	
	$arr[$i]['teks_isi'] = $row->isi;	
	$arr[$i]['teks_tgl'] = tglIndo($row->tgl_guest,"l",0);
	
	$pesanBalasan = '';
	$sql2 = "select isi from ".tabel_tamu." where id_parent='".$row->id."' and kategori='admin' and status='1' ";
	$res2 = mysql_query($sql2,$baca);
	$row2 = mysql_fetch_object($res2);
	if(mysql_num_rows($res2)>0) {
		$pesanBalasan =
			'<div style="margin-top:8px;padding:6px;background:#E9E9E3;border:1px solid #FFF;">
				<b>Admin</b>:<br/>'.
				$row2->isi.
			'</div>';
	}
	
	$isi .=
		'<tr>'.
		'<td valign="top" align="left" style="color:#000;background:#DFDFDF;"><b>'.$arr[$i]['nama'].'</b><br/>'.$arr[$i]['alamat'].'</td>'.
		'<td valign="top" align="justify" style="color:#000;background:#DFDFDF;">'.$arr[$i]['teks_tgl'].'</span><br/>'.$arr[$i]['teks_isi'].''.$pesanBalasan.'</td>'.
		'</tr>';
	
	$i++;
}
if(empty($isi)) {
	$isi = "Data Not Available.";
} else {
	$isi =
		'<table border="0" cellpadding="5" cellspacing="1" width="100%">'.
		'<thead>
			<td width="25%" style="font-weight:bold;;background:#06450A;color:#FFF;">Nama</td>
			<td style="font-weight:bold;;background:#06450A;color:#FFF;">Pesan</td>
		</thead>'.
		$isi.
		'</table><br/><br/><br/>';
}

?>

<div class="judulmenu2"><?=$judul?></div>
<div>
	<div style="padding:0 0 8px 0;text-align:center;"><a href="tamu.php"><img border="0" alt="isi buku tamu" src="images/tamu.png"/></a></div>
	<?=$isi?><br/>
	<?=$arrH['bar'];?>
</div>

<?php
include_once("footer.php");
?>