<?
include_once("inc/config.php");
include_once("inc/fungsi.php");
include_once("inc/array.php");
session_start();
ob_start();
if($_SESSION['bahasa'] == 'id'){
			$arrTeks = $arrIndo;
			$temp ="";
			$temp2 ="";
			$judulnews="nama";
			$matauang="rupiah";
		   // $flagI =$flagIn;
		   // $flagE =$flagEn_blur;	
		}else{
			$arrTeks = $arrEn;
			$temp = "_e";
			$temp2 = "en";
			$judulnews="nama_e";
			$matauang="dollar";
		}	

$type = isset($_GET['type']) ? $_GET['type'] : NULL;
$id   = isset($_GET['id']) ? $_GET['id'] : NULL;

	if($type=="event"){
	?>
   <script type="text/javascript">
	  $(function() {
		$("#event").change(function(){
		var kegiatan=$("#event").val();
		hargaevent(kegiatan,"<?=app_base_url?>");
		});
	  }); 
	  	   $(function() {
					$("#jumlahevent").keyup(function(){
						var jumlah=$("#jumlahevent").val();
							if((jumlah!="0") && (jumlah!="00") && (jumlah!="000") && (jumlah!="")){
								var harga=$("#hargangumpet").val();
								var hargat=$("#hargaevents").val();
								var hargarp=$("#hargarupiah").val();
								var hargadolar=$("#hargadollar").val();
								var total=$("#total").val();
								var hasilnya=jumlah*harga;
								var hasilrpnya=jumlah*hargarp;
								var hasildollarnya=jumlah*hargadolar;
								var totalall=total+hasilnya;
								$('#total').val(hasilnya);
								$('#totalrupiah').val(hasilrpnya);
								$('#totaldolar').val(hasildollarnya);
								//hitunghasil();
							}
					   });
					 });  	  
  </script>
    <?
	$sql=_select_arr("select * from ".tabel_event." where kategori ='0' and status ='1' order by tanggal_mulai desc");
	echo '<div class="field-group">';
	echo '<label>'.$arrTeks['agend'].'* </label>';
	echo ' :&nbsp;<select name="event" id="event" class="eventasolole">';
    echo '<option value=""> -'.$arrTeks['pilih'].$arrTeks['agend'].'- </option>';
		foreach($sql as $data){
		echo '<option value="'.$data['id'].'">'.$data['nama'.$temp].' | '.dateaja($data['tanggal_mulai']).'</option>';
		}
	echo '</select></div>';
	?>
        <div class="field-group" id="eventjumlah">
        <label><?=$arrTeks['jumlah']?>* </label>
        :&nbsp;<input class="inputpesan" type="text" id="jumlahevent" name="jumlahevent" maxlength="3"/>
    </div>
          <div class="field-group" id="hargaevent">
        <label> Price* </label>:&nbsp; <?=$arrTeks['simbolmata']?>
        <input class="inputpesan" type="text" id="hargaevents"  name="hargaevents" readonly="readonly"/>
        <input class="inputpesan" type="hidden" id="hargangumpet" name="hargangumpet" readonly="readonly"/>
        <input class="inputpesan" type="hidden" id="hargarupiah"  name="hargarupiah" readonly="readonly"/>
        <input class="inputpesan" type="hidden" id="hargadollar"  name="hargadollar" readonly="readonly"/>
    </div>

    <?
	}
    
	else if($type=="fasilitas"){
	?>
	<script type="text/javascript">
	function harga(harga){
	tarif(harga,"<?=app_base_url?>");
	}
	function hitungtotal(jumlah){
		if((jumlah!="0") && (jumlah!="00") && (jumlah!="000") && (jumlah!="")){
			var harga=$("#hargangumpet1").val();
			var hasilnya=jumlah*harga;
			$('#harga1').val(hasilnya);
		}
	}
	
	
	  $(function() {
		$("#fasilitas").change(function(){
		var fasilitas=$("#fasilitas").val();
		package(fasilitas,"<?=app_base_url?>");
		});
	  });  
  </script>
  <?
	$sql=_select_arr("select * from ".tabel_fasilitas." where status ='1'");
	echo '<div class="field-group">';
	echo '<label>'.$arrTeks['fasilitas'].'* </label>';
	echo ' :&nbsp;<select name="fasilitas" id="fasilitas" class="eventasolole">';
	echo '<option value=""> -'.$arrTeks['pilih'].$arrTeks['fasilitas'].'- </option>';
		foreach($sql as $data){
		echo '<option value="'.$data['id'].'">'.$data['nama'.$temp].'</option>';
		}
	echo '</select></div>';
	}

	else if($type=="package"){
	$sql=_select_arr("select * from cni_tiket where id_fasilitas ='$id'");
	echo '<div class="field-group">';
	echo '<label>'.$arrTeks['paket'].'* :</label>';
	?>
    <script>
  $(document).ready(function(){
        $("#tambahBaris").click(function(){
            var numb= $('.tiket_tr').length+1;
            var string = "<tr class=tiket_tr>"+
                "<td><select name='tiket["+numb+"][package]' id='package"+numb+"' class='eventasolole'>"+
				"<option value=''>-<?=$arrTeks['pilih'].$arrTeks['paket']?>-</option>"+
				<? foreach($sql as $data){?>
				"<option value='<?=$data['id']?>'><?=$data['nama']?></option>"+
				<? }?>
				"</select></div></td>"+
				"<td><input type='text' name='tiket["+numb+"][jumlah]' id='jumlah"+numb+"' onkeyup='Angka(this)' maxlength='3'/></td>"+
				"<td><input type='text' name='tiket["+numb+"][harga]' id='harga"+numb+"' readonly/><input type='hidden' name='tiket["+numb+"][hargangumpet]' id='hargangumpet"+numb+"' readonly/><input type='hidden' name='tiket["+numb+"][hargarupiah]' id='hargarupiah"+numb+"' readonly/><input type='hidden' name='tiket["+numb+"][hargadolar]' id='hargadolar"+numb+"' readonly/></td>"+
				  "<td align='center'><input type='button' class='tombolapus' value='Delete' onclick='hapusBarang(1,this);hitunghasil();'></td>"+
                "</tr>";
            $(".tabelharga2").append(string);
            $('.tiket_tr:eq('+(numb-1)+')').addClass((numb% 2 != 0)?'odd':'even');
			 	 $(function() {
					$("#package"+numb).change(function(){
					if($("#package"+numb).val()!=''){
							$.ajax({
							url:  "<?=app_base_url?>form.php?type=harga&id="+$("#package"+numb).val(),
							type:'GET',
							dataType: 'json',
							success: function(data){
							//alert(data.harga);
							$('#harga'+numb).val(data.harga);
							$('#hargangumpet'+numb).val(data.ngumpet);
							$('#hargapaypall'+numb).val(data.paypall);
							$('#hargarupiah'+numb).val(data.rp);
							$('#hargadolar'+numb).val(data.paypall);
							$('#jumlah'+numb).val("1");	
							hitunghasil();				
							   }
							});
						  }
					   });
				  });
				  
				   $(function() {
					$("#jumlah"+numb).keyup(function(){
						var jumlah=$("#jumlah"+numb).val();
							if((jumlah!="0") && (jumlah!="00") && (jumlah!="000") && (jumlah!="")){
								var harga=$("#hargangumpet"+numb).val();
								var hargat=$("#harga"+numb).val();
								var total=$("#total").val();
								var hasilnya=jumlah*harga;
								var totalall=total+hasilnya;
								$('#harga'+numb).val(hasilnya);
								hitunghasil();
							}
					   });
				  });
				  
				  
  
        });
    })
    function hapusBarang(count,el){
	var parent = el.parentNode.parentNode;
        parent.parentNode.removeChild(parent);
        var penerimaan=$('.tiket_tr');
        var countPenerimaanTr=penerimaan.length;
        for(var i=0;i<countPenerimaanTr;i++){
            $('.tiket_tr:eq('+i+')').removeClass('even');
            $('.tiketbarang_tr:eq('+i+')').removeClass('odd');
            $('.tiket_tr:eq('+i+')').addClass(((i+1) % 2 != 0)?'even':'odd');
        }
    }
	
   	function hitunghasil(){
                   //alert('auo');
                   tot = 0;
                   var totalTemp = 0;
				   var totalrp = 0;
				   var totaldolar = 0;
                   for(var i=1;i<=$('.tiket_tr').length;i++){
                        totalTemp = totalTemp + ($('#hargangumpet'+i).val()*$('#jumlah'+i).val());
						totalrp = totalrp + ($('#hargarupiah'+i).val()*$('#jumlah'+i).val());
						totaldolar = totaldolar + ($('#hargadolar'+i).val()*$('#jumlah'+i).val());
                   }                   
                   $('#total').val(totalTemp);
				   $('#totalrupiah').val(totalrp);
				   $('#totaldolar').val(totaldolar);
				 
   }
	
	
</script>
     <table class="tabelharga2" cellpadding="0" cellspacing="0" border="0">
                   <tr>
                   <th>Package</th>
                   <th><?=$arrTeks['jumlah']?></th>
                   <th>Price(<?=$arrTeks['simbolmata']?>)</th>
                   <th>Delete</th>
                   </tr>
                   <tr class="tiket_tr">                  
                   <td align="center">
                   <select name="tiket[1][package]" id="package1" class="eventasolole" onchange="harga(this.value)">
                   <? 
					echo '<option value=""> -'.$arrTeks['pilih'].$arrTeks['paket'].'- </option>';
						foreach($sql as $data){
						echo '<option value="'.$data['id'].'">'.$data['nama'].'</option>';
						}
					echo '</select></div>';
				   ?>
                   </td>
                   <td><input type="text" name="tiket[1][jumlah]" id="jumlah1" onkeyup="Angka(this);hitungtotal(this.value);hitunghasil()" maxlength="3"/></td>
                    <td><input type="text" name="tiket[1][harga]" id="harga1" readonly/>
                    <input type="hidden" name="tiket[1][hargangumpet]" id="hargangumpet1" readonly/>
                     <input type="hidden" name="tiket[1][hargarupiah]" id="hargarupiah1" readonly/>
                     <input type="hidden" name="tiket[1][hargadolar]" id="hargadolar1" readonly/>
                    </td>
                    <td></td>
                   </tr>
    </table>

    <input type="button" class="tomboltambah" id="tambahBaris">
    
    

    <?
	}
	else if($type=="harga"){
		$sql=_select_unique_result("select ".$arrTeks['duit']." as harga,dollar as paypall,rupiah as rp, ".$arrTeks['duit']." as ngumpet from cni_tiket where id ='$id'");
		die(json_encode($sql));	
	}
	else if($type=="hargaevent"){
		$sql=_select_unique_result("select ".$arrTeks['duit']." as harga,dollar as paypall,rupiah as rp, ".$arrTeks['duit']." as ngumpet from cni_event where id ='$id'");
		die(json_encode($sql));	
	}
exit;
?>
