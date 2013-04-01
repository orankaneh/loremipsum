<?php
error_reporting(0);
ob_start();
session_start();

$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;

$id = (int) $_GET['id'];
$mode = "";
$judulMenu = "";
if($id>0) {
	$mode = "edit";
	$judulMenu = "Edit Banner";
} else {
	$mode = "add";
	$judulMenu = "Tambah Banner";
}
$judulnya = $judulMenu;

include_once("header.php");
include_once("../inc/fungsi.php");
$strError = "";
$fileUI = "";
$tanggal_mulai = date("d-m-Y");
$tanggal_selesai = date("d-m-Y");

if($mode=="edit") {
	$sqlC = "select * from ".tabel_banner." where id='".$id."'";
	$resC = mysql_query($sqlC,$baca);
	$numC = mysql_num_rows($resC);
	if($numC<1) {
		header("location:info.php?id=1");
		exit;
	}
	$rowC = mysql_fetch_object($resC);
	$nama = $rowC->nama;
	$id_kategori = $rowC->id_kategori;
	$id_kategori_lama = $id_kategori;
	$url = $rowC->url;
	$tanggal_mulai = dateaja($rowC->tanggal_mulai);
	$tanggal_selesai = dateaja($rowC->tanggal_selesai);
	
	$file = "../images/banner/".$rowC->id.".".$rowC->ekstensi;
	$arrSize = @getimagesize($file);
	$fileUI = ($rowC->ekstensi =="swf") ? '<embed name="flashfile" src="'.$file.'" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="'.$arrSize[0].'" height="'.$arrSize[1].'"></embed>' : '<img border="0" style="border:1px solid #000;" src="'.$file.'" title="'.$rowC->nama.'" alt="'.$rowC->nama.'"/>';
}

if($_POST) {
	$nama = encodeHTML($_POST["nama"]);
	$id_kategori = (int) $_POST['id_kategori'];
	$url = encodeHTML($_POST["url"]);
	$tanggal_mulai = $_POST["tanggal_mulai"];
	$tanggal_selesai = $_POST["tanggal_selesai"];

	if(empty($tanggal_mulai)) $tanggal_mulai = date("d-m-Y");
	if(empty($tanggal_selesai)) $tanggal_selesai = date("d-m-Y");
	
	
	// cek semua
	$fileWajibAda = ($mode=="add")? true : false;
	// untuk edit data, jika kategori berubah maka file harus upload ulang
	if($mode=="edit" && $id_kategori_lama!=$id_kategori) $fileWajibAda = true;
	$jenis_banner = $ket_jenis_banner = "";
	if($id_kategori=="1") {
		$jenis_banner = "banner_standar";
		$ket_jenis_banner = "banner standar";
	} else if($id_kategori=="2") {
		$jenis_banner = "banner_utama";
		$ket_jenis_banner = "banner utama";
	}
	
	$strError .= checkFile($_FILES['vFile'], $jenis_banner, $ket_jenis_banner, $fileWajibAda);
	if(empty($nama)) $strError .= "<li>Nama masih kosong</li>";
	if($id_kategori==0) $strError .= "<li>Kategori belum dipilih</li>";
	if(empty($url)) $strError .= "<li>URL masih kosong</li>";
	if($tanggal_mulai > $tanggal_selesai) $strError.= "<li>tanggal mulai tidak boleh lebih dari tanggal selesai</li>";
	
	if(strlen($strError)<1) {	
		
		//$tanggal_mulai_db = date("Y-m-d",$time_a);
		//$tanggal_selesai_db = date("Y-m-d",$time_b);
		
		if($mode=="add") {
			$sql =
				"insert into ".tabel_banner."(id_kategori,nama,ekstensi,url,tanggal_mulai,tanggal_selesai,status,tgl_update,ip_update) values
				 ('".$id_kategori."','".$nama."','-','".$url."','".date2mysql($tanggal_mulai)."','".date2mysql($tanggal_selesai)."','1',now(),'".$_SERVER['REMOTE_ADDR']."') ";
			mysql_query($sql,$tulis);
			$id = mysql_insert_id();
		} else {
			$sql =
				"update ".tabel_banner." set
				 id_kategori='".$id_kategori."',
				 nama='".$nama."',
				 url='".$url."',
				 tanggal_mulai='".date2mysql($tanggal_mulai)."',
				 tanggal_selesai='".date2mysql($tanggal_selesai)."',				 
				 tgl_update=now(),
				 ip_update='".$_SERVER['REMOTE_ADDR']."' where id='".$id."'";
			mysql_query($sql,$tulis);
		}
		
		// upload banner
		$arrExtBanner = getArrExtBanner();
		
		$vFile = $_FILES['vFile']['tmp_name'];
		$vFile_name = $_FILES['vFile']['name'];
		$size2 = @getimagesize($vFile);
		$ekstensi = $arrExtBanner[$size2[2]];
		
		if(is_uploaded_file($vFile)) {
			if($mode=="edit") {
				// hapus banner lama
				$sqlF = "select id, ekstensi from ".tabel_banner." where id='".$id."' ";
				$resF = mysql_query($sqlF,$baca);
				$rowF = mysql_fetch_object($resF);
				@unlink("../images/banner/".$rowF->id.".".$rowF->ekstensi);
			}
		
			$dir = "../images/banner/";
			$vFile_name = "_".$vFile_name;
			
			$namaPhoto = $id;
			$res = copy($vFile, $dir.$vFile_name);
			unlink($vFile);
			$res = rename($dir.$vFile_name, $dir.$namaPhoto.".".$ekstensi);
			
			$sql = "update ".tabel_banner." set ekstensi='".$ekstensi."' where id='".$id."' ";
			mysql_query($sql,$tulis);
		}
		
		header("location:bannerList.php");
		exit;
	}
}

?>

<script type="text/javascript">
	$(document).ready(function() {
		$(".datepicker").datepicker({
			showOn: 'both',
			changeMonth: true,
			changeYear: true,
			gotoCurrent: true,
			buttonImage: '../images/calendar.gif',
			buttonImageOnly: true,
			dateFormat: "dd-mm-yy"
		});
	});
</script>

<div class="judul_menu"><?=$judulMenu?></div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post" action="?id=<?=$id?>" enctype="multipart/form-data">
	<div style="margin:4px;"><?=$fileUI?></div>
	
	<label class="tbless" for="nama">File</label>
	<input type="file" name="vFile" class="inputpesan tbless"/><br class="clear" />
	<div class="pad_tbless">
		Tipe file yang diterima adalah JPG.<br/>
		Ukuran maksimal file adalah <?=(banner_size/1024)?> KB.
	</div>	
	
	<label class="tbless" for="nama">Nama</label>
	<input type="text" name="nama" size="60" value="<?=$nama?>" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="nama">Kategori</label>
	<?=katUI2("banner","id_kategori",$id_kategori,"inputpesan tbless",false)?><br class="clear" />
	
	<label class="tbless" for="url">URL</label>
	<input type="text" name="url" size="60" value="<?=$url?>" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="tanggal">Tanggal</label>
	<input class="datepicker inputpesan tbless" readonly="readonly" type="text" name="tanggal_mulai" value="<?=$tanggal_mulai?>" size="10" /> s/d
	<input class="datepicker inputpesan tbless" readonly="readonly" type="text" name="tanggal_selesai" value="<?=$tanggal_selesai?>" size="10" />
	<br class="clear" />
	
	<label class="tbless" for="">&nbsp;</label>
	<input type="submit" value="Simpan" class="tombol" /><br class="clear" />

	
</form>

<?php
include_once("footer.php");
?>
