<? include "head.php";
$class=$access;
?>
<body>
<div id="cni-main">

<? include "header.php";

$kategorie=bukaurl($kategoriurl);
$idkategorie='';
if($kategorie!='all'){
$idkategorie=$kategorie;
}

if($jenisfile=='video'){
$gallerya=galler_video_muat_data($idkategorie,$page);
}
else{
$gallerya=galler_foto_muat_data($idkategorie,$page);
$fotokat=katagori_foto_muat_data();
}
//show_array($gallerya);
?>
<script>
$(document).ready(function(){
$(".<?=$class?>").addClass("active");
<? if($kategorie!='all'){?>
$(".aktiv").removeClass("aktivasi");
$(".<?=$idkategorie?>").addClass("aktivasi");
<? }?>
$(".home").removeClass("active");
$(".desktop-nav").removeClass("cni-nav");
$(".desktop-nav").addClass("cni-navwhite");
$(".cni-hmenu").addClass("spasi");
$(".triangle").removeClass("triangle");
$(".<?=$class?>").append("<div class='triangle'></div>");
  });
</script>
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

          <div class="gallerylho">
       				<div class="headgallery">
      					GALLERY
     				</div>
                  
                    <div class="kategoryfoto">
                      <?  foreach($fotokat as $datakategori){?>
                      <div class="namakategory <?=$datakategori['id']?>">
                      <div class="ataskn"><a href="<?=app_base_url.$_SESSION['bahasa']."/".saveurl($datakategori['id'])?>/gallery/foto.html"><?=$datakategori['nama']?></a></div>
                      <div class="bawahkn">
                      <?
                      if($jenisfile=='video'){
                      $hitung="0";
					  }
					  else{
                      $hitung=jumlah_foto_muat_data($datakategori['id']);
					  $tampil=$hitung[0]." ".$arrTeks['fotoe'];
                      }
					  
					  echo $tampil;
					  ?>
                      </div>
                      </div>
                       <? }?>  
                    </div>
                    <div class="isigallery">
                    <? foreach ($gallerya['list'] as $koleksifoto){ ?>
                      <img src="<?=app_base_url?>images/foto/<?=$koleksifoto['id']?>.jpg"> 
                     <? } ?> 
                      
                    </div>
                    <?= $gallerya['paging']?>
        </div>
   

</article>
  </div>
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