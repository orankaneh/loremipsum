<? include "head.php";
if($access=='news'){
$class='berita';
}
else if($access=='facilities'){
$class='fasiliatas';
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
                <?=getSocialMediaUI()?>
                <div class="imagenews">
               <img align="left" src="<?=$addLink?>images/berita/<?=$data['id']?>.jpg" title="" alt="">
               </div>
               <?=decodeHTML2($data['isi'])?>
             <? } else{ ?>
                <h1><?=$data['nama_e']?></h1>
             Writen by : <?=client?> | <?=datetime($data['tgl_buat']);?>
              <?=getSocialMediaUI()?>
               <div class="imagenews">
               <img align="left" height="100" src="<?=$addLink?>images/berita/<?=$data['id']?>.jpg" title="" alt="">
               </div>
             <?=decodeHTML2($data['isi_e'])?>
             <? }?>
           <? } 
		   }
		  else if($access=="facilities"){
		  $detailfasilitas=detail_fasilitas_muat_data(bukaid($id));
		  $varnya=$arrTeks['isi'];
		  $namanya=$arrTeks['nama'];
			 	foreach ($detailfasilitas as $data){
				?>
                 <h1><?=$data[$namanya]?></h1>
                <?
                echo getSocialMediaUI();
				echo decodeHTML2($data[$varnya]);
     		 } 
		   }
		   ?>
		</div>
    	  </div><!-- End Berita Kiri-->
           
         	<div class="detailberita2">	 
         <? include "beritalainya.php";?>   
            </div>
            <div class="clearfix"></div>
        	 <div class="detailfoto <?=$access?>">
     		<div class="fotolho">
       				<div class="headfotolho">
      					FOTO
     				</div>
                    <div class="galleryinfooter">
                    <img src="<?=$addLink?>images/dummy/dummy2.jpg"> 
                    <img src="<?=$addLink?>images/dummy/dummy3.jpg">
                    <img src="<?=$addLink?>images/dummy/dummy.jpg">
                    <img src="<?=$addLink?>images/dummy/dummy_10.jpg">
                    </div>
                    <div class="buttonselengkapfoto">
                    SELENGKAPNYA
                    </div>
        </div>
        </div><!--End div detail foto-->
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