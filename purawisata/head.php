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
    <meta name="Author" content="CV Citraweb Nusa InfoMedia  - Web programmer: adhyoon | Designer : mbahweng" />
    <meta name="copyright" content="CV Citraweb Nusa InfoMedia  -  Web programmer: adhyoon | Designer : mbahweng">
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="<?=$addLink?>css/style.css" media="screen">
    <link rel="stylesheet" href="<?=$addLink?>css/cni.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="css/style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="<?=$addLink?>css/style.responsive.css" media="all">
    <link rel="stylesheet" href="<?=$addLink?>plugins/slider/flexslider.css" media="all">

    <script src="<?=$addLink?>js/jquery.js"></script>
    <script src="<?=$addLink?>js/script.js"></script>
    <script src="<?=$addLink?>js/script.responsive.js"></script>
    <script src="<?=$addLink?>plugins/slider/jquery.flexslider.js"></script>
    <script src="<?=$addLink?>plugins/jquery.bpopup.min.js"></script>
 
    <script type="text/javascript" charset="utf-8">
  $(window).load(function() {
       $('.flexslider').flexslider({
        animation: "slide",              //String: Select your animation type, "fade" or "slide"
		easing: "swing"  ,
		controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        directionNav: true
    });
  });
</script>
<style>.cni-content .cni-postcontent-0 .layout-item-0 { padding-right: 10px;padding-left: 10px;  }
.ie7 .post .layout-cell {border:none !important; padding:0 !important; }
.ie6 .post .layout-cell {border:none !important; padding:0 !important; }

</style></head>