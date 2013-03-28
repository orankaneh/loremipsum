<?php
error_reporting(0);
if($_SERVER['SERVER_NAME']=="192.168.120.13" || $_SERVER['SERVER_NAME']=="localhost" || $_SERVER['SERVER_NAME']=="web2.web") {
	$accNya = "lokal";
} else {
	$accNya = "remote";
}

$client="Purawisata Jogja";
if($accNya == "lokal") {
	$host="localhost";
	$user="root";
	$passwordMySql="";
	$db="purawisata";
	$tulis=mysql_connect($host,$user,$passwordMySql);
	$baca=mysql_connect($host,$user,$passwordMySql);
	$connectdb1=mysql_select_db($db,$tulis);
	$connectdb2=mysql_select_db($db,$baca);
	$urlNya = "http://".$_SERVER['HTTP_HOST']."/loremipsum/purawisata/";
	$addLink = $urlNya;
} elseif($accNya == "remote") {
	$host="localhost";
	$user="user_name";
	$passwordMySql="pass_word";
	$db="nama_database";
	$tulis=mysql_connect($host,$user,$passwordMySql);
	$baca=mysql_connect($host,$user,$passwordMySql);
	$connectdb1=mysql_select_db($db,$tulis);
	$connectdb2=mysql_select_db($db,$baca);
	$urlNya = "http://purawisatajogjakarta.com/";
	$addLink = "/";
}

if ($connectdb1==false || $connectdb2==false) {
	$url = "error.php";
	if(ereg("/dalam/",$_SERVER['PHP_SELF'])) $url = "../error.php?f=a";
    header("location:".$url);
	exit;
}

// - config - database & aplikasi -----------------------------------------------------------
define("password_min_kar",5);
define("banner_w1",150);
define("banner_h1",70);
define("banner_w2",300);
define("banner_h2",140);
define("banner_size",512000);
define("file_download_size",512000);
define("tabel_halaman", "cni_halaman");
define("tabel_user", "cni_user");
define("tabel_user_detail", "cni_user_detail");
define("tabel_berita", "cni_berita");
define("tabel_fasilitas", "cni_fasilitas");
define("tabel_banner", "cni_banner");
define("tabel_foto", "cni_foto");
define("tabel_header_slideshow", "cni_header_slideshow");
define("tabel_video", "cni_video");
define("tabel_tamu", "cni_guestbook");
define("tabel_paypal", "cni_paypal");
define("tabel_produk", "cni_produk");
define("tabel_script", "cni_script");
define("tabel_kategori", "cni_kategori");
define("tabel_pesan", "cni_pesan");
// - config - database & aplikasi -----------------------------------------------------------

// - config - email -----------------------------------------------------------
define("email_config_host","mail.citra.web.id");
define("email_config_username","rizaldy@citra.web.id");
define("email_config_password","sports123");
// - config - email -----------------------------------------------------------

// - config - SosialMedia -----------------------------------------------------------
define("facebook","http://www.facebook.com/client");
define("twitter","http://twitter.com/client");
// - config - email -----------------------------------------------------------

// - config - size image -----------------------------------------------------------
define("header_w",900);
define("header_h",370);
define("image_filesize",500);
// - config - size image -----------------------------------------------------------
define("produk_w",585);
define("produk_h",585);
// - config - galeri foto -----------------------------------------------------------
define("galeri_w_min", 200);
define("galeri_w_max", 200);
define("galeri_h_min", 500);
define("galeri_h_max", 500);
define("galeri_fsize", 512000);
define("thumb_size", 100);
define("gallery_w_thumb_size", 134);
define("gallery_h_thumb_size", 80);
define("beritaw_size", 134);
define("beritah_size", 84);
define("beritathw_size", 87);
define("beritathh_size", 70);
// - config - banner foto -----------------------------------------------------------
// - config - Fasillitas foto -----------------------------------------------------------
define("widhtnya_fasilitas", 150);
define("widhtnya_fasilitas2", 150);
define("height_fasilitas", 70);
// - config - klien -----------------------------------------------------------
define("client",$client);
define("client_email","info@example.com");
define("editor_url", $urlNya.'editor/');
define("site_img_dir", $urlNya.'editor/images/gambar/');
define("site_doc_dir", $urlNya.'editor/images/dokumen/');
define("app_plugin_url", $addLink.'plugins/');
define("app_base_url", $addLink);
// - config - klien -----------------------------------------------------------

define("key_generator","CniP4Ssw0rd");
define("rahasialho","c1712aw381nf0m3d14");
define("client_key", "b0882f6f7540e0670a9f92d1a8af449c");

$global_karakter = Array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9","0");
?>