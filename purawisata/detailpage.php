<? include "head.php";
if($access=='news'){
$class='berita';
}
else if($access=='event'){
$class='berita';
}
else if($access=='facilities'){
$class='fasilitas';
}
else{
$class=$access;
}
?>
<body>
<script>
$(document).ready(function(){
$(".<?=$class?>").addClass("active");
$(".home").removeClass("active");
$(".desktop-nav").removeClass("cni-nav");
$(".desktop-nav").addClass("cni-navwhite");
$(".cni-hmenu").addClass("spasi");
$(".triangle").removeClass("triangle");
$(".<?=$class?>").append("<div class='triangle'></div>");
  });
</script>
<div id="cni-main">
<? include "header.php"; 
//show_array($_SERVER);
$_SESSION['bahasa']=$bahasa;
?>
<div class="cni-sheet clearfix">
            <div class="cni-layout-wrapper clearfix">
                <div class="cni-content-layout">
                    <div class="cni-content-layout-row">
                        <div class="cni-layout-cell cni-content clearfix"><article class="cni-post cni-article">
                                
                                                
                <div class="cni-postcontent cni-postcontent-0 clearfix"><div class="cni-content-layout">
    <div class="cni-content-layout-row">
    <div class="cni-layout-cell layout-item-0" style="width: 100%" >
        <p><br/></p>
    </div>
    </div>
      <div class="beritainindex">
	<div class="detailberita">	
         <div class="beritakiri">
       		<div class="isikiri">
      			<?=$arrTeks[$access]?>
      		 </div>
             <? if($access=="news"){
			 	$detailberita=detail_berita_muat_data(bukaid($id));
			 	foreach ($detailberita as $data){
			 	if($_SESSION['bahasa'] == 'id'){ ?>
                 <h1><?=$data['nama']?></h1>
                Ditulis Oleh : <?=client?> |  <?=datetimeid($data['tgl_buat']);?>
                <?=getSocialMediaUI()?><br/>
                <div class="imagenews">
               <img align="left" src="<?=$addLink?>images/berita/<?=$data['id']?>.jpg" title="" alt="">
               </div>
               <?=decodeHTML2($data['isi'])?>
             <? } else{ ?>
                <h1><?=$data['nama_e']?></h1>
             Writen by : <?=client?> | <?=datetime($data['tgl_buat']);?>
              <?=getSocialMediaUI()?><br/>
               <div class="imagenews">
               <img align="left" height="100" src="<?=$addLink?>images/berita/<?=$data['id']?>.jpg" title="" alt="">
               </div>
             <?=decodeHTML2($data['isi_e'])?>
             <? }?>
           <? } 
		   }
		   else if($access=="event"){
			 	$detailberita=detail_event_muat_data(bukaid($id));
			 	foreach ($detailberita as $data){
			 	if($_SESSION['bahasa'] == 'id'){ ?>
                 <h1><?=$data['nama']?></h1>
                <?=getSocialMediaUI()?><br/>
                <div class="imagenews">
                  <?	if (file_exists("images/event/thumb/" . $data['id'] . ".jpg")){?>
                       <img src="<?=app_base_url?>images/event/thumb/<?=$data['id']?>.jpg">
                     <? }
					 else{
					 ?>  
                       <img src="<?=app_base_url?>images/event/thumb/default.jpg">
                       <?
					   }
					   ?>
               </div>
               <div>Harga: Rp. <?=$data[$matauang]?></div>
               <div>Venue: <?=$data['namavenue']?></div>
               <div>Deskripsi</div>
               <?=decodeHTML2($data['isi'])?>
                <div class="reservered"><a>PESAN SEKARANG</a></div>
             <? } else{ ?>
                <h1><?=$data['nama_e']?></h1>
              <?=getSocialMediaUI()?><br/>
               <div class="imagenews">
                  <?	if (file_exists("images/event/thumb/" . $data['id'] . ".jpg")){?>
                       <img src="<?=app_base_url?>images/event/thumb/<?=$data['id']?>.jpg">
                     <? }
					 else{
					 ?>  
                       <img src="<?=app_base_url?>images/event/thumb/default.jpg">
                       <?
					   }
					   ?>
               </div>
                   <div>Price : $<?=$data[$matauang]?></div>
                   <div>Venue: <?=$data['namavenue']?></div>
                   <div>Decription:</div>
             		<?=decodeHTML2($data['isi_e'])?>
                    <div class="reservered"><a>RESERVE NOW</a></div>
             <? }
			 } 
		   }
		  else if($access=="facilities"){
		  $detailfasilitas=detail_fasilitas_muat_data(bukaid($id));
		  $varnya=$arrTeks['isi'];
		  $namanya=$arrTeks['nama'];
	
		  foreach ($detailfasilitas as $data){
		  $idfoto=$data['id_foto'];
		 // show_array($detailfasilitas);
				
				?>
                 <h1><?=$data[$namanya]?></h1>
                <?
                echo getSocialMediaUI()."<br/>";
				echo decodeHTML2($data[$varnya]);
				 $tiketbox=tiket_package_muat_data($data['id']);
				  
                ?><p>
                  <table class="tabelharga2" cellpadding="0" cellspacing="0" border="0">
                   <tr>
                   <th>No</th>
                   <th>Package</th>
                   <th>Price</th>
                   <th>Deskripsi</th>
                   </tr>
                   <? 
				   if(count($tiketbox)=="0"){
				   echo "<tr><td colspan='4' class='center'>Data not found</td></tr>";
				   }
				   else{
				   foreach($tiketbox as $angka => $detailtiket){?>
                   <tr>
                   <td class="center"><?=++$angka?></td>
                   <td class="center"><?=$detailtiket['nama']?></td>
                   <td ><?=$arrTeks['simbolmata']." ".$detailtiket[$matauang]?></td>
                   <td><?=$detailtiket['deskripsi'.$temp2]?></td>
                   </tr>   
                   <? } 
				   }
				   ?>
                   </table>      
                </p>
                <p>&nbsp;</p>
                <?
     		 } 
		   }
		  
		   ?>
          
		</div>
    	  </div><!-- End Berita Kiri-->
           
         	<div class="detailberita2">	 
         <? 
		  $gallerikategori=gallery_per_kategori($idfoto,'4');
		  $jmlh=count($gallerikategori);
		  include "beritalainya.php";?>   
            </div>
            <div class="clearfix"></div>
             <? if($jmlh!='0'){?>
        	 <div class="detailfoto <?=$access?>" style="position:relative;">
                    				<div class="headfotolhodetail">
      					<?=$arrTeks['fotoe']?>
     				</div>
     		<div class="fotolho">

                    <div class="galleryinfooter">
                    <? foreach($gallerikategori as $fotolist){?>
                      <a href="<?=app_base_url?>images/foto/<?=$fotolist['id']?>.jpg" class="fancybox-buttons" rel="gallery">  <img src="<?=app_base_url?>images/foto/thumb/<?=$fotolist['id']?>.jpg"> </a>
                    <? }?>
                    </div>
            
                    <div class="buttonselengkapfoto">
                   <a href="<?=app_base_url.$_SESSION['bahasa']."/".saveurl($idfoto)?>/gallery/foto.html"> SELENGKAPNYA</a>
                    </div>
                  
        </div>
        </div><!--End div detail foto-->
        <? }?>
        </div><!--End index berita-->
        
      
	</div>
   
</div>
</article></div>
                    </div>
                </div>
            </div>
    </div>

<footer class="cni-footer clearfix">
<!--Foto dan video content mulai di sini-->
   <div class="bedawarnadetail">
    <div class="isibeda">
                <? include "agendasocial.php";?>
       </div> 
   </div>   
<!--Foto dan video content berakhir di sini-->   
<div class="detailfoot">
<? include "footerdetail.php"; ?>
</div>