<?
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
    $access=isset($_GET['access']) ? $_GET['access'] : NULL;
	$id = isset($_GET['id']) ? $_GET['id'] : NULL;
	$judul = isset($_GET['judul']) ? $_GET['judul'] : NULL;
	$bahasa = isset($_GET['bahasa']) ? $_GET['bahasa'] : NULL;
	
	if(($access=='news') and ($id!='')){
		$deskripsi=detail_berita_muat_data(bukaid($id));
		$variable='isi'.$temp;
		$metad=deskripsi(clearhtml($deskripsi[0][$variable]),'160');
		$keyd=keyword(client).', '.keyword($judul);
	}
	else{
		$metad="";
		$keyd='';
	}
	?>
    <meta charset="utf-8">
  	<meta name="robots" content="index, follow" />
	<title><? if ($judul!=''){echo replacesamadengan($judul);}
			 else{echo client;}?></title>
             
    <meta name="keywords" content="<?=$keyd?>"/>
    <meta name="description" content="<?=$metad?>"/>
    
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
    <meta name="Author"    content="CV Citraweb Nusa InfoMedia  - Web programmer: adhyoon | Designer : mbahweng" />
    
    
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" type="text/css" href="<?=app_base_url?>css/style.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?=app_base_url?>css/cni.css" media="screen">
    
    <!--[if lte IE 7]><link rel="stylesheet" href="css/style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" type="text/css" href="<?=app_base_url?>css/style.responsive.css" media="all">
    <link rel="stylesheet" type="text/css" href="<?=app_plugin_url?>slider/flexslider.css" media="all">
    <link rel="stylesheet" type="text/css" href="<?=app_plugin_url?>fancybox/jquery.fancybox.css?v=2.0.3" />
	<link rel="stylesheet" type="text/css" href="<?=app_plugin_url?>fancybox/helpers/jquery.fancybox-buttons.css?v=2.0.3" />
	<link rel="stylesheet" type="text/css" href="<?=app_plugin_url?>fancybox/helpers/jquery.fancybox-thumbs.css?v=2.0.3" />  
    <link rel="stylesheet" type="text/css" href="<?=app_plugin_url?>crousel/jquery.bxslider.css" />  
  
    <script type="text/javascript" src="<?=app_base_url?>js/jquery.js"></script>
    <script type="text/javascript" src="<?=app_base_url?>js/script.js"></script>
    <script type="text/javascript" src="<?=app_base_url?>js/script.responsive.js"></script>
    
    <script type="text/javascript" src="<?=app_plugin_url?>slider/jquery.flexslider.js"></script>
    <script type="text/javascript" src="<?=app_plugin_url?>jquery.bpopup.min.js"></script>
    <script type="text/javascript" src="<?=app_plugin_url?>fancybox/jquery.fancybox.js?v=2.0.3"></script>
    <script type="text/javascript" src="<?=app_plugin_url?>fancybox/helpers/jquery.fancybox-buttons.js?v=2.0.3"></script>
    <script type="text/javascript" src="<?=app_plugin_url?>fancybox/helpers/jquery.fancybox-thumbs.js"></script>
	<script type="text/javascript" src="<?=app_plugin_url?>crousel/jquery.bxslider.min.js"></script>
    
    