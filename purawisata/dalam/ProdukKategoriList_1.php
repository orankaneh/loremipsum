<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Daftar Kategori Produk";
include_once("header.php");
 include('../inc/SimpleImage.php');
$image = new SimpleImage(); 
$image1 = new SimpleImage(); 
$image2 = new SimpleImage(); 


$ui = '';
$addSql = '';

$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];

if($_GET) {	
	$id = $_GET['id'];
	$q = $_GET["q"];
	
	if (!empty($q)) {
		$q = encodeHTML($q);
		$addSql = " and (nama_kategori like '%".$q."%') ";
	}
	
	if($_GET["m"]=="ubahstatus") {
		$sql = "update ".tabel_produk." set status = IF(status='1','0','1') where id_category='".$id."' ";
		mysql_query($sql,$tulis);
		
		$link = str_replace("&m=ubahstatus","",$_SERVER['REQUEST_URI']);
		header("location:".$link);
		exit;
	}
}

$link = $_SERVER['PHP_SELF']."?z";
if (!empty($q)) $link .= "&q=".$q;

$i = 0;
$sql = "select * from ".tabel_produk." where 1  ".$addSql." order by id_produk asc LIMIT 1001,2000";
//echo $sql;
$arrH = barHalaman($sql, $PageNo, 2250, $link, "../images/search_left.gif", "../images/search_left_off.gif", "../images/search_right.gif", "../images/search_right_off.gif", "C", "id_produk");
//$arrH = barHalaman($sql, $PageNo, 100, $link, "../images/search_left.gif", "../images/search_left_off.gif", "../images/search_right.gif", "../images/search_right_off.gif", "C", "id_produk");
$res = mysql_query($sql,$baca);
$num = mysql_num_rows($res);
while($row=mysql_fetch_object($res)) {
	$status = ($row->status=="1") ? "publish" : "unpublish";
	$status = '<a href="'.$link.'&id='.$row->id_produk.'&m=ubahstatus"><img src="../images/status_'.$row->status.'.gif"/><br/>'.$status.'</a>';
	$imagesid = $row->id_image;
			 $sqlsimpan =
				"insert into cni_produk_pindah(id_kategori,kode_produk,nama_produk,detail,generalinfo,harga,harga_diskon,status,new_arrival,best_seller,sale) values
				 ('".$row->id_kategori."',
				 'P".$row->id_image."',
				 '".$row->name."',
				 '".$row->detail."',
				 '".$row->detail."',
				 '".$row->price."',
				 '0',
				 '1',
				 '0',
				 '0',
				 '0') ";
			mysql_query($sqlsimpan,$tulis);
			
				$ids = mysql_insert_id();
				$idsv =$ids+1;
				//$id_ambil = $ids + 1;
				/* if (file_exists("../images/produk/".$imagesid ."-large.jpg")){
					copy("../images/produk/".$imagesid.".jpg", "../images/muri/".$ids.".jpg");
				}else{
					echo $row->id_image.".jpg Ga Masuk <br/>" ;
				} */
				
				//copy("produk/thumb".$imagesid."-large.jpg", "muri/".$id_ambil.".jpg");
				
				$image2->load("produk/thumb".$imagesid."-large.jpg");
				$image2->resize(195,195);
				$image2->save('muri/'. $idsv .'.jpg');
				
				$image->load("produk/thumb".$imagesid."-large.jpg");
				$image->resize(118,118);
				$image->save('muri/thumb/'. $idsv .'.jpg');
	
		
				$image1->load("produk/thumb".$imagesid."-large.jpg");
				$image1->resize(59,59);
				$image1->save('muri/thumb/'. $idsv .'_dalam.jpg');
			 
	
	$ui .=
		'<tr>
			<td align="center" valign="top">'.($arrH['idx']+$i).'.</td>
			<td align="center" valign="top">'.$row->id_produk.'</td>
			<td align="left" valign="top">'.$row->id_kategori.'</a></td>
			<td align="left" valign="top">'.$row->name.'</a></td>
			<td align="left" valign="top">'.$row->name.'</a></td>
			<td align="left" valign="top">'.$row->price.'</a></td>
			<td align="left" valign="top">'.$row->id_image.'</a></td>
		 </tr>';
	
	$i++;
}

if($num<1) {
	$ui = 'Data not available';
} else {
	$ui =
		$arrH['bar'].'<br/>'.
		'<table width="100%" cellpadding="0" cellspacing="0" class="dtable">
			<tr class="dhead">
				<td align="center" valign="top" width="1%">No</td>
				<td align="center" valign="top">id</td>
				<td align="center" valign="top">id_parent</td>
				<td align="center" valign="top">Nama Produk</td>
				<td align="center" valign="top">Detail</td>
				<td align="center" valign="top">Harga</td>
				<td align="center" valign="top">Id Image</td>
			</tr>
			'.$ui.'
		 </table>';
}
?>

<div class="judul_menu">Daftar Kategori Produk</div>

<div style="margin:10px;">
<form name="cari" action="" method="get">
	<label class="tbless" for="q">kata kunci</label>
	<input type="text" name="q" size="35" value="<?=$q?>" class="inputpesan tbless">
	<input type="submit" value="cari" class="tombol" />
	<br class="clear" />
</form>
</div>

<?=$ui?>

<?php
include_once("footer.php");
?>