<?php
ob_start();
session_start();
error_reporting(0);
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;

$title_halaman = "No Rekening";
include_once("header.php");
include_once("../inc/fungsi.php");
//show_array($_POST);
if($_POST) {
$bankir= isset($_POST['bank']) ? $_POST['bank'] : NULL;
//show_array($bankir);
if($bankir!=''){
mysql_query("TRUNCATE TABLE ".bank_account."");

	foreach($bankir as $datapost){
	mysql_query("insert into ".bank_account." values ('','$datapost[benk]','$datapost[norek]','$datapost[nama]')");
	}	
		header("location:norek.php");
}
}

?>
<script>
  $(document).ready(function(){
        $("#tambahBaris").click(function(){
            var numb= $('.bank_tr').length+1;
            var string = "<tr class=bank_tr>"+
                "<td align='center'>"+numb+"</td>"+
                "<td><input type='text' name='bank["+numb+"][benk]' id='package"+numb+"' class='text'/></td>"+
				"<td><input type='text' name='bank["+numb+"][norek]' id='deskripsi"+numb+"' class='text'/></td>"+
				 "<td><input type='text' name='bank["+numb+"][nama]' id='deskripsien"+numb+"' class='text'/></td>"+		
                "<td align='center'><input type='button' class='tombol' value='Hapus' onclick='hapusBarang(1,this)'></td>"+
                "</tr>";
            $(".tiket").append(string);
            $('.bank_tr:eq('+(numb-1)+')').addClass((numb% 2 != 0)?'odd':'even');
            counter++;
        });
    })

    function hapusBarang(count,el){
        var parent = el.parentNode.parentNode;
        parent.parentNode.removeChild(parent);
        var penerimaan=$('.bank_tr');
        var countPenerimaanTr=penerimaan.length;
        for(var i=0;i<countPenerimaanTr;i++){
            $('.bank_tr:eq('+i+')').children('td:eq(0)').html(i+1);
            $('.bank_tr:eq('+i+')').removeClass('even');
            $('.bank_tr:eq('+i+')').removeClass('odd');
            $('.bank_tr:eq('+i+')').addClass(((i+1) % 2 != 0)?'even':'odd');
        }
    }
</script>
<div class="judul_menu">No Rek</div>
<?php
$norek=bank_rek_muat_data();
$itungdata=count($norek);
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post">
<table class="tiket" cellpadding="10" cellspacing="2" border="0">
    <tr>
    <th>No.</th>
    <th>Bank</th>
    <th>No Rekening</th>
    <th>Atas Nama</th>
    <th>Aksi</th>
    </tr>
    <? 
	if($itungdata=="0"){?>
     <tr class="bank_tr odd">
    <td align="center">1</td>
    <td><input type="text" name="bank[1][benk]" id="benk1" class="text"/></td>
    <td><input type="text" name="bank[1][norek]" id="norek1" class="text" maxlength="200"/></td>
    <td><input type="text" name="bank[1][nama]" id="nama1" class="text" maxlength="200"/></td>
    <td align="center">-</td>
    </tr>
    <? }
	else{
	//show_array($norek);
	$no="1";
	foreach($norek as $num =>$data){
	?>
    <tr class="bank_tr odd">
    <td align="center"><?=++$num?></td>
    <td><input type="text" name="bank[<?=$no?>][benk]" id="benk<?=++$num?>" class="text" value="<?=$data['bank']?>"/></td>
    <td><input type="text" name="bank[<?=$no?>][norek]" id="norek<?=++$num?>" class="text" value="<?=$data['norek']?>"/></td>
    <td><input type="text" name="bank[<?=$no?>][nama]" id="nama<?=++$num?>" class="text" value="<?=$data['nama']?>"/></td>
    <td align="center"><input type='button' class='tombol' value='Hapus' onclick='hapusBarang(1,this)'></td>
    
    <? 
	$no++;
		}
	}?>
</table>
 <br/>
       <input type="button" class="tombol" value="Tambah Baris" id="tambahBaris">
    <br/><br/>    
	<input type="submit" name="save" id="save" value="Simpan" class="tombol" /><br class="clear" />

	
</form>

<?
include_once("footer.php");
?>