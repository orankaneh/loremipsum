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
	$judulMenu = "Edit fasilitas";
} else {
	$mode = "add";
	$judulMenu = "Tambah fasilitas";
}
$judulnya = $judulMenu;

include_once("header.php");
include('../inc/SimpleImage.php');

$strError = "";
$parent_id = "1";
$image = new SimpleImage();

//cek max id

$idtersembunyi = sessionadmin('4');

if($mode=="edit") {
	$sqlC = "select * from ".tabel_fasilitas." where kategori ='0' and id='".$id."'";
	$resC = mysql_query($sqlC,$baca);
	$numC = mysql_num_rows($resC);
	if($numC<1) {
		header("location:info.php?id=1");
		exit;
	}
	$rowC = mysql_fetch_object($resC);
	$nama = $rowC->nama;
	$namae = $rowC->nama_e;
	$parent_id = $rowC->parent_id;
	$id_gallery = $rowC->id_foto;
	$isi = decodeHTML($rowC->isi);
	$isie = decodeHTML($rowC->isi_e);
	$idtersembunyi=$id;
}

if($_POST) {
	$nama = encodeHTML($_POST["nama"]);
	$namae = encodeHTML($_POST["namae"]);
	$isi =encodeHTML($_POST['isi']);
	$isie = encodeHTML($_POST['isi_e']);
	$id_gallery = $_POST['id_gallery'];
	$tikets = $_POST['tiket'];
	if(empty($nama)) $strError .= "<li>Judul masih kosong</li>";
	if(empty($namae)) $strError .= "<li>Judul bahas inggris masih kosong</li>";
	if(empty($isi)) $strError .= "<li>Konten kosong</li>";
	if(empty($isie)) $strError .= "<li>Konten bahas inggris masih kosong</li>";
	if(empty($tikets)) $strError .= "<li>Belum ada Package masih kosong</li>";
	if(strlen($strError)<1) {		
		if($mode=="add") {
		foreach($tikets as $datapaket){
		$tiketing="insert into cni_tiket values ('','$idtersembunyi','$datapaket[package]','$datapaket[deskripsi]','$datapaket[deskripsien]','$datapaket[rupiah]','$datapaket[dollar]')";
		mysql_query($tiketing,$tulis) or die(mysql_error() . "<hr>" . $tiketing);
		}
			$sql =
				"insert into ".tabel_fasilitas." (parent_id,kategori,id_foto,nama,nama_e,isi,isi_e,status,tgl_buat,tgl_update,ip_update) values
				 ('1','0','$id_gallery','".$nama."','".$namae."','".$isi."','".$isie."','1',now(),now(),'".$_SERVER['REMOTE_ADDR']."') ";
			mysql_query($sql,$tulis) or die(mysql_error() . "<hr>" . $sql);
			$id_s = mysql_insert_id();	
			
			$updatetiket=" update cni_tiket set id_fasilitas='$id_s' where id_fasilitas='$idtersembunyi'";
			mysql_query($updatetiket,$tulis);
		} 
		else {
			$sql =
				"update ".tabel_fasilitas." set
				 parent_id='1',
				 kategori='0',
				 id_foto='$id_gallery',
				 nama='".$nama."',
				 nama_e='".$namae."',
				 isi='".$isi."',
				 isi_e='".$isie."',
				 tgl_update=now(),
				 ip_update='".$_SERVER['REMOTE_ADDR']."' where id='".$id."'";
			mysql_query($sql,$tulis);
			$id_s = $id;	
		
		$deletealltiket=mysql_query("delete from cni_tiket where id_fasilitas ='$idtersembunyi'");
		
		foreach($tikets as $datapaket){
		$tiketing="insert into cni_tiket values ('','$idtersembunyi','$datapaket[package]','$datapaket[deskripsi]','$datapaket[deskripsien]','$datapaket[rupiah]','$datapaket[dollar]')";
		mysql_query($tiketing,$tulis) or die(mysql_error() . "<hr>" . $tiketing);
		}
		
		}
		


		
		header("location:fasilitasList.php");
		//exit;
	}
}

?>
<script>
  $(document).ready(function(){
        $("#tambahBaris").click(function(){
            var numb= $('.tiket_tr').length+1;
            var string = "<tr class=tiket_tr>"+
                "<td align='center'>"+numb+"</td>"+
                "<td><input type='text' name='tiket["+numb+"][package]' id='package"+numb+"' class='text'/></td>"+
				"<td><input type='text' name='tiket["+numb+"][deskripsi]' id='deskripsi"+numb+"' class='text'/></td>"+
				 "<td><input type='text' name='tiket["+numb+"][deskripsien]' id='deskripsien"+numb+"' class='text'/></td>"+		
				"<td><input type='text' name='tiket["+numb+"][rupiah]' id='rupiah"+numb+"' class='text' onkeyup='Angka(this)'//></td>"+
				"<td><input type='text' name='tiket["+numb+"][dollar]' id='dollar"+numb+"' class='text' onkeyup='Desimal(this)'/></td>"+
                "<td align='center'><input type='button' class='tombol' value='Hapus' onclick='hapusBarang(1,this)'></td>"+
                "</tr>";
            $(".tiket").append(string);
            $('.tiket_tr:eq('+(numb-1)+')').addClass((numb% 2 != 0)?'odd':'even');
            counter++;
        });
    })

    function hapusBarang(count,el){
        var parent = el.parentNode.parentNode;
        parent.parentNode.removeChild(parent);
        var penerimaan=$('.tiket_tr');
        var countPenerimaanTr=penerimaan.length;
        for(var i=0;i<countPenerimaanTr;i++){
            $('.tiket_tr:eq('+i+')').children('td:eq(0)').html(i+1);
            $('.tiket_tr:eq('+i+')').removeClass('even');
            $('.tiket_tr:eq('+i+')').removeClass('odd');
            $('.tiket_tr:eq('+i+')').addClass(((i+1) % 2 != 0)?'even':'odd');
        }
    }
