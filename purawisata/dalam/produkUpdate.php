<?php
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
	$judulMenu = "Edit Produk";
} else {
	$mode = "add";
	$judulMenu = "Tambah Pruduk";
}
$judulnya = $judulMenu;

include_once("header.php");
include('../inc/SimpleImage.php');
$image = new SimpleImage();
$image1 = new SimpleImage();
$image2 = new SimpleImage();
$image3 = new SimpleImage();

$strError = "";
if($mode=="edit") {
	$sqlC = "select * from ".tabel_produk." where 1  and id_produk='".$id."'";
	$resC = mysql_query($sqlC,$baca);
	$numC = mysql_num_rows($resC);
	if($numC<1) {
		header("location:info.php?id=1");
		exit;
	}
	$rowC = mysql_fetch_object($resC);
  
	$id_kategori = $rowC->id_kategori;
	$kode_produk = $rowC->kode_produk;
	$nama_produk = $rowC->nama_produk;
	$generalinfo = decodeHTML($rowC->generalinfo);
	$detail = decodeHTML($rowC->detail);
	$harga = $rowC->harga;
	$harga_diskon = $rowC->harga_diskon;
	$status = $rowC->status;
	$new_arrival= $rowC->new_arrival; 
	$best_seller = $rowC->best_seller;
	$sale = $rowC->sale;
	
	

}

