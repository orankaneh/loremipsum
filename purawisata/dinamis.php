<? include "head.php";
?>
<body>
<script>
$(document).ready(function(){
$(".tentang").addClass("active");
$(".home").removeClass("active");
$(".desktop-nav").removeClass("cni-nav");
$(".desktop-nav").addClass("cni-navwhite");
$(".cni-hmenu").addClass("spasi");
$(".triangle").removeClass("triangle");
$(".tentang").append("<div class='triangle'></div>");
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
      			<?
				$pertamax=nama_top_halaman(bukaid($id));
				$keteng=count($pertamax);
				if($keteng=="0"){
				echo $arrTeks[$access];
				}
				else{
				echo strtoupper($pertamax['nama_halaman'.$temp]);
				}
				
				?>
      		 </div>
             <?
			 	$detaildinamis=detail_dinamis_muat_data(bukaid($id));
			 	foreach ($detaildinamis as $data){?>
                 <h1><?=$data['nama_halaman'.$temp]?></h1>
                <?=getSocialMediaUI()?><br/>
                <div class="imagenews">
               </div><br/>
               <?=decodeHTML2($data['isi_halaman'.$temp])?>
             <? }?>
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