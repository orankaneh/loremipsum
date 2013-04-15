<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Order";
include_once("header.php");
include_once("../inc/word.php");
$ui = '';
$addSql = '';

$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];

if($_GET) {	
	$id = $_GET['id'];
	$sql = "select tp.*,dp.*,tp.id_item as id_fasilitas from ".tabel_pemesanan." tp
	join detail_pemesanan dp on(dp.id_pemesanan=tp.id)
	where tp.id='$id'";
	$resC = mysql_query($sql,$baca);
	$numC = mysql_num_rows($resC);
	if($numC<1) {
		header("location:info.php?id=1");
		exit;
	}
	$rowC = mysql_fetch_object($resC);
	//($rowC);
	
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
	$status = ($rowC->status=="order") ? "belum dibayar" : "lunas";
	//print_r($rowC);
	//echo $fname."<br/>".$lname."<br/>".$address."<br/>".$phone."<br/>".$email."<br/>";
	
	$detailpel =
			'<table border="0">
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
}


?>

<div class="judul_menu">List Order Detail</div>

<?=$detailpel?>
<?=$ui?>

<? if($type=="fasilitas"){?>
Detail Pemesanan

<table border="1" class="detailfasilitas">
<tr>
<th>Paket</th>
<th>Jumlah</th>
</tr>
<?
$sqldata=_select_arr($sql);
//show_array($sqldata); 
foreach($sqldata as $data){
$item=_select_unique_result("select  nama from  cni_tiket where id='$data[id_item]'");
echo '<tr>
<td>'.$item['nama'].'</td>
<td>'.$data['jumlah'].'</td>
</tr>';
?>
   
 <? 
 }
 }?>
</table>

<a href="OrderList.php">Kembali ke daftar pemesanan</a>
<?php
include_once("footer.php");
?>