if($_POST) {

	$id_kategori = (int) $_POST[id_kategori];
	$kode_produk = $_POST[kode_produk];
	$nama_produk = $_POST[nama_produk];
	$detail = $_POST[detail];
	$harga = $_POST[harga];
	$harga_diskon = $_POST[harga_diskon];
	$status = $_POST[status];
	$new_arrival= $_POST[new_arrival]; 
	$best_seller = $_POST[best_seller];
	$sale = $_POST[sale];
	$generalinfo = $_POST[generalinfo];
	
	
	if(empty($kode_produk)) $strError .= "<li>Kode  Produk masih kosong</li>";
	if(empty($nama_produk)) $strError .= "<li>Nama  Produk masih kosong</li>";
	if(empty($detail)) $strError .= "<li>Product Info masih kosong</li>";
	if(empty($generalinfo)) $strError .= "<li>General Info masih kosong</li>";
	if(!is_numeric($harga)) $strError .= "<li>Harga masih kosong .</li>";

	if($id_kategori==0) $strError .= "<li>Kategori belum dipilih</li>";
	
	
	if(is_uploaded_file($_FILES['produk']['tmp_name'])){
		$size2 = GetImageSize($_FILES['produk']['tmp_name']);
		//print_r($size2);
		
		if($size2[0] != produk_w) $strError=$strError."<li>Product width must be ".produk_w." pixels!";
		if($size2[1] != produk_h) $strError=$strError."<li>Product height must be ".produk_h." pixels!";	
			
		if (!($_FILES['produk']['type']=="image/pjpeg" or $_FILES['produk']['type']=="image/jpeg")) $strError=$strError. "<li>File type must be JPG."; 
	}else{
		if(empty($id)){
			$strError=$strError. "<li>Product still empty."; 
		}	
	}
	
	if($sale=='1' && $mode=="add"){
		echo $sale;
		if(is_uploaded_file($_FILES['iklan']['tmp_name'])){
			$size1 = GetImageSize($_FILES['iklan']['tmp_name']);

			if($size1[0] != iklan_w) $strError=$strError."<li>Iklan width must be ".iklan_w." pixels!";
			if($size1[1] != iklan_h) $strError=$strError."<li>Iklan height must be ".iklan_h." pixels!";	
				
			if (!($_FILES['iklan']['type']=="image/pjpeg" or $_FILES['iklan']['type']=="image/jpeg")) $strError=$strError. "<li>File type must be JPG."; 
		}else{
			$strError=$strError. "<li>Iklan still empty."; 
		}
	}else{
		echo 'ga ada';
	}
	

 

	if(strlen($strError)<1) {		
		if($mode=="add") {
			$sql =
				"insert into ".tabel_produk."(id_kategori,kode_produk,nama_produk,detail,generalinfo,harga,harga_diskon,status,new_arrival,best_seller,sale) values
				 ('".$id_kategori."',
				 '".$kode_produk."',
				 '".$nama_produk."',
				 '".cleanEditor("../",$detail)."',
				 '".cleanEditor("../",$generalinfo)."',
				 '".$harga."',
				 '".$harga_diskon."',
				 '1',
				 '".$new_arrival."',
				 '".$best_seller."',
				 '".$sale."') ";
			mysql_query($sql,$tulis);
			
				$ids = mysql_insert_id();
				
				if(is_uploaded_file($_FILES['produk']['tmp_name'])){
					copy($_FILES['produk']['tmp_name'], "../images/produk/" . $ids . "_zoom.jpg");
				}
			
			if(is_uploaded_file($_FILES['produk']['tmp_name'])){
				if (file_exists("../images/produk/" . $ids . ".jpg")) unlink("../images/produk/" . $ids . ".jpg");
				$image->load("../images/produk/" . $ids . "_zoom.jpg");
				$image->resize(195,195);
				$image->save('../images/produk/'. $ids .'.jpg');
			}
			
			if(is_uploaded_file($_FILES['produk']['tmp_name'])){
				if (file_exists("../images/produk/thumb/" . $ids . ".jpg")) unlink("../images/produk/thumb/" . $ids . ".jpg");
				$image1->load("../images/produk/" . $ids . "_zoom.jpg");
				$image1->resize(118,118);
				$image1->save('../images/produk/thumb/'. $ids .'.jpg');
			}
			
			if(is_uploaded_file($_FILES['produk']['tmp_name'])){
				if (file_exists("../images/produk/thumb/" . $ids . "_dalam.jpg")) unlink("../images/produk/thumb/" . $ids . "_dalam.jpg");
				$image2->load("../images/produk/" . $ids . "_zoom.jpg");
				$image2->resize(59,59);
				$image2->save('../images/produk/thumb/'. $ids .'_dalam.jpg');
			}
			
				if(is_uploaded_file($_FILES['iklan']['tmp_name'])){
					copy($_FILES['iklan']['tmp_name'], "../images/produk/iklan/" . $ids . ".jpg");
				}
				
		} else {  
			$sql =
				"update ".tabel_produk." set
				 id_kategori='".$id_kategori."',
				 kode_produk='".$kode_produk."',
				 nama_produk='".$nama_produk."',
				 detail='".cleanEditor("../",$detail)."',
				 generalinfo='".cleanEditor("../",$generalinfo)."',
				 harga='".$harga."',
				 harga_diskon='".$harga_diskon."',
				 new_arrival='".$new_arrival."',
				 best_seller='".$best_seller."',
				 sale='".$sale."' 
				 where id_produk='".$id."'";
			mysql_query($sql,$tulis);
				//echo $sql;
			if(is_uploaded_file($_FILES['produk']['tmp_name'])){
				unlink("../images/produk/" . $id . ".jpg");
				copy($_FILES['produk']['tmp_name'], "../images/produk/".$id."_zoom.jpg");
				
			}
			
			if(is_uploaded_file($_FILES['produk']['tmp_name'])){
				if (file_exists("../images/produk/thumb/" . $id . ".jpg")) unlink("../images/produk/" . $id . ".jpg");
				$image->load("../images/produk/" . $id . "_zoom.jpg");
				$image->resize(195,195);
				$image->save('../images/produk/'. $id .'.jpg');
			}
			
			if(is_uploaded_file($_FILES['produk']['tmp_name'])){
				if (file_exists("../images/produk/thumb/" . $id . ".jpg")) unlink("../images/produk/thumb/" . $id . ".jpg");
				$image->load("../images/produk/" . $id . "_zoom.jpg");
				$image->resize(118,118);
				$image->save('../images/produk/thumb/'. $id .'.jpg');
			}
			
			if(is_uploaded_file($_FILES['produk']['tmp_name'])){
				if (file_exists("../images/produk/thumb/" . $id . "_dalam.jpg")) unlink("../images/produk/thumb/" . $id . "_dalam.jpg");
				$image->load("../images/produk/" . $id . "_zoom.jpg");
				$image->resize(59,59);
				$image->save('../images/produk/thumb/'. $id .'_dalam.jpg');
			}
			
			if(is_uploaded_file($_FILES['iklan']['tmp_name'])){
				unlink("../images/produk/iklan/" . $id . ".jpg");
				copy($_FILES['iklan']['tmp_name'], "../images/produk/iklan/" . $id . ".jpg");
				
			}
			
		
			
		}
		
		header("location:produkList.php");
		exit; 
	}
}

$HideIklan= "
		<script>
			$('#SetIklan').hide();
		</script>
		";
		
$ShowIklan= "
		<script>
			$('#SetIklan').show();
		</script>
		";
		
?>

<script type="text/javascript" language="JavaScript">
function getPreviewContent() {
	WPro.editors['deskripsi'].updateValue();
	return WPro.editors['deskripsi'].getValue();
}
function doPreview() {	
	var preWin = window.open('../preview.php','preWin');
}

function toggleThumbnail(){
	$("#SetIklan").toggle();
}

</script> 

