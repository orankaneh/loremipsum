<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Order";
include_once("header.php");
$ui = '';
$addSql = '';
$addSql2 = '';
$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];

if($_GET) {	
	$id = $_GET['id'];
	$q = $_GET["q"];
	$type = $_GET["type"];
	
	if($type!="invoice"){
		if (!empty($q)) {
			$q = encodeHTML($q);
			$addSql = " and tp.nama like '%$q%'";
		}
	
		if (!empty($type)) {
			$addSql2 = " and  tp.type='$type'";
		}
	}
	else{
	$addSql = " and tp.booking='$q' group by tp.id";
	}
	
	
	
	if($_GET["m"]=="ubahstatus") {
	   if($_GET['status']=="order"){
	   $status="bayar";
	   }
	   else{
	    $status="order";
	   }
		$sql = "update ".tabel_pemesanan." set status = '".$status."' where id='".$id."' ";
		mysql_query($sql,$tulis);
		
		$link = str_replace("&m=ubahstatus","",$_SERVER['REQUEST_URI']);
		header("location:".$link);
		exit;
	}
		if($_GET["m"]=="hapusdata" && $id > 0){
		$sqlU="delete from ".tabel_pemesanan." where id='".$id."'";
		$sqlU2="delete from detail_pemesanan where id_pemesanan='".$id."'";
		//echo $sqlU;
		mysql_query($sqlU,$tulis);
		mysql_query($sqlU2,$tulis);
	}
}

$link = $_SERVER['PHP_SELF']."?z";
if (!empty($q)) $link .= "&q=".$q;

$i = 0;
$sql = "select tp.*,tb.*,tb.id as id_bayar from ".tabel_pembayaran." tb
left join ".tabel_pemesanan." tp on(tp.booking=tb.kode_booking)
left join detail_pemesanan dp on(dp.id_pemesanan=tp.id)
where tb.status='0' ".$addSql.$addSql2." group by tb.id
order by tb.id desc
";
//echo $sql;
$arrH = barHalaman($sql, $PageNo, 20, $link, "../images/search_left.gif", "../images/search_left_off.gif", "../images/search_right.gif", "../images/search_right_off.gif", "C", "id");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);
while($row=mysql_fetch_object($res)) {
	$status = ($row->status=="order") ? "belum dibayar" : "lunas";
	$status = '<a href="'.$link.'&id='.$row->id.'&m=ubahstatus&status='.$row->status.'"><img src="../images/'.$row->status.'.gif"/><br/>'.$status.'</a>';
	$hapus = '<a href="'.$link.'&id='.$row->id.'&m=hapusdata" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><img src="../images/delete.png"/></a>';
	$lname = $row->nama; 
	$payment = $row->via;
	$type = $row->type;
	$email = $row->email;
if($type=="fasilitas"){
	$typejenis="booking";
	$tanggal = dateaja2($row->bayar);
	}
	else{
	$test=_select_unique_result("select tanggal_mulai from ".tabel_event." where id='".$row->id_item."'");
	//echo $test;
	$typejenis="event";
	$tanggal = datetimeid($test['tanggal_mulai']);
	}
	
	$induk = "";

	$ui .=
		'<tr>
			<td align="center" valign="top">'.($arrH['idx']+$i).'.</td>
			<td align="left" valign="top"><a href="PaymentListDetail.php?id='.$row->id_bayar.'">'.$lname.'</a></td>
			<td align="center" valign="top">'.$tanggal.'</td>
			<td align="center" valign="top">'.$payment.'</td>
			<td align="center" valign="top">'.$type.'</td>
			<td align="center" valign="top">'.$email.'</td>
		 </tr>';
	
	$i++;
}

if($num<1) {
	$ui = 'Data not available<br/>
	<a href="OrderList.php">Kembali ke daftar pemesanan</a>';
} else {
	$ui =
		$arrH['bar'].'<br/>'.
		'<table width="100%" cellpadding="0" cellspacing="0" class="dtable">
			<tr class="dhead">
				<td align="center" valign="top" width="1%">No</td>
				<td align="center" valign="top">Nama Pelanggan</td>
				<td align="center" valign="top">Tanggal Bayar</td>
				<td align="center" valign="top">Pembayaran</td>
				<td align="center" valign="top">Type</td>
				<td align="center" valign="top">Email</td>
			</tr>
			'.$ui.'
		 </table>';
}
?>

<div class="judul_menu">Informasi Pembayaran</div>

<div style="margin:10px;">
<form name="cari" action="" method="get">
	<label class="tbless" for="q">kata kunci</label>
	<input type="text" name="q" size="35" value="<?=$q?>" class="inputpesan tbless">
    <select id="type" name="type">
     <option value=""> </option>
    <option value="invoice">No Invoice</option>
    <option value="fasilitas">Fasliltias</option>
    <option value="event">Event</option>
    </select>
	<input type="submit" value="cari" class="tombol" />
	<br class="clear" />
</form>
</div>

<?=$ui?>

<?php
include_once("footer.php");
?>