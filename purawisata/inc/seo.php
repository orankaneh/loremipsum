<?
error_reporting(0);
ob_start();
session_start();
    $access=isset($_GET['access']) ? $_GET['access'] : NULL;
	$id = isset($_GET['id']) ? $_GET['id'] : NULL;
	$judul = isset($_GET['judul']) ? $_GET['judul'] : NULL;
	$bahasa = isset($_GET['bahasa']) ? $_GET['bahasa'] : NULL;
	$kategoriurl = isset($_GET['kategori']) ? $_GET['kategori'] : NULL;
	$jenisfile = isset($_GET['jenis']) ? $_GET['jenis'] : NULL;
	$page = isset($_GET['page']) ? $_GET['page'] : NULL;
	//$get=$_GET;
	//echo generate_get_parameter($get);
		if($bahasa!=NULL){
			$_SESSION['bahasa']=$bahasa;
		}
		else{
			$_SESSION['bahasa']="en";
		}
	
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
		   // $flagE = $flagEn;
		   // $flagI =$flagIn_blur;
			

}
	//exit;
	if(($access=='news') and ($id!='')){
		$deskripsi=detail_berita_muat_data(bukaid($id));
		$variable='isi'.$temp;
		$metad=deskripsi(clearhtml($deskripsi[0][$variable]),'160');
		$keyd=keyword(client).', '.keyword($judul);
	}
	else if(($access=='about') and ($id!='')){
		$deskripsi=detail_dinamis_muat_data(bukaid($id));
		$variable='isi_halaman'.$temp;
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
   <!-- <link href="/en.feed?type=rss" rel="alternate" type="application/rss+xml" title="RSS 2.0" />
    <link href="/en.feed?type=atom" rel="alternate" type="application/atom+xml" title="Atom 1.0" />-->
    <link href="<?=app_base_url?>images/favicon.jpg" rel="shortcut icon" type="image/x-icon" />
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
    <meta name="Author"   content="CV Citraweb Nusa InfoMedia  - Web programmer: adhyoon | Designer : mbahweng" />
    
    
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
  	<link rel="stylesheet" type="text/css" href="<?=app_plugin_url?>jScrollPane/jquery.jscrollpane.css" />  
    
    <script type="text/javascript" src="<?=app_base_url?>js/jquery.js"></script>
    <script type="text/javascript" src="<?=app_base_url?>js/script.js"></script>
    <script type="text/javascript" src="<?=app_base_url?>js/script.responsive.js"></script>
    
    <script type="text/javascript" src="<?=app_plugin_url?>slider/jquery.flexslider.js"></script>
    <script type="text/javascript" src="<?=app_plugin_url?>jquery.bpopup.min.js"></script>
    <script type="text/javascript" src="<?=app_plugin_url?>fancybox/jquery.fancybox.js?v=2.0.3"></script>
    <script type="text/javascript" src="<?=app_plugin_url?>fancybox/helpers/jquery.fancybox-buttons.js?v=2.0.3"></script>
    <script type="text/javascript" src="<?=app_plugin_url?>fancybox/helpers/jquery.fancybox-thumbs.js"></script>
	<script type="text/javascript" src="<?=app_plugin_url?>crousel/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="<?=app_plugin_url?>jScrollPane/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" src="<?=app_plugin_url?>jScrollPane/jquery.mousewheel.js"></script>
    