</script>

<div class="judul_menu"><?=$judulMenu?></div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post" action="?id=<?=$id?>" ENCTYPE="multipart/form-data">
	<input type="hidden" name="tersembunyi" id="tersembunyi" value="<?=$idtersembunyi?>"/>
	<label class="tbless" for="nama">Judul</label>
	<input type="text" name="nama" size="60" value="<?=$nama?>" class="inputpesan tbless"><br class="clear" />
	<label class="tbless" for="nama">Judul bahasa Inggris</label>
	<input type="text" name="namae" size="60" value="<?=$namae?>" class="inputpesan tbless"><br class="clear" />
	<label class="tbless" for="nama">Gallery Foto</label>
	<?=katUI("galeri","id_gallery",$id_gallery,"inputpesan tbless")?><br class="clear" />
	
	<label class="tbless2" for="nama">
		Konten Bahasa Indonesia
	</label>
	<?php
		$editor = new wysiwygPro();
		$editor->editorURL = editor_url;
		$editor->disableFeatures(array('print','spelling','dirltr','dirrtl','preview'));
		$editor->name = 'isi'; // nama editor
		$editor->value = $isi; // isi editor
		$editor->setupEditor("/".WPRO_DIR.'images/gambar/', site_img_dir, "/".WPRO_DIR.'images/dokumen/', site_doc_dir);
		$editor->cssText = "body {color:#000;background:#FFF;}";
		$editor->display(800, 480);
	?>
    <br/>
		<label class="tbless2" for="nama">
		Konten Bahasa Inggris
	</label>
	<?php
		$editor = new wysiwygPro();
		$editor->editorURL = editor_url;
		$editor->disableFeatures(array('print','spelling','dirltr','dirrtl','preview'));
		$editor->name = 'isi_e'; // nama editor
		$editor->value = $isie; // isi editor
		$editor->setupEditor("/".WPRO_DIR.'images/gambar/', site_img_dir, "/".WPRO_DIR.'images/dokumen/', site_doc_dir);
		$editor->cssText = "body {color:#000;background:#FFF;}";
		$editor->display(800, 480);
	?>
      <br/>
    <label class="tbless2" for="nama">
		Ticket
	</label>
   
    <table class="tiket" cellpadding="10" cellspacing="2" border="0">
    <tr>
    <th>No.</th>
    <th>Package</th>
    <th>Deskripsi Package</th>
    <th>Deskripsi Package Inggris</th>
    <th>Harga Rupiah (Rp)</th>
    <th>Harga Dollar ($)</th>
    <th>Aksi</th>
    </tr>
    <?	if($mode=="add") {?>
    <tr class="tiket_tr odd">
    <td align="center">1</td>
    <td><input type="text" name="tiket[1][package]" id="package1" class="text"/></td>
    <td><input type="text" name="tiket[1][deskripsi]" id="deskripsi1" class="text" maxlength="200"/></td>
    <td><input type="text" name="tiket[1][deskripsien]" id="deskripsien1" class="text" maxlength="200"/></td>
    <td><input type="text" name="tiket[1][rupiah]" 	id="rupiah1" class="text" onkeyup="Angka(this)"/></td>
    <td><input type="text" name="tiket[1][dollar]" 	id="dollar1" class="text" onkeyup="Desimal(this)"/></td>
    <td align="center">-</td>
    </tr>
    <? }
	else{
	$packagedata=tiket_package_muat_data($id);
	foreach($packagedata as $num => $extractdata){
	?>
    <tr class="tiket_tr odd">
    <td align="center"><?=++$num?></td>
    <td><input type="text" name="tiket[<?=$num?>][package]" id="package<?=$num?>" class="text" value="<?=$extractdata['nama']?>"/></td>
    <td><input type="text" name="tiket[<?=$num?>][deskripsi]" id="deskripsi<?=$num?>" class="text" value="<?=$extractdata['deskripsi']?>" maxlength="200"/></td>
     <td><input type="text" name="tiket[<?=$num?>][deskripsien]" id="deskripsien<?=$num?>" class="text" value="<?=$extractdata['deskripsien']?>" maxlength="200"/></td>
    <td><input type="text" name="tiket[<?=$num?>][rupiah]" 	id="rupiah<?=$num?>" class="text" value="<?=$extractdata['rupiah']?>" onkeyup="Angka(this)"/></td>
    <td><input type="text" name="tiket[<?=$num?>][dollar]" 	id="dollar<?=$num?>" class="text" value="<?=$extractdata['dollar']?>" onkeyup="Desimal(this)"/></td>
    <td align="center">-</td>
    </tr>
    <?
	}
	}
	?>
    </table>
    <br/>
       <input type="button" class="tombol" value="Tambah Baris" id="tambahBaris">
    <br/>
	<label class="tbless" for="">&nbsp;</label><br/>
	<input type="submit" value="Simpan" class="tombol" /><br class="clear" />

	<br/><br/>
</form>

<?php
include_once("footer.php");
?>