<div class="judul_menu"><?=$judulMenu?></div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form ENCTYPE="multipart/form-data" method="post" action="?id=<?=$id?>">
	
	<label class="tbless" for="kode_produk">Kode Produk</label>
	<input type="text" name="kode_produk" size="60" value="<?=$kode_produk?>" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="nama_produk">Nama Produk</label>
	<input type="text" name="nama_produk" size="60" value="<?=$nama_produk?>" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="price">Harga</label>
	<input type="text" name="harga" size="60" value="<?=$harga?>" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="harga_diskon">Harga Diskon</label>
	<input type="text" name="harga_diskon" size="60" value="<?=$harga_diskon?>" class="inputpesan tbless"><br class="clear" />
	
	
	<label class="tbless" for="new_arrival">New</label>
	<? if($new_arrival==1){
			$checked1="checked";
	   }
	?>
	<input type="checkbox" name="new_arrival" size="20" value="1" <?=$checked1;?> ><br class="clear" />
	
	<label class="tbless" for="best_seller">Best Seller</label>
	<? if($best_seller==1){
			$checked2="checked";
	   }
	?>
	<input type="checkbox" name="best_seller" size="20" value="1" <?=$checked2;?> ><br class="clear" />
	
	<label class="tbless_norm" for="produk">Kategori Produk</label>
	<?=katUI("produk","id_kategori",$id_kategori,"inputpesan tbless")?><br class="clear" />
	
	<label class="tbless2" for="detail">
		Detail
	</label>
	<?php
		$editor = new wysiwygPro();
		$editor->editorURL = editor_url;
		$editor->disableFeatures(array('print','spelling','dirltr','dirrtl','preview'));
		$editor->name = 'detail'; // nama editor
		$editor->value = $detail; // isi editor
		$editor->setupEditor("/".WPRO_DIR.'images/gambar/', site_img_dir, "/".WPRO_DIR.'images/dokumen/', site_doc_dir);
		$editor->cssText = "body {color:#000;background:#FFF;}";
		$editor->display(600, 480);
	?>
	
	<label class="tbless2" for="generalinfo">
		General Info
	</label>
	<?php
		$editor = new wysiwygPro();
		$editor->editorURL = editor_url;
		$editor->disableFeatures(array('print','spelling','dirltr','dirrtl','preview'));
		$editor->name = 'generalinfo'; // nama editor
		$editor->value = $generalinfo; // isi editor
		$editor->setupEditor("/".WPRO_DIR.'images/gambar/', site_img_dir, "/".WPRO_DIR.'images/dokumen/', site_doc_dir);
		$editor->cssText = "body {color:#000;background:#FFF;}";
		$editor->display(600, 480);
	?>
	
	
	
	<!-- Tombol Upload1-->
		<label class="tbless" for="produk">Image Utama</label> 
		<input type="file" name="produk"  class="inputpesan"/>  <br class="clear" />
		
		<?
			if(file_exists("../images/produk/".$id.".jpg")){
				$gambar1 ="<img src='../images/produk/".$id.".jpg'><br><br>";
			}
			if(file_exists("../images/produk/thumb/".$id.".jpg")){
				$gambar2 ="<img src='../images/produk/thumb/".$id.".jpg'><br><br>";
			}
			if(file_exists("../images/produk/thumb/".$id."_dalam.jpg")){
				$gambar3 ="<img src='../images/produk/thumb/".$id."_dalam.jpg'><br><br>";
			}
		?>
		<table border="0" cellpadding="0" cellspacing="0" style="background:white;" width="500">
			<tr>
				<td align="center" valign="center"> <?=$gambar1;?></td>
				<td align="center" valign="center"> <?=$gambar2;?></td>
				<td align="center" valign="center"> <?=$gambar3;?></td>
			</tr>
		</table>
	<!-- End Tombol Upload-->
	<br class="clear" /> 

	<!-- End Tombol Upload Iklan-->
	<label class="tbless" for="popular_product">Iklan</label>
	<? if($sale==1){
			$checked3="checked";
			$displaynyo = 'display:block;';
	   }else{
			$displaynyo = 'display:none;';
			echo $HideIklan;
	   }
	?>
	<input type="checkbox" name="sale" size="20" value="1" <?=$checked3;?> onclick="javascript:toggleThumbnail();" ><br class="clear" />
	<div style="<?=$displaynyo?>" id="SetIklan">
		<label class="tbless" for="file">Gambar Iklan</label> <input type="file" name="iklan"  class="inputpesan"/>  <br class="clear" />
		<?
			if(file_exists("../images/produk/iklan/".$id.".jpg")){
				echo "<img src='../images/produk/iklan/".$id.".jpg'><br><br>";
			}
		?>
	</div>
	<!-- End Tombol Upload Iklan-->
	
	<label class="tbless" for="">&nbsp;</label>
	<input type="submit" value="Simpan" class="tombol" /><br class="clear" />

	
</form>

<?php
/* if($sale == '1'){ echo $HideIklan; } */
include_once("footer.php");
?>
