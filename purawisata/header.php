<?
error_reporting(0);
ob_start();
session_start();?>

<div id="element_to_pop_up">

</div>
<header class="cni-header clearfix">


    <div class="cni-shapes">

<div class="cni-object1467606720" data-left="1.57%">
<img src="<?=app_base_url?>images/object1467606720.png">
</div>

            </div>
            <div class="flag">
            <?
			$urlid=gantibahasa($_SERVER['REQUEST_URI'],'id',$_SESSION['bahasa']);
			$urlen=gantibahasa($_SERVER['REQUEST_URI'],'en',$_SESSION['bahasa']);

		
			?>
           <a href="http://<?=$serverhost.$urlid?>"> <img src="<?=app_base_url?>images/icon/indo.jpg" /></a>
           <a href="http://<?=$serverhost.$urlen?>"> <img src="<?=app_base_url?>images/icon/en.jpg" /></a>
            </div>
<div class="cni-object227400126">
    <form class="cni-search" name="Search" action="javascript:void(0)">
    <input type="text" value="">
    <input type="submit" value="Search" name="search" class="cni-search-button">
</form>
</div>
                        
                    
</header>
<?
//show_array($_SERVER);
$fasilitas=menu_fasilitas_muat_data();
$menudinamisutama=about_us_muat_data();
$menucomplit=dinamis_halaman_muat_data();
$eventauto=event_expire();
//show_array($eventauto);

foreach ($menucomplit as $menudinamis){
$sessioncrypt2561=saveid($menudinamis['halaman_id']);	
$menu.=menu_clean('dropdown', $menudinamis['halaman_id'], app_base_url.$_SESSION['bahasa']."/".$sessioncrypt2561."/".cleanurllho($menudinamis['nama_halaman'.$temp]).".html", '',$temp);
}
?>
<nav class="cni-nav clearfix">
    <div class="cni-nav-inner">
    <ul class="cni-hmenu">
    <li><a href="<?=app_base_url."home/".$_SESSION['bahasa']?>.html" class="home active"><?=$arrTeks['home']?></a></li>
    <li><a href="#" class="tentang"><?=$menudinamisutama['nama_halaman'.$temp]?></a>
    <ul>
    <?=$menu;?>
    </ul>
    </li>    
    <li><a href="#" class="fasilitas"><?=$arrTeks['facilities']?></a>
    	<ul>
        <? foreach($fasilitas as $itemfasilitas){
			$fasilitascrypt=saveid($itemfasilitas['id']);	
		?>
        	<li><a href="<?=app_base_url?>facilities/<?=$_SESSION['bahasa']?>/<?=$fasilitascrypt?>/detail/<?=cleanurllho($itemfasilitas[nama.$temp])?>.html"><?=$itemfasilitas[nama.$temp]?></a></li>
         <? } ?>   
        </ul>
    </li>
      <li><a href="#" class="berita">NEWS AND EVENTS</a>
          <ul>
        	<li><a href="<?=app_base_url."news/".$_SESSION['bahasa']."/list.html"?>">NEWS</a></li>
            <li><a href="<?=app_base_url."events/".$_SESSION['bahasa']."/list.html"?>">EVENTS</a></li>
            <!--<li><a href="<?//app_base_url."promos/".$_SESSION['bahasa']."/list.html"?>">PROMOS</a></li>-->
            <li><a href="<?=app_base_url."list/".$_SESSION['bahasa']."/price.html"?>">TICKET</a></li>
        </ul>
        </li>
     <li><a href="#" class="gallery">GALLERY</a>
    	<ul>
        	<li><a href="<?=app_base_url.$_SESSION['bahasa']."/".saveurl('all')?>/gallery/foto.html">PHOTO</a></li>
            <li><a href="<?=app_base_url.$_SESSION['bahasa']."/".saveurl('all')?>/gallery/video.html">VIDEO</a></li>
        </ul>
    </li>
     <li><a class="contact">CONTACT US</a>
     <ul>
     <li><a onclick="loadmap()"><?=$arrTeks['lakasilho']?></a></li>
     <li><a href="<?=app_base_url.$_SESSION['bahasa']?>/form/contact-us.html">Contact Us</a></li>
     <li><a href="<?=app_base_url.$_SESSION['bahasa']?>/form/guest-book.html">Guest Book</a></li>
     </ul>
     </li>
     <li><a class="booking" href="<?=app_base_url.$_SESSION['bahasa']?>/form/reservation.html">Reservation</a></li>
    </ul> 
     </div>
</nav>