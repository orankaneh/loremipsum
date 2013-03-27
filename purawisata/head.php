<?
include_once("inc/config.php");
include_once("inc/fungsi.php");
include_once("inc/array.php");
include_once("inc/visitor.php");
session_start();
ob_start();
$_SESSION['bahasa']='en';
if($_SESSION['bahasa'] == 'id'){
	$arrTeks = $arrIndo;
	$temp ="";
	$judulnews="nama";
   // $flagI =$flagIn;
   // $flagE =$flagEn_blur;	
}else{
    $arrTeks = $arrEn;
	$temp = "_e";
	$judulnews="nama_e";
   // $flagE = $flagEn;
   // $flagI =$flagIn_blur;
    

}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta charset="utf-8">
  	<meta name="robots" content="index, follow" />
   <meta name="keywords" content=""/>
    <title><?=client?></title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
    <meta name="Author"    content="CV Citraweb Nusa InfoMedia  - Web programmer: adhyoon | Designer : mbahweng" />
    <meta name="copyright" content="CV Citraweb Nusa InfoMedia  -  Web programmer: adhyoon | Designer : mbahweng">
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="<?=$addLink?>css/style.css" media="screen">
    <link rel="stylesheet" href="<?=$addLink?>css/cni.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="css/style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="<?=$addLink?>css/style.responsive.css" media="all">
    <link rel="stylesheet" href="<?=$addLink?>plugins/slider/flexslider.css" media="all">
    <link rel="stylesheet" type="text/css" href="<?=$addLink?>plugins/fancybox/jquery.fancybox.css?v=2.0.3" />
	<link rel="stylesheet" type="text/css" href="<?=$addLink?>plugins/fancybox/helpers/jquery.fancybox-buttons.css?v=2.0.3" />
	<link rel="stylesheet" type="text/css" href="<?=$addLink?>plugins/fancybox/helpers/jquery.fancybox-thumbs.css?v=2.0.3" />  
  
  
    <script src="<?=$addLink?>js/jquery.js"></script>
    <script src="<?=$addLink?>js/script.js"></script>
    <script src="<?=$addLink?>js/script.responsive.js"></script>
    <script src="<?=$addLink?>plugins/slider/jquery.flexslider.js"></script>
    <script src="<?=$addLink?>plugins/jquery.bpopup.min.js"></script>
    
    
    <script type="text/javascript" src="<?=$addLink?>plugins/fancybox/jquery.fancybox.js?v=2.0.3"></script>
    <script type="text/javascript" src="<?=$addLink?>plugins/fancybox/helpers/jquery.fancybox-buttons.js?v=2.0.3"></script>
    <script type="text/javascript" src="<?=$addLink?>plugins/fancybox/helpers/jquery.fancybox-thumbs.js"></script>

 
    <script type="text/javascript" charset="utf-8">
	  $(window).load(function() {
      	 $('.flexslider').flexslider({
      	 animation: "slide",              //String: Select your animation type, "fade" or "slide"
		 easing: "swing"  ,
		 controlNav: false,
        directionNav: true
    	});
  	 });

	$(document).ready(function() {
	 $(".fancybox-buttons").fancybox({
        padding: 0,
		margin : [0, 0, 0, -270],
		modal: true,
		helpers: {
		buttons: {},
		overlay: {
			opacity: 0,
			css: {'background': '#000'},
			css: {'background': 'rgba(0,0,0,0.9)'} 
			}
		},
		afterShow: function(){
			var description = "<div class='links'>"+$("#description > div").eq(this.index).html()+"</div>"
			$('#fancybox-overlay').html(description);
			$('#page').css("overflow","hidden");	
	},
	
		afterClose:function(){
		    $('#page').css("overflow","auto");	
		},
	
	nextEffect: 'fade',
 prevEffect: 'fade'
 }); // fancybox
}); // ready

</script>
<style>.cni-content .cni-postcontent-0 .layout-item-0 { padding-right: 10px;padding-left: 10px;  }
.ie7 .post .layout-cell {border:none !important; padding:0 !important; }
.ie6 .post .layout-cell {border:none !important; padding:0 !important; }

</style></head>