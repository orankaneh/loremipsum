<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Detail Transaksi";
include_once("header.php");
include_once("../inc/word.php");
$ui = '';
$addSql = '';

$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];

if($_GET['action']=="confirm"){
_update("update ".tabel_pemesanan." set status ='bayar' where booking='$_GET[booking]'");
_update("update ".tabel_pembayaran." set status ='1' where kode_booking='$_GET[booking]'");
header("location:PaymentList.php");
}


if($_GET) {	
	$id = $_GET['id'];
	$sql = "select tp.*,tb.*,dp.*,tp.id_item as id_fasilitas,tb.jumlah as jumlah_bayar from ".tabel_pembayaran." tb
	left join ".tabel_pemesanan." tp on(tp.booking=tb.kode_booking)
	left join detail_pemesanan dp on(dp.id_pemesanan=tp.id)
	where tb.id='$id'";
	//echo $sql;
	//exit;
	$resC = mysql_query($sql,$baca);
	$numC = mysql_num_rows($resC);
	if($numC<1) {
		header("location:info.php?id=1");
		exit;
	}
	$rowC = mysql_fetch_object($resC);
	//show_array($rowC);
	
	$lname = $rowC->nama;	
	
	$invoice_number = $rowC->booking;
	$type = $rowC->type;
	if($type=="fasilitas"){
	$typejenis="booking";
	$tanggal = datetimeid($rowC->tgl_booking);
	$detfasilias=_select_unique_result("select  nama from  cni_fasilitas where id='".$rowC->id_fasilitas."'");
	$html='
	<tr>
	<td>Fasilitas</td>
	<td>: </td>
	<td>'.$detfasilias['nama'].'</td>
	</tr>';
	}
	else{
	$test=_select_unique_result("select tanggal_mulai,nama from ".tabel_event." where id='".$rowC->id_item."'");
	//echo $test;
	$typejenis="event";
	$tanggal = datetimeid($test['tanggal_mulai']);
	$html='
	<tr>
	<td>Nama Event</td>
	<td>: </td>
	<td>'.$test['nama'].'</td>
	</tr>
	<tr>
	<td>Jumlah Pesan</td>
	<td>: </td>
	<td>'.$rowC->jumlah.'</td>
	</tr>
	';
	}
	
	
	
	$payment = $rowC->payment;
	$phone=$rowC->mobile; 
	$email = $rowC->email;
	$pesan = $rowC->pesan;
	$via = $rowC->via;
	$jumlahbayar = $rowC->jumlah_bayar;
	$tanggalbayar = dateaja2($rowC->bayar);
	$status = ($rowC->status=="order") ? "belum dibayar" : "lunas";
	
	
	if($via=="bank"){
	$bankasal=_select_unique_result("select  bank from  ".bank_account." where id='".$rowC->asal."'");
	$banktujuan=_select_unique_result("select  bank from  ".bank_account." where id='".$rowC->tujuan."'");
	$str='
	<tr>
	<td>Bank Pengirim:</td>
	<td>: </td>
	<td>'.$bankasal['bank'].'</td>
	</tr>
	<tr>
	<td>No Rek Pengirim:</td>
	<td>: </td>
	<td>'.$rowC->norek.'</td>
	</tr>
	<tr>
	<td>Bank Tujuan:</td>
	<td>: </td>
	<td>'.$banktujuan['bank'].'</td>
	</tr>
	';
	}
	else{
	$str='
	<tr>
	<td>Paypal Account:</td>
	<td>: </td>
	<td>'.$rowC->paypal.'</td>
	</tr>
	';
	}
	
	//print_r($rowC);
	//echo $fname."<br/>".$lname."<br/>".$address."<br/>".$phone."<br/>".$email."<br/>";

	$detailpel =
			'<table border="0" class="order">
				<tr>
					<td>Type:</td> <td>: </td> <td>'.$type.'</td>
				</tr>
				<tr>
					<td>No Invoice:</td> <td>: </td> <td>'.$invoice_number.'</td>
				</tr>
				'.$html.'
				<tr>
					<td>Tanggal '.$typejenis.':</td> <td>: </td> <td>'.$tanggal.'</td>
				</tr>
				<tr>
					<td>Nama </td> <td>: </td> <td>'.$lname.'</td>
				</tr>
				<tr>
					<td>Pembayaran</td> <td>: </td> <td>'.$payment.'</td>
				</tr>
	
				<tr>
					<td>HP</td> <td>: </td> <td>'.$phone.'</td>
				</tr>
				
				<tr>
					<td>email</td> <td>: </td> <td>'.$email.'</td>
				</tr>
				
				<tr>
					<td>Pesan Tambahan</td> <td>: </td> <td>'.$pesan.'</td>
				</tr>
			   <tr>
					<td>Status Pembayaran</td> <td>: </td> <td>'.$status.'</td>
				</tr>
			
			</table>
			';
		$detailbayar =
			'<table border="0">
				<tr>
					<td>Pembayaran Melalui:</td> <td>: </td> <td>'.$via.'</td>
				</tr>
				'.$str.'
				<tr>
					<td>No Invoice:</td> <td>: </td> <td>'.$invoice_number.'</td>
				</tr>
				<tr>
					<td>Tanggal Bayar:</td> <td>: </td> <td>'.$tanggalbayar.'</td>
				</tr>
				<tr>
					<td>Jumlah Bayar </td> <td>: </td> <td>'.$jumlahbayar.'</td>
				</tr>
			
			</table>
			';	
}


?>

<div class="judul_menu">List Detail Transaksi</div>---------------------------------------------------------------------------------------------------------------------------------
<br/>Informasi Pemesanan<br/>
---------------------------------------------------------------------------------------------------------------------------------
<?=$detailpel?>
<?=$ui?>

<? if($type=="fasilitas"){?>
Detail Pemesanan

<table border="1" class="detailfasilitas">
<tr>
<th>Paket</th>
<th>Jumlah</th>
<th>Harga Rp</th>
<th>Harga $</th>
<th>Total Rp</th>
<th>Total $</th>
</tr>
<?
$sqldata=_select_arr($sql);
//show_array($sqldata); 
$totalallrp="0";
$totalallud="0";
foreach($sqldata as $data){
$item=_select_unique_result("select  nama,rupiah,dollar from  cni_tiket where id='$data[id_item]'");

$totalrp=$item['rupiah']*$data['jumlah'];
$totalallrp=$totalallrp+$totalrp;

$totalud=$item['dollar']*$data['jumlah'];
$totalallud=$totalallud+$totalud;

echo '<tr>
<td>'.$item['nama'].'</td>
<td align="center">'.$data['jumlah'].'</td>
<td align="right">'.$item['rupiah'].'</td>
<td align="right">'.$item['dollar'].'</td>
<td align="right">'.$item['rupiah']*$data['jumlah'].'</td>
<td align="right">'.$item['dollar']*$data['jumlah'].'</td>
</tr>';
?>
   
 <? 
 }
echo '<tr>
<td colspan="4" align="right">TOTAL ALL : </td>
<td align="right">'.$totalallrp.'</td>
<td align="right">'.$totalallud.'</td>
</tr>'; 
 }?>
</table><br/><br/>
---------------------------------------------------------------------------------------------------------------------------------
<br/>Informasi Pembayaran<br/>
---------------------------------------------------------------------------------------------------------------------------------

<?=$detailbayar?>


---------------------------------------------------------------------------------------------------------------------------------
<br/>
<a href="TransaksiList.php">Kembali ke daftar transaksi</a>
<?php
include_once("footer.php");
?>