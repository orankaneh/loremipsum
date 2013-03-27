<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
include('../inc/SimpleImage.php');
$image = new SimpleImage();

$id = (int) $_GET['id'];
$mode = "";
$judulMenu = "";
$checket="";
if($id>0) {
	$mode = "edit";
	$judulMenu = "Edit Kategori Produk";
} else {
	$mode = "add";
	$judulMenu = "Tambah Kategori Produk";
}
$judulnya = $judulMenu;
$id_parent=0;

include_once("header.php");

$strError = "";
if($mode=="edit") {
	$sqlC = "select * from ".tabel_kategori." where id_kategori='".$id."'";
	$resC = mysql_query($sqlC,$baca);
	$numC = mysql_num_rows($resC);
	if($numC<1) {
		header("location:info.php?id=1");
		exit;
	}
	$rowC = mysql_fetch_object($resC);
	$nama = $rowC->nama_kategori;
	$id_parent = $rowC->id_parent;
	$no_urut= $rowC->no_urut;
	$def_tampil= $rowC->def_tampil; 
    $warna= '';//$rowC->warna; 
}

if($_POST) {

    
	$nama = encodeHTML($_POST["nama"]);
	$id_parent = (int) $_POST['id_parent'];
	$no_urut= (int) $_POST['no_urut'];
	$jenis = 'icon';
        
  // echo 	$_FILES['fileori']['name'];
  //  echo 	$_FILES['fileori']['name'];
   //	if(is_uploaded_file($_FILES['fileori']['tmp_name']))
   // {
   //     echo 	$_FILES['fileori']['name'];
   // }else
   // {echo 'error';}

	if(empty($nama)) $strError .= "<li>Nama Kategori masih kosong</li>";
	//if(!is_numeric($no_urut)) $strError .= "<li>No Urut Harus Dengan Angka</li>";
    $strError .= checkFile($_FILES['fileori'],$jenis,"icon",$wajibAda);    
	
	if(strlen($strError)<1) {
		if($mode=="add") {
			$sql =
				"INSERT INTO ".tabel_kategori."(id_parent,nama_kategori,no_urut,status) values
				 ('".$id_parent."','".$nama."','".$no_urut."','1') ";
			mysql_query($sql,$tulis);
  	       $id_s = mysql_insert_id();	
		} else {
			$sql =
				"UPDATE ".tabel_kategori." SET
				 id_parent='".$id_parent."',
				 nama_kategori='".$nama."',
				 no_urut='".$no_urut."'
				 where id_kategori='".$id."' ";
			mysql_query($sql,$tulis);
  	      $id_s = $id;
		}
		//echo $sql;
        
        
        

            
		header("location:ProdukKategoriList.php");
		exit;
	}
}

?>

<a></a>
<div class="judul_menu"><?=$judulMenu?></div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post" action="?id=<?=$id?>" ENCTYPE="multipart/form-data">
		
	<label class="tbless" for="nama">Nama Kategori</label>
	<input type="text" name="nama" size="60" value="<?=$nama?>" class="inputpesan tbless"/><br class="clear" />
	
	<label class="tbless" for="no_urut">No Urut</label>
	<input type="text" name="no_urut" size="20" value="<?=$no_urut?>" class="inputpesan tbless"/><br class="clear" />
	
	
	
	<label class="tbless_norm" for="nama">Induk</label>
	<?=katUI("produk","id_parent",$id_parent,"inputpesan tbless")?><br class="clear" />
	
    
  	<!--<label class="tbless_norm" for="nama" >Warna Menu</label>
	<?//=katUI("warna","warna",$warna,"inputpesan")?><br class="clear" />
    <div style="color:pink">&nbsp;</div>
   	<br class="clear" /> -->
    
	<label class="tbless" for="">&nbsp;</label>
	<input type="submit" value="Simpan" class="tombol" />
	<br class="clear" />

</form>


<?php
include_once("footer.php");
?>
