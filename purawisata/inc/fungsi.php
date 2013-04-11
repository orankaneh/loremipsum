<?php

function removeEvilAttributes($tagSource)
{
       $stripAttrib = "' (style|class)=\"(.*?)\"'i";
       $tagSource = stripslashes($tagSource);
       $tagSource = preg_replace($stripAttrib, '', $tagSource);
       return $tagSource;
}

function removeEvilTags($source)
{
   $allowedTags='<a><br><b><h1><h2><h3><h4><i>' .
             '<img><li><ol><p><strong><table>' .
             '<tr><td><th><u><ul>';
   $source = strip_tags($source, $allowedTags);
   return preg_replace('/<(.*?)>/ie', "'<'.removeEvilAttributes('\\1').'>'", $source);
}

function gantiArray($namaArray,$nilai)
	{
	if(!in_array($nilai,$namaArray))
		{
		if(count($namaArray) == 10 ) array_shift($namaArray);
		array_push($namaArray,$nilai);
		}
	return $namaArray;
	}

function hapusArray($nArray,$no)
	{
	//menghapus awal array array_shift($nama_array);
	//menghapus akhir array array_pop($nama_array);
	$hapusArray_zzz=$nArray;
	$hapusArray=$nArray;
	if($no < count($nArray))
		{
		if($no==0)
			{
			$hapusArray=array_shift($nArray);
			$hapusArray=$nArray;
			}
		if($no==(count($hapusArray_zzz)-1))
			{
			$hapusArray=array_pop($nArray);
			$hapusArray=$nArray;
			}
		if($no > 0 and $no < (count($hapusArray_zzz)-1))
			{
			$temp_hapusArray = array_splice($nArray,$no);  
			$temp_hapusArray2 = array_splice($nArray,0,$no);   
			$temp_hapusArray3 = array_shift($temp_hapusArray);
			$hapusArray=array_merge($temp_hapusArray2,$temp_hapusArray); 
			}
		}
	return $hapusArray;
	}

$AdminEmail = "";
$now = date("Y-m-d H:i:s");


/*
"seconds" - seconds
"minutes" - minutes
"hours" - hours
"mday" - day of the month
"wday" - day of the week as a number
"mon" - month as a number
"year" - year
"yday" - day of the year as a number
"month" - full month name
*/
$selisihJam = 0;
$tanggal_array=getdate(time());

if($tanggal_array["mon"] > 10 or $tanggal_array["mon"] < 4) 
	{
		$selisihJam = 0;
	}
if($tanggal_array["mon"] > 3 and $tanggal_array["mon"] < 11)
	{
	if($tanggal_array["mon"]=4 and $tanggal_array["mday"]< 7) $selisihJam = 12;
	if(!($tanggal_array["mon"]=4 and $tanggal_array["mday"]< 7)) $selisihJam = 11;
  	if($tanggal_array["mon"]=10 and $tanggal_array["mday"]>24) $selisihJam = 12;
  	}

Function selisihJam()
	{
	$tanggal_array=getdate(time());
	if($tanggal_array["mon"]>10 or $tanggal_array["mon"]< 4) $selisihJam = 12;

	if($tanggal_array["mday"]> 3 and $tanggal_array["mon"]< 11)
		{
		if($tanggal_array["mon"]=4 and $tanggal_array["mday"]< 7) $selisihJam = 12;
		if(!($tanggal_array["mon"]=4 and $tanggal_array["mday"]< 7)) $selisihJam = 11;
	  	if($tanggal_array["mon"]=10 and $tanggal_array["mday"]>24) $selisihJam = 12;
	  	}
	$globalWaktuIndonesia="yes";
	if($globalWaktuIndonesia=="yes") $selisihJam=0;
	return $selisihJam;
	}

Function waktuIndonesia()
	{
	$SERVER_TIMEZONE = date("Z"); // zona waktu di server
	$WANTED_TIMEZONE = 7*3600;    // zona waktu yg ingin ditampilkan, GMT+7
	// timestamp yang ingin dikonversi
	$timestamp = time();
	$waktuIndonesia=$timestamp - $SERVER_TIMEZONE + $WANTED_TIMEZONE;
	return $waktuIndonesia;
	}
	
Function waktuIndonesia2()
	{
	$SERVER_TIMEZONE = date("Z"); // zona waktu di server
	$WANTED_TIMEZONE = 7*3600;    // zona waktu yg ingin ditampilkan, GMT+7
	// timestamp yang ingin dikonversi
	$timestamp = time();
	$waktuIndonesia=$timestamp - $SERVER_TIMEZONE + $WANTED_TIMEZONE;
	$waktuIndonesia2=date("Y-m-d H:i:s",$timestamp - $SERVER_TIMEZONE + $WANTED_TIMEZONE);
	return $waktuIndonesia2;
	}

Function cekEmail($fn)
  	{
	  $isEmail=1;
	  if(strpos($fn,".") < 0) $isEmail=0;
	  if(strpos($fn,"@") < 3) $isEmail=0;
	  if(strpos($fn,".") - strpos($fn,"@")==1) $isEmail=0;
	  if(strpos($fn,".",strpos($fn,"@")) - strpos($fn,"@") < 1) $isEmail=0;
	  if(strlen($fn)<6) $isEmail=0;
	  return $isEmail;
	}

Function putusKalimat($xkata,$lebar)
	{
	$kalimat = str_replace("<br>"," ",$xkata);
	$panjang = substr($kalimat,0,$lebar); 	
	if(strlen($kalimat) > $lebar)
		{
		$cari_spasi = strpos($kalimat," ",$lebar);
		$kalimatBaru = substr($kalimat,0,$cari_spasi);
		if($cari_spasi=="") $kalimatBaru = $kalimat;
		}
	if(strlen($kalimat) <= $lebar) $kalimatBaru=$kalimat;
	return $kalimatBaru;
	}
Function dataMasuk($aaa)
	{
	$aaa = str_replace(chr(34),"&quot;",$aaa);
	$aaa = str_replace("'","&#39;",$aaa);
	$aaa = trim(str_replace("<","&lt;",$aaa));
	return $aaa;
	}
function dataKeluar($ps2)
	{
	  $ps2=trim(str_replace("&lt;","<",$ps2));
	  $ps2=str_replace("&gt;",">",$ps2);
	  $ps2=str_replace(chr(34),"&quot;",$ps2);
	  $ps2=str_replace("'","&#39;",$ps2);
	  $ps2=str_replace(vbcrlf,"<br>",$ps2);
	  return $ps2;
	}

function rubahKeUnix($access_date)
	{
	$date_elements =  explode("-" ,$access_date);
	
	// at this point
	// $date_elements[0] = 2000
	// $date_elements[1] = 5
	// $date_elements[2] = 27
	$jam_elements =  explode(":" ,$access_date);
	
	// $jam_elements[0] = 10 jam
	// $jam_elements[1] = 15 menit
	// $jam_elements[2] = 27 detik
	
	if(strlen($jam_elements[1]) > 0)
		{
		$jam_elements[0]=substr($jam_elements[0],strlen($jam_elements[0]) - 2);
		$rubahKeUnix=mktime ($jam_elements[0], $jam_elements[1], $jam_elements[2], $date_elements [1], $date_elements[ 2],$date_elements [0]);
		}
	else
		{
		if($date_elements [0] < 1970) $date_elements [0]=1970;
		$rubahKeUnix=mktime (0, 0,0 ,$date_elements [1], $date_elements[2],$date_elements [0]);
		}
	return $rubahKeUnix;
	}

function cekTanggal($access_date)
	{
	$date_elements =  explode("-" ,$access_date);
	
	// at this point
	// $date_elements[0] = 2000
	// $date_elements[1] = 5
	// $date_elements[2] = 27
	
	$cekTanggal=checkdate($date_elements [1], $date_elements[ 2],$date_elements [0]);
	return $cekTanggal;
	}


function cekTelpon($access_telp)
	{
	$date_elements =  explode("," ,$access_telp);
	$cekTelpon=0;
	for($j=0;$j < count($date_elements);$j++)
		{
		if(!is_numeric($date_elements [$j])) $cekTelpon=$cekTelpon+1;
		}
	return $cekTelpon;
	}

function tampilTelpon($access_telp)
	{
	$access_telp_tampil =  explode(",",$access_telp);
	for($j=0;$j < count($access_telp_tampil);$j++)
		{
		if(strlen($access_telp_tampil[$j]) < 6) $tmpTelpon[$j]=$access_telp_tampil[$j];
		if(strlen($access_telp_tampil[$j])==6) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,3)."-".substr($access_telp_tampil[$j],3);
		if(strlen($access_telp_tampil[$j])==7) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,4)."-".substr($access_telp_tampil[$j],4);
		if(strlen($access_telp_tampil[$j])==8) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,4)."-".substr($access_telp_tampil[$j],4);
		if(strlen($access_telp_tampil[$j])==9) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,3)."-".substr($access_telp_tampil[$j],3,3)."-".substr($access_telp_tampil[$j],6);
		if(strlen($access_telp_tampil[$j])==10) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,4)."-".substr($access_telp_tampil[$j],4,3)."-".substr($access_telp_tampil[$j],7);
		if(strlen($access_telp_tampil[$j])==11) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,4)."-".substr($access_telp_tampil[$j],4,4)."-".substr($access_telp_tampil[$j],8);
		if(strlen($access_telp_tampil[$j])==12) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,4)."-".substr($access_telp_tampil[$j],4,4)."-".substr($access_telp_tampil[$j],9);
		$tampilTelpon=$tampilTelpon.$tmpTelpon[$j].",";	
		}
	$tampilTelpon=substr($tampilTelpon,0,strlen($tampilTelpon) - 1);
	return $tampilTelpon;
	}
/*
untuk interval

yyyy     year
q	Quarter
m	Month
y	Day of year
d	Day
w	Weekday
ww       Week of year
h	Hour
n	Minute
s	Second

*/	
Function DateAdd ($interval,  $number, $date) 
	{

	$date_time_array  = getdate($date);
	    
	$hours =  $date_time_array["hours"];
	$minutes =  $date_time_array["minutes"];
	$seconds =  $date_time_array["seconds"];
	$month =  $date_time_array["mon"];
	$day =  $date_time_array["mday"];
	$year =  $date_time_array["year"];
	
	    switch ($interval) {
	    
	        case "yyyy":
	            $year +=$number;
	            break;        
	        case "q":
	            $year +=($number*3);
	            break;        
	        case "m":
	            $month +=$number;
	            break;        
	        case "y":
	        case "d":
	        case "w":
	             $day+=$number;
	            break;        
	        case "ww":
	             $day+=($number*7);
	            break;        
	        case "h":
	             $hours+=$number;
	            break;        
	        case "n":
	             $minutes+=$number;
	            break;        
	        case "s":
	             $seconds+=$number;
	            break;        
	
	    }    
	$timestamp =  mktime($hours ,$minutes, $seconds,$month ,$day, $year);
	//$timestamp =  $hours."-".$minutes."-".$seconds."-".$month."-".$day."-".$year;
	    return $timestamp;
	}

Function DateAdd2($interval2,  $number2, $dateNya) 
	{

$vTanggal=$dateNya;

	$hours2 =  substr($vTanggal,11,2);
	$minutes2 =  substr($vTanggal,14,2);
	$seconds2 =  substr($vTanggal,17,2);
	$month2 =  substr($vTanggal,5,2);
	$day2 =  substr($vTanggal,8,2);
	$year2 =  substr($vTanggal,0,4);

	
	    switch ($interval2) {
	    
	        case "yyyy":
	            $year2 +=$number2;
	            break;        
	        case "q":
	            $year2 +=($number2*3);
	            break;        
	        case "m":
	            $month2 +=$number2;
	            break;        
	        case "y":
	        case "d":
	        case "w":
	             $day2+=$number2;
	            break;        
	        case "ww":
	             $day2+=($number2*7);
	            break;        
	        case "h":
	             $hours2+=$number2;
	            break;        
	        case "n":
	             $minutes2+=$number2;
	            break;        
	        case "s":
	             $seconds2+=$number2;
	            break;        
	
	    }    
	$timestamp2 =  mktime($hours2 ,$minutes2, $seconds2,$month2 ,$day2, $year2);
	//$timestamp =  $hours."-".$minutes."-".$seconds."-".$month."-".$day."-".$year;
	    return $timestamp2;
	}

Function DateDiff ($interval, $date1,$date2) 
	{

	// get the number of seconds between the two dates
	$timedifference =  $date2 - $date1;
	    
	    switch ($interval) {
	        case "w":
	            $retval  = bcdiv($timedifference ,604800);
	            break;
	        case "d":
	            $retval  = bcdiv( $timedifference,86400);
	            break;
	        case "h":
	             $retval = bcdiv ($timedifference,3600);
	            break;        
	        case "n":
	            $retval  = bcdiv( $timedifference,60);
	            break;        
	        case "s":
	            $retval  = $timedifference;
	            break;        
	
	    }    
	    return $retval;
	    
	}

Function xBulanIndo($xBulanIndo)
	{	
	if($xBulanIndo == 1) $xBulanIndo="Januari";
	if($xBulanIndo == 2) $xBulanIndo="Februari";
	if($xBulanIndo == 3) $xBulanIndo="Maret";
	if($xBulanIndo == 4) $xBulanIndo="April";
	if($xBulanIndo == 5) $xBulanIndo="Mei";
	if($xBulanIndo == 6) $xBulanIndo="Juni";
	if($xBulanIndo == 7) $xBulanIndo="Juli";
	if($xBulanIndo == 8) $xBulanIndo="Agustus";
	if($xBulanIndo == 9) $xBulanIndo="September";
	if($xBulanIndo == 10) $xBulanIndo="Oktober";
	if($xBulanIndo == 11) $xBulanIndo="November";
	if($xBulanIndo == 12) $xBulanIndo="Desember";
	return $xBulanIndo;
	}

Function xBulanIndo2($xBulanIndo)
	{	
	if($xBulanIndo == 1) $xBulanIndo="January";
	if($xBulanIndo == 2) $xBulanIndo="February";
	if($xBulanIndo == 3) $xBulanIndo="March";
	if($xBulanIndo == 4) $xBulanIndo="April";
	if($xBulanIndo == 5) $xBulanIndo="May";
	if($xBulanIndo == 6) $xBulanIndo="June";
	if($xBulanIndo == 7) $xBulanIndo="July";
	if($xBulanIndo == 8) $xBulanIndo="August";
	if($xBulanIndo == 9) $xBulanIndo="September";
	if($xBulanIndo == 10) $xBulanIndo="October";
	if($xBulanIndo == 11) $xBulanIndo="November";
	if($xBulanIndo == 12) $xBulanIndo="December";
	return $xBulanIndo;
	}

Function xHariIndo($xHariIndo)
	{	
	if($xHariIndo == 0) $xHariIndo="Minggu";
	if($xHariIndo == 1) $xHariIndo="Senin";
	if($xHariIndo == 2) $xHariIndo="Selasa";
	if($xHariIndo == 3) $xHariIndo="Rabu";
	if($xHariIndo == 4) $xHariIndo="Kamis";
	if($xHariIndo == 5) $xHariIndo="Jum'at";
	if($xHariIndo == 6) $xHariIndo="Sabtu";
	return $xHariIndo;
	}

Function xHariIndo2($xHariIndo2)
	{	
	if($xHariIndo2 == 0) $xHariIndo2="Sunday";
	if($xHariIndo2 == 1) $xHariIndo2="Monday";
	if($xHariIndo2 == 2) $xHariIndo2="Tuesday";
	if($xHariIndo2 == 3) $xHariIndo2="Wednesday";
	if($xHariIndo2 == 4) $xHariIndo2="Thursday";
	if($xHariIndo2 == 5) $xHariIndo2="Friday";
	if($xHariIndo2 == 6) $xHariIndo2="Saturday";
	return $xHariIndo2;
	}
	
Function utk2Digit($xWaktu)
	{
  	$xWaktu=intval($xWaktu);
  	if($xWaktu < 10) $utk2Digit = "0".$xWaktu ;
  	else $utk2Digit = $xWaktu;
  	return $utk2Digit;
	}

Function utk4Digit($xEmpat)
	{	
	$xEmpatR=$xEmpat;
	if(strlen($xEmpat) == 1) $xEmpatR="000".$xEmpat;
	if(strlen($xEmpat) == 2) $xEmpatR="00".$xEmpat;
	if(strlen($xEmpat) == 3) $xEmpatR="0".$xEmpat;
	return $xEmpatR;
	}

Function utk5Digit($xLima)
	{	
	$xLimaR=$xLima;
	if(strlen($xLima) == 1) $xLimaR="0000".$xLima;
	if(strlen($xLima) == 2) $xLimaR="000".$xLima;
	if(strlen($xLima) == 3) $xLimaR="00".$xLima;
	if(strlen($xLima) == 4) $xLimaR="0".$xLima;
	return $xLimaR;
	}

Function utkDigit($xDua,$jmlDigit)
	{
  	$utkDigit=str_pad($xDua, $jmlDigit, "0", STR_PAD_LEFT);
  	return $utkDigit;
	}

Function voucher10Digit($xSepuluh)
	{	
	if(strlen($xSepuluh) == 1) $xSepuluh="000000000".$xSepuluh;
	if(strlen($xSepuluh) == 2) $xSepuluh="00000000".$xSepuluh;
	if(strlen($xSepuluh) == 3) $xSepuluh="0000000".$xSepuluh;
	if(strlen($xSepuluh) == 4) $xSepuluh="000000".$xSepuluh;
	if(strlen($xSepuluh) == 5) $xSepuluh="00000".$xSepuluh;
	if(strlen($xSepuluh) == 6) $xSepuluh="0000".$xSepuluh;
	if(strlen($xSepuluh) == 7) $xSepuluh="000".$xSepuluh;
	if(strlen($xSepuluh) == 8) $xSepuluh="00".$xSepuluh;
	if(strlen($xSepuluh) == 9) $xSepuluh="0".$xSepuluh;
	return $xSepuluh;
	}

Function HariIni($date) 
	{
	$date_time_array  = getdate(DateAdd("h",selisihJam(),$date));   
	$weekday =  xHariIndo($date_time_array["wday"]);	    
	$month =  xBulanIndo($date_time_array["mon"]);
	$day =  $date_time_array["mday"];
	$year =  $date_time_array["year"];
	$xHariIni=$weekday.", ".$day." ".$month." ".$year;
	return $xHariIni;
	}

Function tahunBulan($date) 
	{

	$date_time_array  = getdate($date);   
	$month =  $date_time_array["mon"];
	if(strlen($month) < 2) $month="0".$month;
	$year =  substr($date_time_array["year"],2);
	$tahunBulan=$year.$month;
	return $tahunBulan;
	}

Function tahunNya($date) 
	{

	$date_time_array  = getdate($date);   
	$year =  $date_time_array["year"];
	$tahunNya=$year;
	return $tahunNya;
	}

Function bulanNya($date) 
	{

	$date_time_array  = getdate($date);   
	$month =  $date_time_array["month"];
	if($month=1) $month="I";
	if($month=1) $month="II";
	if($month=1) $month="III";
	if($month=1) $month="IV";
	if($month=1) $month="V";
	if($month=1) $month="VI";
	if($month=1) $month="VII";
	if($month=1) $month="VIII";
	if($month=1) $month="IX";
	if($month=1) $month="X";
	if($month=1) $month="XI";
	if($month=1) $month="XII";
	$bulanNya=$month;
	return $bulanNya;
	}

Function tglIndo()
	{
	//argumen asli ($xTgl,$formatNya,$selisihJam)
	//argumen tambahan $sisaTanggal
	$objArgs = func_get_args();
	$nCount = count($objArgs);
	$xTgl=$objArgs[0];
	if(strpos($xTgl,"-") > 0) $xTgl=rubahKeUnix($xTgl);
	$formatNya=$objArgs[1];
	$selisihJam=$objArgs[2];
	$sisaTanggal=0;
	if($nCount > 3)
		{
		$sisaTanggal=$objArgs[3];
		}
   	$xTgl = getdate(DateAdd("h",$selisihJam,$xTgl));
	//l = long Date (Selasa, 1 Januari 2002, 03:00 WIB)
	//h = long Date (Selasa, 1 Januari 2002, 03:00 WIB)
	//s = short Date (1 Januari 2002)
	//t = time (03:00 WIB)
	//f = (7/22/2003 9:50:37 PM)
	  if($formatNya == "l") 
	  	{
	    	$TglIndo = xHariIndo($xTgl["wday"]).", ".$xTgl["mday"]." ".xBulanIndo($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal).", ".utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"])." WIB";
		}
	  elseif($formatNya == "l_e") 
	  	{
	    	$TglIndo = $xTgl["weekday"].", ".$xTgl["month"]." ".$xTgl["mday"].", ".($xTgl["year"] - $sisaTanggal)." - ".utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"])." WIT (GMT + 7)";
		}
	  elseif($formatNya == "h") 
	  	{
	    	$TglIndo = xHariIndo($xTgl["wday"]).", ".$xTgl["mday"]." ".xBulanIndo($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal);
		}
	 elseif($formatNya == "f") 
	  	{
	    	$TglIndo =$xTgl["mday"]."/".$xTgl["mon"]."/".($xTgl["year"] - $sisaTanggal).", ".utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"])." WIB";
		}
	 elseif($formatNya == "s")
	  	{
	    	$TglIndo = $xTgl["mday"]." ".xBulanIndo($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal);
		}
	 elseif($formatNya == "jawa")
	  	{
	    	$TglIndo = xHariIndo($xTgl["wday"])." ".weton($objArgs[0]).", ".$xTgl["mday"]." ".xBulanIndo($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal);
		}
	 elseif($formatNya == "s_e")
	  	{
	    	$TglIndo = $xTgl["mday"]." ".xBulanIndo2($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal);
		}		
	 elseif($formatNya == "t")
	  	{
	    	$TglIndo = utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"])." WIB";
		}
	 elseif($formatNya == "z")
	  	{
	    	$TglIndo = $xTgl["mday"]." ".xBulanIndo($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal).", ".utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"]).":".utk2Digit($xTgl["seconds"])." WIB";
		}
	elseif($formatNya == "z_e") 
	  	{
	    	$TglIndo = $xTgl["mday"]." ".$xTgl["month"]." ".($xTgl["year"] - $sisaTanggal)." - ".utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"]).":".utk2Digit($xTgl["seconds"])." WIT (GMT + 7)";
		}
		return $TglIndo;	  
	}
	
function MakeTime()
{
   $objArgs = func_get_args();
   $nCount = count($objArgs);
   if ($nCount < 7)
   {
       $objDate = getdate();
       if ($nCount < 1)
           $objArgs[] = $objDate["hours"];
       if ($nCount < 2)
           $objArgs[] = $objDate["minutes"];
       if ($nCount < 3)
         $objArgs[] = $objDate["seconds"];
       if ($nCount < 4)
           $objArgs[] = $objDate["mon"];
       if ($nCount < 5)
           $objArgs[] = $objDate["mday"];
       if ($nCount < 6)
          $objArgs[] = $objDate["year"];
       if ($nCount < 7)
           $objArgs[] = -1;
   }
   $nYear = $objArgs[5];
   $nOffset = 0;
   if ($nYear < 1970)
  {
       if ($nYear < 1902)
           return 0;
      else if ($nYear < 1952)
       {
           $nOffset = -2650838400;
           $objArgs[5] += 84;
           // Apparently dates before 1942 were never DST
           if ($nYear < 1942)
               $objArgs[6] = 0;
       }
       else
      {
           $nOffset = -883612800;
           $objArgs[5] += 28;
       }
   }
   
   return call_user_func_array("mktime", $objArgs) + $nOffset;
}


Function bikinThumbnail($gaFile,$gDir,$gSize)
	{
	    
	   global $accNya;
	    if (!isset($img)) 
	    { 
	        $img = $gaFile; 
	    } 
	    $imgdir = $gDir; 
		
	    $tndir = $gDir."tn/"; 
		
	    $tn_w = $gSize; 
	    if (!file_exists($imgdir.$img)) 
	    { 
	        echo $imgdir.$img;
	        die ("Error: File not found..."); 
	    } 
	
	    $ext = explode('.', $img);  
	    $ext = $ext[count($ext)-1];  
	    if (strtolower($ext) != "jpg") 
	    { 
	        die ("Error: File must be JPEG"); 
	    } 
	
	    $src_img = ImageCreateFromJPEG($imgdir.$img); 
	
	    $org_h = imagesy($src_img); 
	    $org_w = imagesx($src_img); 
	
	    $tn_h = floor($tn_w * $org_h / $org_w); 
	    
	    //digunakan untuk membuat standar tinggi / lebar max sesuai dengan lebar
	   if($org_h > $org_w)
	    	{
	    	$temp_tn_w=$tn_h;
	    	$tn_h=$tn_w;
	    	$tn_w=floor($tn_h * $org_w / $org_h); 
	    	}
	    
	    //gunakan imagecreate bila gd ver. 1 atau ImageCreateTrueColor bila gd ver. 2
	    //if($accNya == "lokal") $dst_img = ImageCreate($tn_w,$tn_h); 
	    $dst_img = ImageCreateTrueColor($tn_w,$tn_h); 
	
	    ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $tn_w, $tn_h, $org_w, $org_h);  
	
	    ImageJPEG($dst_img, $tndir.$img);  
		
	    $gambar=printf ("<a href=\"%s\"><img src=\"%s\" alt=\"Click to view the original image\" border=0></a>", $imgdir.$img, $tndir.$img); 
	    //$kkk="width=".$tn_w." height=".$tn_h;
	    return $gambar;	
	}

Function bikinThumbnail2($gaFile,$gDir,$gSize,$gPath)
	{
	    global $accNya;
	
	    if (!isset($img)) 
	    { 
	        $img = $gaFile; 
	    } 
	    $imgdir = $gDir; 
		
	    $tndir = $gPath; 
		
	    $tn_w = $gSize; 
	    if (!file_exists($imgdir.$img)) 
	    { 
	        echo $imgdir.$img;
	        die ("Error: File not found..."); 
	    } 
	
	    $ext = explode('.', $img);  
	    $ext = $ext[count($ext)-1];  
	    if (strtolower($ext) != "jpg") 
	    { 
	        die ("Error: File must be JPEG"); 
	    } 
	
	    $src_img = ImageCreateFromJPEG($imgdir.$img); 
	
	    $org_h = imagesy($src_img); 
	    $org_w = imagesx($src_img); 
	
	    $tn_h = floor($tn_w * $org_h / $org_w); 
	   
	   //digunakan untuk membuat standar tinggi / lebar max sesuai dengan lebar
	   if($org_h > $org_w)
	    	{
	    	$temp_tn_w=$tn_h;
	    	$tn_h=$tn_w;
	    	$tn_w=floor($tn_h * $org_w / $org_h); 
	    	}
	    
	    //gunakan imagecreate bila gd ver. 1 atau ImageCreateTrueColor bila gd ver. 2
	    //if($accNya == "lokal") $dst_img = ImageCreate($tn_w,$tn_h); 
	    $dst_img = ImageCreateTrueColor($tn_w,$tn_h); 
	
	    ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $tn_w, $tn_h, $org_w, $org_h);  
	
	    ImageJPEG($dst_img, $tndir.$img);  
		
	    //$gambar=printf ("<a href=\"%s\"><img src=\"%s\" alt=\"Click to view the original image\" border=0></a>", $imgdir.$img, $tndir.$img); 
	    //$kkk="width=".$tn_w." height=".$tn_h;
	    return $gambar;	
	}

Function bikinThumbnail3($gaFile,$gDir,$gSizeW,$gSizeH,$gPath)
	{
	    global $accNya;
	
	    if (!isset($img)) 
	    { 
	        $img = $gaFile; 
	    } 
	    $imgdir = $gDir; 
		
	    $tndir = $gPath; 
		
	    $tn_w = $gSizeW;
		$tn_h = $gSizeH;
	    if (!file_exists($imgdir.$img)) 
	    { 
	        echo $imgdir.$img;
	        die ("Error: File not found..."); 
	    } 
	
	    $ext = explode('.', $img);  
	    $ext = $ext[count($ext)-1];  
	    if (strtolower($ext) != "jpg") 
	    { 
	        die ("Error: File must be JPEG"); 
	    } 
	
	    $src_img = ImageCreateFromJPEG($imgdir.$img); 
	
	    $org_h = imagesy($src_img); 
	    $org_w = imagesx($src_img); 
	
	    /*
		$tn_h = floor($tn_w * $org_h / $org_w); 
	   
		   //digunakan untuk membuat standar tinggi / lebar max sesuai dengan lebar
		   if($org_h > $org_w)
		    	{
		    	$temp_tn_w=$tn_h;
		    	$tn_h=$tn_w;
		    	$tn_w=floor($tn_h * $org_w / $org_h); 
		    	}
		   */ 
	    //gunakan imagecreate bila gd ver. 1 atau ImageCreateTrueColor bila gd ver. 2
	    //if($accNya == "lokal") $dst_img = ImageCreate($tn_w,$tn_h); 
	    $dst_img = ImageCreateTrueColor($tn_w,$tn_h); 
	
	    ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $tn_w, $tn_h, $org_w, $org_h);  
	
	    ImageJPEG($dst_img, $tndir.$img);  
		
	    //$gambar=printf ("<a href=\"%s\"><img src=\"%s\" alt=\"Click to view the original image\" border=0></a>", $imgdir.$img, $tndir.$img); 
	    //$kkk="width=".$tn_w." height=".$tn_h;
	    return $gambar;	
	}
	
function createThumb($source,$ukuran,$dest) {

	$thumb_size = $ukuran;

	$size = getimagesize($source);
	$width = $size[0];
	$height = $size[1];

	if($width > $height) {
		$x = ceil(($width - $height) / 2 );
		$width = $height;
	} elseif($height > $width) {
		$y = ceil(($height - $width) / 2);
		$height = $width;
	}

	$new_im = ImageCreatetruecolor($thumb_size,$thumb_size);
	$im = imagecreatefromjpeg($source);
	imagecopyresampled($new_im,$im,0,0,$x,$y,$thumb_size,$thumb_size,$width,$height);
	imagejpeg($new_im,$dest,100);

}
	
function namaFileNya($aaa)
	{
	$f = strrev($aaa);
	$ext = substr($f, 0, strpos($f,"/"));
	$fileNya = strrev($ext);
	return $fileNya;
	}

Function blokKata($kataBlok,$kalimatBlok)
	{
	$kataBlok= str_replace(chr(34),"",$kataBlok);  
	$kataBlok= explode(" ",trim($kataBlok));  
	
	for($a=0; $a < count($kataBlok);$a++)
		{
		if(strlen($kataBlok[$a]) > 1)
			{
			$posisiKata=strpos(strtoupper($kalimatBlok),strtoupper($kataBlok[$a]));
			if(is_numeric($posisiKata))
				{
				$kata_yg_di_Blok=substr($kalimatBlok,$posisiKata,strlen($kataBlok[$a]));
				$kalimatBlok=str_replace($kata_yg_di_Blok,"<b>$kata_yg_di_Blok</b>",$kalimatBlok);   
				}
			}
		}
	return $kalimatBlok;
	}
Function tengahKata($kataCari,$tengahKata)
	{
	if(strlen($tengahKata) < 200)
			{
			$tengahKata=substr($tengahKata,0,strlen($tengahKata))." ...";
			}
	if(strlen($tengahKata) > 200)
			{
			$xNya=strpos(strtoupper($tengahKata),strtoupper($kataCari));	
			
			if($xNya < 100)
				{
				$cari_spasi_akhir = strpos($tengahKata," ",$xNya + 100);
				$tengahKata=substr($tengahKata,0,$cari_spasi_akhir)." ...";
				}
			if($xNya > 100)
				{
				$cari_spasi_awal = strpos($tengahKata," ",$xNya - 100);
				$zNya = ($xNya - 100)- $cari_spasi_awal;
				if((strlen($tengahKata)- $xNya) > 100)
					{
					$cari_spasi_akhir = strpos($tengahKata," ",$xNya + 100)+ $zNya;				
					$jmlKataSemua=$cari_spasi_akhir - $cari_spasi_awal;
					}
				if((strlen($tengahKata)- $xNya) <= 100)
					{
					$jmlKataSemua=strlen($tengahKata) - $cari_spasi_awal;
					}
				$tengahKata="... ".substr($tengahKata,$cari_spasi_awal,$jmlKataSemua+2)." ...";
				}
			}
	return	$tengahKata;	
	}


function kotakError($pesanNya) {
	$ui = "";
	$ui.= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"90%\" align=\"center\">";
	$ui.= "<tr><td align=\"left\" valign=\"middle\">";
	$ui.= "<div class=\"kotak_error\">".$pesanNya."</div>";
	$ui.= "</td></tr></table>";
	return $ui;
}

Function kotakInfo($pesanNya) {
	$ui = "";
	$ui.= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
	$ui.= "<tr><td align=\"left\" class=\"kotak_info\" valign=\"top\">";
	$ui.= $pesanNya;
	$ui.= "</td></tr></table><br>";
	return $ui;
}

Function jmlPengunjungTotal()
	{
	$tbMulai="tb200308";
	$thMulai="2003";
	$blMulai="8";
	$mulai = mktime(0,0,0,8,1,2003);
	$se = mktime(0,0,0,date("m"),1,date("Y"));
	$jmlTB=intval(DateDiff("d",$mulai,$se)/30);        
	$jmlJPT=0;
	$jmlLoop=$blMulai+$jmlTB+1;
	for($i=$blMulai;$i < $jmlLoop;$i++)
		{
		$sqlJPT = "select * from tb".$thMulai.utk2Digit($blMulai);
		//echo $sqlJPT."<br>";
		$goJPT = mysql_query($sqlJPT);
		while($rs_JPT= mysql_fetch_array($goJPT)) {
			$jmlJPT=$jmlJPT+1;
			}
		$thMulai="2003";
		$blMulai=$blMulai+1;
		if($blMulai==12)
			{
			$blMulai=1;
			$thMulai=$thMulai+1;
			}
		}
	return $jmlJPT;
	}

Function jmlPengunjungTotal2()
	{
	$tbMulai="tb200308";
	$jmlJPT=0;
		$sqlJPT = "select * from ".$tbMulai;
		//echo $sqlJPT."<br>";
		$goJPT = mysql_query($sqlJPT);
		while($rs_JPT= mysql_fetch_array($goJPT)) {
			$jmlJPT=$jmlJPT+1;
			}
	return $jmlJPT;
	}

Function jmlPengunjungHari()
	{
	$tbMulai="tb".date("Y").date("m");
	$hariNya=date("d-m-Y");
	$sqlJPH = "select * from ".$tbMulai." where tanggal='".$hariNya."'";
	$goJPH = mysql_query($sqlJPH);
	$jmlJPH=0;
	while($rs_JPH= mysql_fetch_array($goJPH)) {
		$jmlJPH=$jmlJPH+1;
		}
	return $jmlJPH;
	}

function formatAngka($arg)
	{
	$objArgs = func_get_args();
	$nCount = count($objArgs);
	$formatAngka=number_format($objArgs[0],0,',','.');
	if($nCount==2) 
		{
		$formatAngka=number_format($objArgs[0],$objArgs[1],',','.');
		if(substr($formatAngka,-3)=='000') $formatAngka=number_format($objArgs[0],0,',','.');
		}
	return $formatAngka;
	}


/*
How to use:
$key = "PaSsWoRd";
$toencrypt = "Encrypt me!";
$crypt = new MD5Crypt;
$en $crypt->Encrypt($toencrypt,$key);
//encrypts but if i show you output, and you do the same exact words its probally going to be 

differnt.
$de = $crypt->Decrypt($en,$key);
makes the value of $toencrypt

If you need any help with this just email me @ axilant07@yahoo.com or im me on AIM @ axilant
*/

class MD5Crypt{

		function keyED($txt,$encrypt_key)
		{
				$encrypt_key = md5($encrypt_key);
				$ctr=0;
				$tmp = "";
				for ($i=0;$i<strlen($txt);$i++){
						if ($ctr==strlen($encrypt_key)) $ctr=0;
						$tmp.= substr($txt,$i,1) ^ 

substr($encrypt_key,$ctr,1);
						$ctr++;
				}
				return $tmp;
		}

		function Encrypt($txt,$key)
		{
				srand((double)microtime()*1000000);
				$encrypt_key = md5(rand(0,32000));
				$ctr=0;
				$tmp = "";
				for ($i=0;$i<strlen($txt);$i++)
				{
				if ($ctr==strlen($encrypt_key)) $ctr=0;
				$tmp.= substr($encrypt_key,$ctr,1) .
				(substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1));
				$ctr++;
				}
				return base64_encode($this->keyED($tmp,$key));
		}

		function Decrypt($txt,$key)
		{
				$txt = $this->keyED(base64_decode($txt),$key);
				$tmp = "";
				for ($i=0;$i<strlen($txt);$i++){
						$md5 = substr($txt,$i,1);
						$i++;
						$tmp.= (substr($txt,$i,1) ^ $md5);
				}
				return $tmp;
		}

		function RandPass()
		{
				$randomPassword = "";
				srand((double)microtime()*1000000);
				for($i=0;$i<8;$i++)
				{
						$randnumber = rand(48,120);

						while (($randnumber >= 58 && $randnumber <= 64) 

|| ($randnumber >= 91 && $randnumber <= 96))
						{
								$randnumber = rand(48,120);
						}

						$randomPassword .= chr($randnumber);
				}
				return $randomPassword;
		}

}

function cek_karakter($text) {
	global $global_karakter;
 for ($i = 0; $i < strlen($text); $i++) {
   if (!in_array($text[$i],$global_karakter)) return false;
 }
 return true;
}

function cek_only_karakter($text) {
	global $global_only_karakter;
 for ($i = 0; $i < strlen($text); $i++) {
   if (!in_array($text[$i],$global_only_karakter)) return false;
 }
 return true;
}

function header_kotak($argJudul)
	{
	echo '
		<!--kotak mulai-->
		<table border="0" cellspacing="0" cellpadding="0" width="498">
			<tr>
				<td align="left" valign="top" width="498" height="38" class="bg_kontenatas">
				<table border="0" cellspacing="0" cellpadding="0" width="498">
					<tr>
						<td align="left" valign="middle" width="498" height="38"><span class="judul_hitam">&nbsp;&nbsp;<b>'.$argJudul.'</b></span></td>
					</tr>
				</table>					
				</td>
			</tr>
		</table>		
		<table border="0" cellspacing="0" cellpadding="0" width="498">
			<tr>
				<td align="left" valign="top" width="498" height="38" class="bg_kontentengah">';
	}

function footer_kotak()
	{
	echo '
				</td>
			</tr>
		</table>
		
		<table border="0" cellspacing="0" cellpadding="0" width="498">
			<tr><td align="left" valign="top" width="498" height="17" class="bg_kontenbawah">&nbsp;</td></tr>
		</table>
		<!--kotak selesai-->';
	}

function tempToCelsius ($fTemp, $prec=0)
	{
	  if (!isset($fTemp)) {
	    return false;
	  }
	  $prec = (integer)$prec;
	  $cTemp = (float)(($fTemp - 32) / 1.8 );
	  return round($cTemp, $prec);
	}

function tempToFahrenheit($cTemp, $prec=0)
	{
	  if (!isset($cTemp)) {
	    return false;
	  }
	  $prec = (integer)$prec;
	  $fTemp = (float)(1.8 * $cTemp) + 32;
	  return round($fTemp, $prec);
	}
	
function ambilFileGambar($strFile)
	{	
	$kataPatokan="images/upload/";
	$posAwal=strpos($strFile,$kataPatokan)+strlen($kataPatokan);
	if($posAwal > 15)
		{
		$posAkhir=strpos($strFile,".",$posAwal)+5;
		$ambilFileGambar=substr($strFile,$posAwal,($posAkhir - $posAwal));
		}
	$ambilFileGambar=str_replace('"',"",$ambilFileGambar);
	return $ambilFileGambar;
	}

function func_buatFolder($dir) 
	{
	if (!file_exists ($dir)) 
		{
		if (@mkdir ($dir, TIPE_CHMOD)) 
			{
			return true;
			} 
		else 
			{
			return false;
			}
		} 
		else 
		{
			return false;
		}
	}

function func_copyFolder($oldname, $newname) 
	{
	if (!is_dir($newname)) 
		{
		mkdir($newname, TIPE_CHMOD);
		chmod($newname, TIPE_CHMOD);
		}
	$dir = opendir($oldname);
	while($file = readdir($dir)){
		if ($file == "." || $file == "..") 
			{
			continue;
			}
		func_copyFolder("$oldname/$file", "$newname/$file");
		}
	closedir($dir);
	}


function func_tampilGambar($namafile) 
	{
	if (file_exists($namafile)) 
		{
		$ukuran2 = GetImageSize($namafile);
		if(strtolower(substr(trim($namafile),-4))==".swf")
			{
			echo '
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="'.$ukuran2[0].'" height="'.$ukuran2[1].'" id="final-upload12" align="middle">
				<param name="allowScriptAccess" value="sameDomain" />
				<param name="movie" value="'.$namafile.'" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#ffffff" />
				<embed src="'.$namafile.'" quality="high" bgcolor="#000000" width="'.$ukuran2[0].'" height="'.$ukuran2[1].'" name="hkjhkjhkds" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
				</object>';
			}
		else
			{
				echo '<img src="'.$namafile.'" width="'.$ukuran2[0].'" height="'.$ukuran2[1].'" border="0">';
			}
		}
	}


// Fungsi-fungsi untuk kalender jawe mulai
Function namaWindu($namaWindu)
	{	
	if($namaWindu == 0) $namaWindu="Adi";
	if($namaWindu == 1) $namaWindu="Kuntara";
	if($namaWindu == 2) $namaWindu="Sengara";
	if($namaWindu == 3) $namaWindu="Sancaya";
	return $namaWindu;
	}

Function tahunCandra($tahunCandra)
	{	
	if($tahunCandra == 1) $tahunCandra="Alip";
	if($tahunCandra == 2) $tahunCandra="Ehe";
	if($tahunCandra == 3) $tahunCandra="Jimawal";
	if($tahunCandra == 4) $tahunCandra="Je";
	if($tahunCandra == 5) $tahunCandra="Dal";
	if($tahunCandra == 6) $tahunCandra="Be";
	if($tahunCandra == 7) $tahunCandra="Wawu";
	if($tahunCandra == 8) $tahunCandra="Jimakir";
	return $tahunCandra;
	}

Function jumlahHariTahunCandra($tahunCandra)
	{	
	$jumlahHariTahunCandra=354;
	if($tahunCandra == 2 || $tahunCandra == 4 || $tahunCandra == 8) $jumlahHariTahunCandra=355;
	return $jumlahHariTahunCandra;
	}

Function jumlahHariBulanJawa($bulan,$tahunCandra)
	{	
	if($bulan == 1) $jumlahHariBulanJawa=30;
	if($bulan == 2) $jumlahHariBulanJawa=29;
	if($bulan == 2 AND $tahunCandra== 5) $jumlahHariBulanJawa=30;
	if($bulan == 3) $jumlahHariBulanJawa=30;
	if($bulan == 4) $jumlahHariBulanJawa=29;
	if($bulan == 5) $jumlahHariBulanJawa=30;
	if($bulan == 5 AND $tahunCandra== 5) $jumlahHariBulanJawa=29;
	if($bulan == 6) $jumlahHariBulanJawa=29;
	if($bulan == 7) $jumlahHariBulanJawa=30;
	if($bulan == 8) $jumlahHariBulanJawa=29;
	if($bulan == 9) $jumlahHariBulanJawa=30;
	if($bulan == 10) $jumlahHariBulanJawa=29;
	if($bulan == 11) $jumlahHariBulanJawa=30;
	if($bulan == 12) $jumlahHariBulanJawa=29;
	return $jumlahHariBulanJawa;
	}

Function xBulanJawa($xBulanJawa)
	{	
	if($xBulanJawa == 1) $xBulanJawa="Sura";
	if($xBulanJawa == 2) $xBulanJawa="Sapar";
	if($xBulanJawa == 3) $xBulanJawa="Mulud";
	if($xBulanJawa == 4) $xBulanJawa="Bakdamulud";
	if($xBulanJawa == 5) $xBulanJawa="Jumadilawal";
	if($xBulanJawa == 6) $xBulanJawa="Jumadilakir";
	if($xBulanJawa == 7) $xBulanJawa="Rejeb";
	if($xBulanJawa == 8) $xBulanJawa="Ruwah";
	if($xBulanJawa == 9) $xBulanJawa="Pasa";
	if($xBulanJawa == 10) $xBulanJawa="Sawal";
	if($xBulanJawa == 11) $xBulanJawa="Dulkangidah";
	if($xBulanJawa == 12) $xBulanJawa="Besar";
	return $xBulanJawa;
	}
	
function weton($strTgl)
	{
	$jowo[0]="Kliwon";
	$jowo[1]="Legi";
	$jowo[2]="Pahing";
	$jowo[3]="Pon";
	$jowo[4]="Wage";	
	$patokan=rubahKeUnix("1976-05-24");
	$patokan2=rubahKeUnix($strTgl);	
	$beda=DateDiff("d",$patokan,$patokan2);
	if($beda < 0) $beda=$beda* -4;
	elseif($beda==0) $beda = 5;
	$weton = $jowo[(($beda - 1) % 5)];
	return $weton;
	}


Function weton2($strTgl)
	{
	//format YYYY-MM-DD
	$arr_Tgl=explode("-",$strTgl);
	
	if(intval($arr_Tgl[1]) == 1) $pengurang=4;
	if(intval($arr_Tgl[1]) == 1 && ($arr_Tgl[0] % 4) == 0) $pengurang=5;
	if(intval($arr_Tgl[1]) == 2) $pengurang=4;
	if(intval($arr_Tgl[1]) == 2 && ($arr_Tgl[0] % 4) == 0) $pengurang=5;
	
	if(substr($arr_Tgl[0],-2)=="00")
		{
		if(intval($arr_Tgl[1]) == 1) $pengurang=4;
		if(intval($arr_Tgl[1]) == 1 && ($arr_Tgl[0] % 400) == 0) $pengurang=5;
		if(intval($arr_Tgl[1]) == 2) $pengurang=4;
		if(intval($arr_Tgl[1]) == 2 && ($arr_Tgl[0] % 400) == 0) $pengurang=5;
		}
		
	if(intval($arr_Tgl[1]) == 3) $pengurang=2;
	if(intval($arr_Tgl[1]) == 4) $pengurang=2;
	if(intval($arr_Tgl[1]) == 5) $pengurang=3;
	if(intval($arr_Tgl[1]) == 6) $pengurang=3;
	if(intval($arr_Tgl[1]) == 7) $pengurang=4;
	if(intval($arr_Tgl[1]) == 8) $pengurang=4;
	if(intval($arr_Tgl[1]) == 9) $pengurang=4;
	if(intval($arr_Tgl[1]) == 10) $pengurang=5;
	if(intval($arr_Tgl[1]) == 11) $pengurang=5;
	if(intval($arr_Tgl[1]) == 12) $pengurang=1;	
	$hasil=intval(intval(substr($arr_Tgl[0],-2)) / 4) + intval($arr_Tgl[1]) + intval($arr_Tgl[2]) - $pengurang;
	echo $hasil." % 5 = ".($hasil % 5)."<br>";
	$hasil = $hasil % 5;
	echo intval(intval(substr($arr_Tgl[0],-2)) / 4)." + ".intval($arr_Tgl[1])." + ".intval($arr_Tgl[2])." - ".$pengurang."<br>";
	echo $hasil."<br>";
	if($hasil < 0 ) $hasil=5 + $hasil;
	if(intval($arr_Tgl[0]) >= 1500 && intval($arr_Tgl[0]) <= 1699)
		{
		if($hasil==1) $weton2="Pahing";
		if($hasil==2) $weton2="Pon";
		if($hasil==3) $weton2="Wage";
		if($hasil==4) $weton2="Kliwon";
		if($hasil==5 || $hasil==0) $weton2="Legi";		
		}
	elseif(intval($arr_Tgl[0]) >= 1700 && intval($arr_Tgl[0]) <= 1899)
		{
		if($hasil==1) $weton2="Legi";
		if($hasil==2) $weton2="Pahing";
		if($hasil==3) $weton2="Pon";
		if($hasil==4) $weton2="Wage";
		if($hasil==5 || $hasil==0) $weton2="Kliwon";
		}
	elseif(intval($arr_Tgl[0]) >= 1900 && intval($arr_Tgl[0]) <= 2099)
		{
		if($hasil==1) $weton2="Kliwon";
		if($hasil==2) $weton2="Legi";
		if($hasil==3) $weton2="Pahing";
		if($hasil==4) $weton2="Pon";
		if($hasil==5 || $hasil==0) $weton2="Wage";
		}
	return $weton2;
	}

Function func_hari($strTgl)
	{
	//format YYYY-MM-DD
	$arr_Tgl=explode("-",$strTgl);
	
	if(intval($arr_Tgl[1]) == 1) $pengurang=2;
	if(intval($arr_Tgl[1]) == 1 && ($arr_Tgl[0] % 4) == 0) $pengurang=3;
	if(intval($arr_Tgl[1]) == 2) $pengurang=7;
	if(intval($arr_Tgl[1]) == 2 && ($arr_Tgl[0] % 4) == 0) $pengurang=1;
	
	if(substr($arr_Tgl[0],-2)=="00")
		{
		if(intval($arr_Tgl[1]) == 1) $pengurang=2;
		if(intval($arr_Tgl[1]) == 1 && ($arr_Tgl[0] % 400) == 0) $pengurang=3;
		if(intval($arr_Tgl[1]) == 2) $pengurang=7;
		if(intval($arr_Tgl[1]) == 2 && ($arr_Tgl[0] % 400) == 0) $pengurang=1;
		}
		
	if(intval($arr_Tgl[1]) == 3) $pengurang=1;
	if(intval($arr_Tgl[1]) == 4) $pengurang=6;
	if(intval($arr_Tgl[1]) == 5) $pengurang=5;
	if(intval($arr_Tgl[1]) == 6) $pengurang=3;
	if(intval($arr_Tgl[1]) == 7) $pengurang=2;
	if(intval($arr_Tgl[1]) == 8) $pengurang=7;
	if(intval($arr_Tgl[1]) == 9) $pengurang=5;
	if(intval($arr_Tgl[1]) == 10) $pengurang=4;
	if(intval($arr_Tgl[1]) == 11) $pengurang=2;
	if(intval($arr_Tgl[1]) == 12) $pengurang=1;	
	$hasil=intval(substr($arr_Tgl[0],-2)) + intval(intval(substr($arr_Tgl[0],-2)) / 4) + intval($arr_Tgl[1]) + intval($arr_Tgl[2]) - $pengurang;
	echo $hasil." % 7 = ".($hasil % 7)."<br>";
	$hasil = $hasil % 7;
	echo intval(substr($arr_Tgl[0],-2))." + ".intval(intval(substr($arr_Tgl[0],-2)) / 4)." + ".intval($arr_Tgl[1])." + ".intval($arr_Tgl[2])." - ".$pengurang."<br>";
	echo $hasil."<br>";
	if($hasil < 0 ) $hasil=7 + $hasil;
	if((intval($arr_Tgl[0]) >= 1500 && intval($arr_Tgl[0]) <= 1599) or (intval($arr_Tgl[0]) >= 2000 && intval($arr_Tgl[0]) <= 2099))
		{
		if($hasil==1 || $hasil==0) $func_hari="Senin";
		if($hasil==2) $func_hari="Selasa";
		if($hasil==3) $func_hari="Rabu";
		if($hasil==4) $func_hari="Kamis";
		if($hasil==5) $func_hari="Jumat";
		if($hasil==6) $func_hari="Sabtu";
		if($hasil==7) $func_hari="Minggu";		
		}
	elseif(intval($arr_Tgl[0]) >= 1600 && intval($arr_Tgl[0]) <= 1699)
		{
		if($hasil==1 || $hasil==0) $func_hari="Minggu";
		if($hasil==2) $func_hari="Senin";
		if($hasil==3) $func_hari="Selasa";
		if($hasil==4) $func_hari="Rabu";
		if($hasil==5) $func_hari="Kamis";
		if($hasil==6) $func_hari="Jumat";
		if($hasil==7) $func_hari="Sabtu";	
		}
	elseif(intval($arr_Tgl[0]) >= 1700 && intval($arr_Tgl[0]) <= 1799)
		{
		if($hasil==1 || $hasil==0) $func_hari="Jumat";
		if($hasil==2) $func_hari="Sabtu";
		if($hasil==3) $func_hari="Minggu";
		if($hasil==4) $func_hari="Senin";
		if($hasil==5) $func_hari="Selasa";
		if($hasil==6) $func_hari="Rabu";
		if($hasil==7) $func_hari="Kamis";	
		}
	elseif(intval($arr_Tgl[0]) >= 1800 && intval($arr_Tgl[0]) <= 1899)
		{
		if($hasil==1 || $hasil==0) $func_hari="Kamis";
		if($hasil==2) $func_hari="Jumat";
		if($hasil==3) $func_hari="Sabtu";
		if($hasil==4) $func_hari="Minggu";
		if($hasil==5) $func_hari="Senin";
		if($hasil==6) $func_hari="Selasa";
		if($hasil==7) $func_hari="Rabu";	
		}
	elseif(intval($arr_Tgl[0]) >= 1900 && intval($arr_Tgl[0]) <= 1999)
		{
		if($hasil==1 || $hasil==0) $func_hari="Selasa";
		if($hasil==2) $func_hari="Rabu";
		if($hasil==3) $func_hari="Kamis";
		if($hasil==4) $func_hari="Jumat";
		if($hasil==5) $func_hari="Sabtu";
		if($hasil==6) $func_hari="Minggu";
		if($hasil==7) $func_hari="Senin";	
		}
	return $func_hari;
	}
// Fungsi-fungsi untuk kalender jawe selesai

function check_word($my_word) 
     { 
     global $bad_words; 
     $my_word=strtolower($my_word); 
     $my_word=strip_tags($my_word); 
     $my_word=trim($my_word); 
     $my_word=explode(" ",$my_word); 
     $check_word=0;
     for($a=0; $a < count($bad_words); $a++)
     	{
     	if(in_array($bad_words[$a],$my_word)) 
     		{
     		$check_word=1;
     		}
     	}
     return $check_word;
     } 
	 
// - Fungsi Baru (sesuai SOP) - update: 15/07/2011 ----------------------------------------------------------------

function barHalaman($sqlview, $pageNo, $PageSize, $link, $imgPrevOn="", $imgPrevOff="", $imgNextOn="", $imgNextOff="", $mode="S", $bahasa="id") {
	/*
		mode: S = simple; C = complete
		bahasa: id = bahasa indonesia; en = english
	*/
	global $baca;
	$arrH = array();
	$arrH['bar'] = "";
	$arrH['sql'] = "";
	$PageNo = (int) $pageNo;
	
	if($bahasa=="en") {
		$lprev = "previous";
		$lnext = "next";
		$lcariKosong = "Empty Input";
		$lcariAngka = "Please fill with numeric between ' + bil1 + ' and '+bil2";
		$lgoto = "Goto page";
		$ldari = "from";
		$lhal = "page";
		$lhals = "pages";
		$ltotal = "data from total";
	} else {
		$lprev = "sebelumnya";
		$lnext = "selanjutnya";
		$lcariKosong = "Kotak isian masih kosong";
		$lcariAngka = "Isi angka antara ' + bil1 + ' dan '+bil2";
		$lgoto = "menuju halaman";
		$ldari = "dari";
		$lhal = "halaman";
		$lhals = "halaman";
		$ltotal = "data dari total";
	}
	
	$imgLeftOn	= '<img alt="'.$lprev.'" border="0" src="'.$imgPrevOn.'"/>';
	$imgLeftOff	= '<img alt="'.$lprev.'" border="0" src="'.$imgPrevOff.'"/>';
	$imgRightOn	= '<img alt="'.$lnext.'" border="0" src="'.$imgNextOn.'"/>';
	$imgRightOff= '<img alt="'.$lnext.'" border="0" src="'.$imgNextOff.'"/>';
	
	
	$StartRow = 0;
	$PageNo = round($PageNo);
	//Set the page no
	if(empty($PageNo)){
	    if($StartRow == 0){
	        $PageNo = $StartRow + 1;
	    }
	}else{
	    //$PageNo = $PageNo;
	    $StartRow = ($PageNo - 1) * $PageSize;
	}
	
	$Trecord=mysql_query($sqlview,$baca) or die("There is no result");
	$sqlview=$sqlview." LIMIT $StartRow,$PageSize";
	$RecordCount = mysql_num_rows($Trecord);
	
	
	 //Set Maximum Page
	 $MaxPage = $RecordCount % $PageSize;
	 if($RecordCount % $PageSize == 0){
	    $MaxPage = $RecordCount / $PageSize;
	 }else{
	    $MaxPage = ceil($RecordCount / $PageSize);
	 }
	 $NextPage = $PageNo + 1;
	 $PrevPage = $PageNo - 1;
	
	
	$fromData=(($PageNo - 1)*$PageSize)+1;
	$endData=($fromData+$PageSize)-1;
	if($endData > $RecordCount) $endData=$RecordCount;	
			
	$hlmAwal=1;	
  	if($PageNo > 10) 
  		{
  		if($PageNo % 10 == 0) $hlmAwal = ((($PageNo / 10) - 1) *10) + 1;
  		else $hlmAwal=((intval($PageNo / $PageSize)*$PageSize)+1);
  		}  	
  	$hlmAkhir=$hlmAwal - 1 + 10;
  	if($hlmAkhir > $MaxPage) $hlmAkhir=$MaxPage;
  	
  	    //Print First & Previous Link is necessary
        if ($RecordCount>$PageSize) {
			if($mode=="C") {
				$bar .= "<script language=Javascript>\n";
				$bar .= "function validasi(x)\n";
				$bar .= "{\n";
				$bar .= "var bil1=1;\n";
				$bar .= "var bil2=".$MaxPage.";\n";
				$bar .= "var hal = x.dPageNo.value;\n";
				$bar .= "var pesan = ''; ";
				$bar .= "if(hal ==''){pesan='".$lcariKosong."'; alert(pesan); return false;}\n";
				$bar .= "else if(isNaN(hal)){ pesan='".$lcariAngka."; alert(pesan); return false; }\n";
				$bar .= "else if(hal<bil1 || hal>bil2){ pesan='".$lcariAngka."; alert(pesan); return false; }\n";
				$bar .= "else { return true;}\n";
				$bar .= "}\n";
				$bar .= "</script>\n";
			}
			$bar .= "<div align='center'>";
			$bar .= '<table class="pagebar" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top" align="center">';
					if ($PrevPage) 
					{ 
							if(strpos($link,"?") > 1)
								{
								$bar .= ' <a style="padding:0;margin:0;" href="'.$link.'&PageNo='.$PrevPage.'">'.$imgLeftOn.'</a> ';
								}
							else
								{
								$bar .= ' <a style="padding:0;margin:0;" href="'.$link.'?PageNo='.$PrevPage.'">'.$imgLeftOn.'</a> ';
								}
					} 
					else 
					{
							$bar .= ' '.$imgLeftOff.' ';
					}
					
					$bar .= '&nbsp;&nbsp;';
					$bar .= '</td><td valign="top" align="center">';
					
					for ($i = $hlmAwal; $i <= $hlmAkhir; $i++) 
						{
						if ($i>1 && $i!=$hlmAwal)
						 {
						  // $bar .=" - ";
						  $bar .="&nbsp;&nbsp;";
						 } 
						if ($i != $PageNo) { 
							if(strpos($link,"?") > 1)
								{
								$bar .= ' <a style="padding:0;margin:0;" href="'.$link.'&PageNo='.$i.'">'.$i.'</a>';
								}
							else
								{
								$bar .= ' <a  style="padding:0;margin:0;" href="'.$link.'?PageNo='.$i.'">'.$i.'</a>';
								}
						} else { 
						$bar .= " <b>$i</b> "; 
						} 
					}
					
					$bar .= '</td><td valign="top" align="center">';
					$bar .= '&nbsp;&nbsp;';
					
					if ($PageNo != $MaxPage) 
					{
							if(strpos($link,"?") > 1)
								{
								$bar .= ' <a style="padding:0;margin:0;" href="'.$link.'&PageNo='.$NextPage.'">'.$imgRightOn.'</a> ';
								}
							else
								{
								$bar .= ' <a style="padding:0;margin:0;" href="'.$link.'?PageNo='.$NextPage.'">'.$imgRightOn.'</a> ';
								}
					} 
					else 
					{
						  $bar .= ' '.$imgRightOff.' ';
					}
			
			$bar .= "</td></tr></table>";
			$bar .= "</div>";
			$bar .= '<table border="0" cellspacing="0" cellpadding="5" width="100%"><tr>';
			$bar .= "<td>";
			$bar .= "".$lhal." <b>$PageNo</b> ".$ldari." <b>$MaxPage</b> ".$lhals."";
			if($mode=="C") $bar .= "<br/><b>$fromData - $endData</b> ".$ltotal." <b>$RecordCount</b> data</b>";
			$bar .= "</td>";
			if($mode=="C") {
				$bar .= "<td align=right>";
				$bar .= "<form name=\"halaman\" method=\"post\" onSubmit=\"return validasi(document.halaman);\" action=".$dlink.">";
				$bar .= "&nbsp;&nbsp;&nbsp;".$lgoto." : ";
				$bar .= "<input type=text name=dPageNo size=3 class=inputpesan>";
				$bar .= "<input type=submit name=kirim value=GO class=tombol>";
				$bar .= "</form></td>";
			}
			$bar .= "</tr></table>";
			$bar .= "";
		}
	$arrH['bar'] = $bar;
	$arrH['sql'] = $sqlview;
	$arrH['idx'] = $fromData;
	return $arrH;
}

function net_match($network, $ip) {
	// fungsi untuk mengecek ip dalam network tertentu
	
	// determines if a network in the form of 192.168.17.1/16 or
	// 127.0.0.1/255.255.255.255 or 10.0.0.1 matches a given ip
	$ip_arr = explode('/', $network);
	$network_long = ip2long($ip_arr[0]);

	$x = ip2long($ip_arr[1]);
	$mask =  long2ip($x) == $ip_arr[1] ? $x : 0xffffffff << (32 - $ip_arr[1]);
	$ip_long = ip2long($ip);

	// echo ">".$ip_arr[1]."> ".decbin($mask)."\n";
	return ($ip_long & $mask) == ($network_long & $mask);
}
				
function wildcard_in_array ($string, $array = array ()){
	// fungsi mencari data dalam array dengan string tertentu
	foreach ($array as $key => $value) {
		unset ($array[$key]);
		if (strpos($value, $string) !== false) {
			$array[$key] = $value;
		}
	}
	return $array;
}

function timeDiff($firstTime,$lastTime){
	// fungsi mengecek perbedaan antara dua waktu

	// convert to unix timestamps
	$firstTime=strtotime($firstTime);
	$lastTime=strtotime($lastTime);

	// perform subtraction to get the difference (in seconds) between times
	$timeDiff=$lastTime-$firstTime;

	// return the difference
	return $timeDiff;
}

function msort($array, $id="id", $sort_ascending=true) {
	// sort array multi dimensional
	$temp_array = array();
	while(count($array)>0) {
		$lowest_id = 0;
		$index=0;
		foreach ($array as $item) {
			if (isset($item[$id])) {
				if ($array[$lowest_id][$id]) {
					if ($item[$id]<$array[$lowest_id][$id]) {
						$lowest_id = $index;
					}
				}
			}
			$index++;
		}
		$temp_array[] = $array[$lowest_id];
		$array = array_merge(array_slice($array, 0,$lowest_id), array_slice($array, $lowest_id+1));
	}
	if ($sort_ascending) {
		return $temp_array;
	} else {
		return array_reverse($temp_array);
	}
}

function romawi($n){
	// fungsi mentranslate angka biasa menjadi romawi
	$hasil = "";
	$iromawi = array("","I","II","III","IV","V","VI","VII","VIII","IX","X",20=>"XX",30=>"XXX",40=>"XL",50=>"L",
	60=>"LX",70=>"LXX",80=>"LXXX",90=>"XC",100=>"C",200=>"CC",300=>"CCC",400=>"CD",500=>"D",600=>"DC",700=>"DCC",
	800=>"DCCC",900=>"CM",1000=>"M",2000=>"MM",3000=>"MMM");
	if(array_key_exists($n,$iromawi)){
		$hasil = $iromawi[$n];
	}elseif($n >= 11 && $n <= 99){
		$i = $n % 10;
		$hasil = $iromawi[$n-$i] . romawi($n % 10);
	}elseif($n >= 101 && $n <= 999){
		$i = $n % 100;
		$hasil = $iromawi[$n-$i] . romawi($n % 100);
	}else{
		$i = $n % 1000;
		$hasil = $iromawi[$n-$i] . romawi($n % 1000);
	}
	return $hasil;
}

function generatePassword($length=9, $strength=0) {
	// fungsi generate random password strength
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}

function getFirstImage($kalimat, $width, $height, $styleTag="") {
	// mendapatkan image pertama dari editor file
	// JPG only
	
	$sRegExp = "/\< *[img][^\>]*[src] *= *[\"\']{0,1}([^\"\'\ >]*)/i";
	preg_match($sRegExp, $kalimat, $aMatches);
	// $imageDir = strtolower($aMatches['1']);
	// $imageDir = str_replace(".jpg",".JPG",$imageDir);
	$imageDir = $aMatches['1'];
	$imageDir = str_replace(".JPG",".jpg",$imageDir);
	$imageDir = str_replace(".PNG",".png",$imageDir);
	$imageDir = str_replace(".GIF",".gif",$imageDir);
	
	if(empty($imageDir)) {
		$imageDir = '';
	} else {
		$imageDir = '<img width="'.$width.'" height="'.$height.'" '.$styleTag.' border="0" src="'.$imageDir.'"/>';
	}
	
	return $imageDir;
}

function menu($tipe, $id, $url, $image=null) {
	if ($tipe!="sitemap" && $tipe!="dropdown") return;

	$menu = "";
	$submenu = "";
	$s = "select * from ".tabel_halaman." where status_halaman='1' and halaman_id=".$id." ".$addSql;
	$r = mysql_query($s);
	if($d = mysql_fetch_assoc($r)) {
		$menu = $d['nama_halaman'];
	}
	$submenu = submenu($id, $url);
	
	if (empty($submenu)) {
		$menu = '<li><a href="'.$url.$id.'">'.$d['nama_halaman'].'</a></li>';
	} else {
		if ($tipe=="sitemap") $menu = '<li><b>'.$menu.'</b>'.$submenu.'</li>';
		if ($tipe=="dropdown") {
			if (empty($image)) $menu = '<li><a href="#" style="padding-bottom:5px;text-align:center;"><b>'.$menu.'</b></a>'.$submenu.'</li>';
			else $menu = '<li><a href="#"><img border="0" src="'.$image.'"/></a>'.$submenu.'</li>';			
		}
	}
	return $menu;
}

function submenu($id,$url) {
	$menu = "";
	$submenu = "";
	$childmenu = "";
	$s2 = "select * from ".tabel_halaman." where status_halaman='1' and top_halaman=".$id." ".$addSql." order by urut_halaman";
	$r2 = mysql_query($s2);
	$n2 = mysql_num_rows($r2);
	if ($n2>0) {
		while($d2 = mysql_fetch_assoc($r2)) {
			$childmenu = submenu($d2['halaman_id'], $url);
			$url2 = !empty($childmenu)? "#" : $url.$d2['halaman_id'];
			$addClass = !empty($childmenu)? 'class="haschild"' : 'class="nochild"';
			$submenu .= '<li ><a '.$addClass.' href="'.$url2.'">'.$d2['nama_halaman'].'</a>';
			$submenu .= $childmenu;
			$submenu .= '</li>';
		}
		$menu .= "<ul>";
		$menu .= $submenu;
		$menu .= "</ul>";
	}
	return $menu;
}

function genSitemap($url,$className) {
	$menu = "";
	$sql = "select * from ".tabel_halaman." where status_halaman='1' and top_halaman='1' and halaman_id!='1' ".$addSql." order by urut_halaman asc";
	$res = mysql_query($sql);
	while($row=mysql_fetch_object($res)) {
		$menu .= menu("sitemap",$row->halaman_id,$url);
	}	
	if (!empty($menu)) {
		$menu = '<ul id="'.$className.'">'.$menu.'</ul>';
	}
	
	return $menu;
}

function kirimEmail($titikFolder, $isHtml=false, $toEmail, $toName, $fromEmail, $fromName, $judul, $isi) {
	// kalo email tujuan banyak, pisahkan dengan koma
	// kalo email tujuan banyak, variabel toName akan diabaikan
	require_once($titikFolder."inc/class.phpmailer.php");
	
	/*email connections*/
	$mail = new PHPMailer(); 
	$mail->IsSMTP();                                        // set mailer to use SMTP
	//*
	// $mail->Host = "192.168.0.52"; 		            	// specify main and backup server
	$mail->Host = email_config_host; 		      			// specify main and backup server
	$mail->SMTPAuth = true;                                 // turn on SMTP authentication
	$mail->Username = email_config_username;				// SMTP username
	$mail->Password = email_config_password;				// SMTP password
	//*/
	
	$mail->From = $fromEmail;		 // from user
	$mail->FromName = $fromName;	 // from name
	$mail->WordWrap = 100;           // word wrap
	$mail->IsHTML($isHtml);          // set to html
	
	$arr_ses_emailData=explode(",",$toEmail);
	$jumlEmailTujuan = count($arr_ses_emailData);
	if($jumlEmailTujuan>1) {
		for($a=0;$a < count($arr_ses_emailData); $a++) {
			if($a>0) {
				$mail->AddBCC($arr_ses_emailData[$a]);
			} else {
				$mail->AddAddress($arr_ses_emailData[$a]);
			}
		}
	} else {
		$mail->AddAddress($toEmail, $toName);
	}
	
	$mail->AddReplyTo($fromEmail, $fromName);
	
	//sublect
	$mail->Subject = $judul;	
	
	//TEXT ONLY
	$mail->Body = $isi;
	
	$hasil = "";
	if(!$mail->Send()) {
	   $hasil = "Message could not be sent. <br/>";
	   $hasil .= "Mailer Error: " . $mail->ErrorInfo;
	}
	return $hasil;
}

function isBolehAkses($minLevel,$hakAksesAplikasi,$hakAksesUser,$redirect=true) {
	// akses level per fitur
	$hakAksesAplikasi = (int) $hakAksesAplikasi;
	$hasil = false;
	$minLevel = (int) $minLevel;
	
	if($_SESSION['admSession']['id_level']=="1001") {
		$hasil = true;
	} else {
		if($_SESSION['admSession']['id_level']>=$minLevel && in_array($hakAksesAplikasi,$hakAksesUser)) {
			$hasil = true;
		}
	}
	if($redirect==true && $hasil==false) {
		header("location:index.php");
		exit;
	} else {
		return $hasil;
	}
}

function cleanEditor($titikFolder,$html) {
	include_once($titikFolder.'editor/wproUtilities.class.php'); 
	$html = wproUtilities::emailEncode($html);
	$html = wproUtilities::removeTags($html, array(
		// 'object' => true,
		// 'embed' => true,
		'applet' => true,
		'script' => true
	));
	
	$html = encodeHTML($html);
	
	return $html;
}

function encodeHTML($html) {
	return trim(htmlspecialchars($html, ENT_QUOTES));
}

function decodeHTML($html) {
	return html_entity_decode($html, ENT_QUOTES);
}

function decodeHTML2($html) {
	return html_entity_decode($html);
}
function clearhtml($html){
$isi=decodeHTML($html);
$letters = array('<p>','</p>',"'",'<br/>','<br>','<br />','  ','   ','<strong>','</strong>');
$fruit   = array('','','','','','','','','','');
$output  = str_replace($letters, $fruit, $isi);
$re = '/<img[^>]*>/i';
$output = preg_replace($re,'',$output);
return $output;
}
function getSocialMediaUI() {
	return '<div>
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style coklat">
			<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
			<a class="addthis_button_tweet"></a>
			<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
			<a class="addthis_counter addthis_pill_style"></a>
			</div>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fd7f9c01d3c94cd"></script>
			<!-- AddThis Button END -->
		</div>';
}

function anti_injection($idku) {
   // removes words that contain sql syntax
   $idku = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$idku);
   $idku = trim($idku); // strip whitespace
   $idku = strip_tags($idku); // strip HTML and PHP tags
   $idku = addslashes($idku); // quote string with slashes
   return $idku;
}

function _select_arr($sql) {
    $result = array();
    $exe = mysql_query($sql) or die(mysql_error() . "<pre><hr>" . $sql."</pre>");
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}

function _select($sql) {
    $exe = mysql_query($sql) or die(mysql_error() . "<hr>" . $sql);
    return $exe;
}
function show_array($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function _insert($sql) {
    $exe = mysql_query($sql) or die(mysql_error() . "<hr>" . $sql);
    if ($exe == 0)
        exit;
    return $exe;
}
function _select_unique_result($sql) {
    $exe = mysql_query($sql) or die(mysql_error() . "<hr>" . $sql);
    $row = mysql_fetch_array($exe);
    return $row;
}
function _update($sql) {
    $exe = mysql_query($sql) or die(mysql_error() . "<hr>" . $sql);
    return $exe;
}


function formatrp($angka){
	$rupiah=number_format($angka,2,',','.'); 
	return $rupiah;
}

function formatrp2($angka){
	$rupiah=number_format($angka,2,',','.'); 
	return "Rp ".$rupiah;
}
function _last_id() {
    return mysql_insert_id();
}

function toAscii($str, $replace=array(), $delimiter='-') {
    if( !empty($replace) ) {
        $str = str_replace((array)$replace, ' ', $str);
    }

    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

    return $clean;
}


function dataProduk($xID){
	if(strlen($xID) > 0){
	   
		$sqlviewDP = "SELECT * FROM cni_produk WHERE id_produk='".$xID."'  ORDER BY id_produk Asc limit 1";
		$resultDP = mysql_query($sqlviewDP) or die ("Erroorrr Function dataProduk".mysql_error());
		while($rs_DP = mysql_fetch_array($resultDP)) {
			$dataProduk["id"] = $rs_DP[id_produk];
			$dataProduk["nama_product"] = $rs_DP[nama_produk];
			$dataProduk["harga_diskon"] = $rs_DP[harga_diskon];
			$dataProduk["harga_coret"] = $rs_DP[harga]; 
			if($rs_DP[harga_diskon]>0){
				$dataProduk["harga"] = $rs_DP[harga_diskon];
			}else{
				$dataProduk["harga"] = $rs_DP[harga];
			} 
			$dataProduk["dsc"] = putusKalimat($rs_DP[detail],40);			
		}
	}
	return $dataProduk;
}

function getTotalCart(){
	if(is_array($_SESSION[sesJumlah])){
		$tempo=0;
		for($i=0;$i<=count($_SESSION[sesJumlah]);$i++){
			$tempo = $tempo + $_SESSION[sesJumlah][$i];
		}
		echo $tempo;
	}else{
		echo "0";
	}
}

function sessionvisitor($panjang,$ip) { 
   $pstring =md5($ip); 
   $plen = strlen($pstring); 
   $unik='';
      for ($i = 1; $i <= $panjang+3; $i++) { 
          $start = rand(1,$plen); 
          $unik.= substr($pstring, $start, 1); 
      } 
 
   return "Cni-".$unik; 
} 
function sessionadmin($panjang) { 
   $pstring =md5(date("YmdH:i:s")."citraweb"); 
   $plen = strlen($pstring); 
   $unik='';
      for ($i = 1; $i <= $panjang+3; $i++) { 
          $start = rand(1,$plen); 
          $unik.= substr($pstring, $start, 1); 
      } 
 
   return "citraweb".$unik; 
} 
function GenerateCode(){
	global $baca;
	$sql = "select invoice_number from cni_order where 1 Order By invoice_number DESC LIMIT 1";
	$res = mysql_query($sql,$baca);
	$num = mysql_num_rows($res);
	$row = mysql_fetch_object($res);
    $nomori = $row->invoice_number;
   
	if($num==0){
	   $urutan = "00001";
	}else{
		$hitung = $nomori+ 1;
		$urutan = sprintf("%05d",$hitung);
	}
	return $urutan;
}

function YM($yahooid){
	global $addLink;
	$ch = curl_init("http://opi.yahoo.com/online?u=".$yahooid."&m=t");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$status = curl_exec($ch);
	curl_close($ch);
	if($status == $yahooid." is NOT ONLINE"){
	//tampilkan gambar offline
		$cetak = "<img src='".$addLink."/../images/aden/ym2.png' border=0/>";
		} elseif ($status == $yahooid." is ONLINE"){
		//tampilkan gambar online
		$cetak = "<a href=ymsgr:sendIM?$yahooid><img src='".$addLink."/../images/aden/ym1.png' border=0/></a>";
	}
	return $cetak;
}

function tgl_indo($tgl){

	$tanggal = substr($tgl,8,2);

	$bulan = get_bulan(substr($tgl,5,2));

	$tahun = substr($tgl,0,4);

	return $tanggal.' '.$bulan.' '.$tahun;

}
function statistik_pengunjung(){
	$info=_select_unique_result("select cv.*,count(cv.id) as jumlah,(select count(cv2.id) from cni_visitor cv2 where cv2.tanggal='".date("Y-m-d")."' ) as jmtd from cni_visitor cv");
	return $info;	
}
function script_cni($id){
	$info=_select_unique_result("select isi from cni_script where id='$id'");
	return $info;	
}

function get_bulan($bln){

		switch($bln){

			case 1:

			return "Januari";

			break;

			case 2:

			return "Februari";

			break;

			case 3:

			return "Maret";

			break;

			case 4:

			return "April";

			break;

			case 5:

			return "Mei";

			break;

			case 6:

			return "Juni";

			break;

			case 7:

			return "Juli";

			break;

			case 8:

			return "Agustus";

			break;

			case 9:

			return "September";

			break;

			case 10:

			return "Oktober";

			break;

			case 11:

			return "November";

			break;

			case 12:

			return "Desember";

			break;

		}

	}
	
function get_bulan_en($bln){

		switch($bln){

			case 1:

			return "January";

			break;

			case 2:

			return "February";

			break;

			case 3:

			return "March";

			break;

			case 4:

			return "April";

			break;

			case 5:

			return "May";

			break;

			case 6:

			return "June";

			break;

			case 7:

			return "July";

			break;

			case 8:

			return "August";

			break;

			case 9:

			return "September";

			break;

			case 10:

			return "October";

			break;

			case 11:

			return "November";

			break;

			case 12:

			return "December";

			break;

		}

	}	
function video_muat_data($id=NULL,$nama=NULL,$limit=NULL){
   $where= null;
   $limit= null;
    if (!empty($id)) {
        $where= " and id = '$id'";
    }
    if (!empty($nama)) {
        $where= " and nama like '%$nama%'";
    }
	 if (!empty($limit)) {
        $limit= " limit $limit";
    }

    $sql = "select * from ".tabel_video." where kategori ='0'  $where order by id desc $limit";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}
function slideshow_muat_data(){

    $sql = "select * from ".tabel_header_slideshow;
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}
function newnews_muat_data(){

    $sql = "select * from ".tabel_berita." where kategori ='0' and  status='1' order by id DESC limit 2";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}

function othernews_muat_data($idsatu,$idua){
$where='';
$or='';
if($idsatu!=''){
$where="  and id != '$idsatu' ";
}
if($idua!=''){
$or=" or kategori ='0' and  status='1' and id != '$idua' ";
}

    $sql = "select * from ".tabel_berita." where kategori ='0' and  status='1' $where $or order by id DESC limit 3";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}



function maxidnews_muat_data(){

    $sql = "select MAX(id) from ".tabel_berita." where kategori ='0' and  status='1'";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}

function detail_berita_muat_data($id){
$id=anti_injection($id);
    $sql = "select * from ".tabel_berita." where kategori ='0' and id='$id'";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}
function detail_event_muat_data($id){
$id=anti_injection($id);
    $sql = "select te.*,tf.nama as namavenue from ".tabel_event." te
	join ".tabel_fasilitas." tf on(tf.id=te.venue)
	 where te.kategori ='0' and te.id='$id'";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}
function detail_fasilitas_muat_data($id){
$id=anti_injection($id);
    $sql = "select * from ".tabel_fasilitas." where id='$id'";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}
function menu_fasilitas_muat_data(){
    $sql = "select * from ".tabel_fasilitas." where status ='1'";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}
function readmore($text,$char,$url,$selengkap) {
	if (strlen($text) > $char) {
		return substr($text, 0, $char).'<br/><a href="'.$url.'">Read More</a>';
	}
	else return $text;

}
function deskripsi($text,$char) {
	if (strlen($text) > $char) {
		return substr($text, 0, $char).$selengkap;
	}
	else return $text;

}
function cleanurllho($judul){
$letters = array(' ?', ' ','?','? ','(',')','-/-');
$fruit   = array('', '-', '', '', '', '','-');
$output  = str_replace($letters, $fruit, strtolower($judul));
return $output;
}

function replacesamadengan($judul){
$letters = array('=','-');
$fruit   = array('x0x',' ');
$output  = str_replace($letters, $fruit, $judul);
return $output;
}

function replaceurl($judul){
$letters = array('=','-');
$fruit   = array('x3Dx',' ');
$output  = str_replace($letters, $fruit, $judul);
return $output;
}

function  replaceopolagi($judul){
$letters = array('x0x');
$fruit   = array('=');
$output  = str_replace($letters, $fruit, $judul);
return $output;
}

function  replacebalikurl($judul){
$letters = array('x3Dx');
$fruit   = array('=');
$output  = str_replace($letters, $fruit, $judul);
return $output;
}

function  keyword($key){
$letters = array(' ','-',', ,');
$fruit   = array(', ',', ','');
$output  = str_replace($letters, $fruit, $key);
return $output;
}
function saveid($id){
$crypt = new MD5Crypt;
$sessioncrypt=$crypt->Encrypt($id,rahasialho);	
return replacesamadengan($sessioncrypt);
}

function bukaid($id){
$crypt = new MD5Crypt;
$sessioncrypt=$crypt->DEcrypt(replaceopolagi($id),rahasialho);	
return $sessioncrypt;
}

function saveurl($id){
$crypt = new MD5Crypt;
$sessioncrypt=$crypt->Encrypt($id,rahasialho);	
return replaceurl($sessioncrypt);
}

function bukaurl($id){
$crypt = new MD5Crypt;
$sessioncrypt=$crypt->DEcrypt(replacebalikurl($id),rahasialho);	
return $sessioncrypt;
}



function hari($hari)
{
    switch ($hari)
    {
         case 0 : $hari = "Minggu";
                  return $hari;
                  break;
         case 1 : $hari = "Senin";
                  return $hari;
                  break;
         case 2 : $hari = "Selasa";
                 return $hari;
                 break;
         case 3 : $hari = "Rabu";
                 return $hari;
                  break;
        case 4 : $hari = "Kamis";
               return $hari;
               break;
        case 5 : $hari = "Jumat";
               return $hari;
               break;
       case 6 : $hari = "Sabtu";
               return $hari;
               break;
}
}
function datetime($dt) {
    $var = explode(" ", $dt);
    $var1 = explode("-", $var[0]);
    $var2 = "$var1[2] ".get_bulan_en($var1[1])." $var1[0]";
	$var3 = "$var1[0]/$var1[1]/$var1[2]";
	$hari =date('l', strtotime($var3));
     $jam = explode(":", $var[1]);
	 $jam2="$jam[0]:$jam[1]";
    return $hari.",".$var2 . " " . $jam2;
}
function datetimeid($dt) {
    $var = explode(" ", $dt);
    $var1 = explode("-", $var[0]);
    $var2 = "$var1[2] ".get_bulan($var1[1])." $var1[0]";
	$var3 = "$var1[0]/$var1[1]/$var1[2]";
	$hari =date('N', strtotime($var3));
     $jam = explode(":", $var[1]);
	 $jam2="$jam[0]:$jam[1]";
    return hari($hari).",".$var2 . " " . $jam2;
}
function dateaja($dt) {
    $var = explode(" ", $dt);
    $var1 = explode("-", $var[0]);
	$var3 = "$var1[2]-$var1[1]-$var1[0]";
    return $var3;
}
function banneratasmuatdata(){
$today=date("Y-m-d");
  $sql = "select * from ".tabel_banner." where id_kategori = '1' 
  AND tanggal_mulai <= '$today'  AND tanggal_selesai >= '$today'
  limit 6";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}
function bannerkananmuatdata($limit){
$today=date("Y-m-d");
  $sql = "select * from ".tabel_banner." where id_kategori = '2' 
  AND tanggal_mulai <= '$today'  AND tanggal_selesai >= '$today'
  limit $limit";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}
function galleryfotomuatdata($limit){
$today=date("Y-m-d");
  $sql = "select * from ".tabel_foto." where kategori = '0' 
  limit $limit";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}
function date2mysql($tgl) {
    $new = null;
    $tgl = explode("-", $tgl);
    if (empty($tgl[2]))
        return "";
    $new = "$tgl[2]-$tgl[1]-$tgl[0]";
    return $new;
}
function gallery_per_kategori($id,$limit){
$today=date("Y-m-d");
  $sql = "select * from ".tabel_foto." where parent_id = '$id' 
  limit $limit";
    $exe = mysql_query($sql);
    $result = array();
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}

function generate_get_parameter($get,$addArr=array(),$removeArr=array()) {
    if($addArr==null)
        $addArr=array();
    foreach($removeArr as $rm){
        unset($get[$rm]);
    }
    $link = "";
    $get=array_merge($get, $addArr);
    foreach ($get as $key => $val) {
        if ($link == null) {
            $link.="$key=$val";
        }else
            $link.="&$key=$val";
    }
    return $link;
}

function generate_url_parameter($get,$addArr=array(),$removeArr=array()) {
    if($addArr==null)
        $addArr=array();
    foreach($removeArr as $rm){
        unset($get[$rm]);
    }
    $link = "";
    $get=array_merge($get, $addArr);
    foreach ($get as $key => $val) {
        if ($link == null) {
            $link.="$key=$val";
        }else
            $link.="&$key=$val";
    }
    return $link;
}
function gantibahasa($url,$pengganti,$asal){
$letters = array("/".$asal."/", "/".$asal);
$fruit   = array("/".$pengganti."/", "/".$pengganti);
$output  = str_replace($letters, $fruit, $url);
return $output;
}
function paging($sql, $dataPerPage) {

    $showPage = NULL;
    ob_start();
    echo "
        <div class='body-page'>";
    if (!empty($_GET['page'])) {
        $noPage = $_GET['page'];
    } else {
        $noPage = 1;
    }
	$kategoriurl = isset($_GET['kategori']) ? $_GET['kategori'] : NULL;

    $dataPerPage = $dataPerPage;
    $offset = ($noPage - 1) * $dataPerPage;

    $hasil = mysql_query($sql);

    $data = mysql_num_rows($hasil);
    $jumData = $data;
    $jumPage = ceil($jumData / $dataPerPage);
    $get=$_GET;
    if ($jumData > $dataPerPage) {
        if ($noPage > 1){            
            $get['page']=($noPage - 1);
			if ($ajax != NULL) "<span class='page-prev'></span>";
            else echo "<span class='page-prev'></span>";
        }
        for ($page = 1; $page <= $jumPage; $page++) {
            if ((($page >= $noPage - 9) && ($page <= $noPage + 9)) || ($page == 1) || ($page == $jumPage)) {
                if (($showPage == 1) && ($page != 2))
                    echo "...";
                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
                    echo "...";
                if ($page == $noPage)
                    echo " <span class='noblock'>" . $page . "</span> ";
                else{
                    $get['page']=$page;
                    
                    if($tab != NULL){
                        $get['tab'] = $tab;
                    }
					if ($ajax != NULL) echo " <a class='block' onclick='contentloader(\"?" .  generate_get_parameter($get). "\",\"#content\")'>" . $page . "</a> ";
                    else echo " <a class='block' href='" .app_base_url.$_SESSION['bahasa']."/".$kategoriurl."/gallery/".$page."/foto.html"."'>" . $page . "</a> ";
                }
                $showPage = $page;
            }
        }

        if ($noPage < $jumPage){
            $get['page']=($noPage + 1);
			if ($ajax != NULL) echo "<span class='page-next' onclick='contentloader(\"?" .  generate_get_parameter($get). "\",\"#content\")'></span>";
            else echo "<span class='page-next' onClick=location.href='?" .  generate_get_parameter($get). "'></span>";
        }
    }
    echo "</div>";

    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
}

function pagination($sql, $dataPerPage) {

    $showPage = NULL;
    ob_start();
    echo "
        <div class='body-page2'>";
    if (!empty($_GET['page'])) {
        $noPage = $_GET['page'];
    } else {
        $noPage = 1;
    }
	$kategoriurl = isset($_GET['kategori']) ? $_GET['kategori'] : NULL;

    $dataPerPage = $dataPerPage;
    $offset = ($noPage - 1) * $dataPerPage;

    $hasil = mysql_query($sql);

    $data = mysql_num_rows($hasil);
    $jumData = $data;
    $jumPage = ceil($jumData / $dataPerPage);
    $get=$_GET;
    if ($jumData > $dataPerPage) {
        if ($noPage > 1){            
            $get['page']=($noPage - 1);
			if ($ajax != NULL) "<a href='" .app_base_url."news/".$_SESSION['bahasa']."/".$get['page']."/list.html"."'><span class='page-prev'></span></a>";
            else echo "<a href='" .app_base_url."news/".$_SESSION['bahasa']."/".$get['page']."/list.html"."'><span class='page-prev'></span></a>";
        }
        for ($page = 1; $page <= $jumPage; $page++) {
            if ((($page >= $noPage - 9) && ($page <= $noPage + 9)) || ($page == 1) || ($page == $jumPage)) {
                if (($showPage == 1) && ($page != 2))
                    echo "...";
                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
                    echo "...";
                if ($page == $noPage)
                    echo " <span class='noblock'>" . $page . "</span> ";
                else{
                    $get['page']=$page;
                    
                    if($tab != NULL){
                        $get['tab'] = $tab;
                    }
					if ($ajax != NULL) echo " <a class='block' onclick='contentloader(\"?" .  generate_get_parameter($get). "\",\"#content\")'>" . $page . "</a> ";
                    else echo " <a class='block' href='" .app_base_url."news/".$_SESSION['bahasa']."/".$page."/list.html"."'>" . $page . "</a> ";
                }
                $showPage = $page;
            }
        }

        if ($noPage < $jumPage){
            $get['page']=($noPage + 1);
			if ($ajax != NULL) echo "<span class='page-next' href='" .app_base_url."news/".$_SESSION['bahasa']."/".$get['page']."/list.html"."'></span>";
            else echo "<a href='" .app_base_url."news/".$_SESSION['bahasa']."/".$get['page']."/list.html"."'><span class='page-next'></span></a>";
        }
    }
    echo "</div>";

    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
}
function pagination2($sql, $dataPerPage, $access) {

    $showPage = NULL;
    ob_start();
    echo "
        <div class='body-page2'>";
    if (!empty($_GET['page'])) {
        $noPage = $_GET['page'];
    } else {
        $noPage = 1;
    }
	$kategoriurl = isset($_GET['kategori']) ? $_GET['kategori'] : NULL;

    $dataPerPage = $dataPerPage;
    $offset = ($noPage - 1) * $dataPerPage;

    $hasil = mysql_query($sql);

    $data = mysql_num_rows($hasil);
    $jumData = $data;
    $jumPage = ceil($jumData / $dataPerPage);
    $get=$_GET;
    if ($jumData > $dataPerPage) {
        if ($noPage > 1){            
            $get['page']=($noPage - 1);
			if ($ajax != NULL) "<a href='" .app_base_url.$access."/".$_SESSION['bahasa']."/".$get['page']."/list.html"."'><span class='page-prev'></span></a>";
            else echo "<a href='" .app_base_url.$access."/".$_SESSION['bahasa']."/".$get['page']."/list.html"."'><span class='page-prev'></span></a>";
        }
        for ($page = 1; $page <= $jumPage; $page++) {
            if ((($page >= $noPage - 9) && ($page <= $noPage + 9)) || ($page == 1) || ($page == $jumPage)) {
                if (($showPage == 1) && ($page != 2))
                    echo "...";
                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
                    echo "...";
                if ($page == $noPage)
                    echo " <span class='noblock'>" . $page . "</span> ";
                else{
                    $get['page']=$page;
                    
                    if($tab != NULL){
                        $get['tab'] = $tab;
                    }
					if ($ajax != NULL) echo " <a class='block' onclick='contentloader(\"?" .  generate_get_parameter($get). "\",\"#content\")'>" . $page . "</a> ";
                    else echo " <a class='block' href='" .app_base_url.$access."/".$_SESSION['bahasa']."/".$page."/list.html"."'>" . $page . "</a> ";
                }
                $showPage = $page;
            }
        }

        if ($noPage < $jumPage){
            $get['page']=($noPage + 1);
			if ($ajax != NULL) echo "<span class='page-next' href='" .app_base_url."news/".$_SESSION['bahasa']."/".$get['page']."/list.html"."'></span>";
            else echo "<a href='" .app_base_url.$access."/".$_SESSION['bahasa']."/".$get['page']."/list.html"."'><span class='page-next'></span></a>";
        }
    }
    echo "</div>";

    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
}

function galler_foto_muat_data($kategory,$page = null){
$where="";
   $result = array();
	
	if($kategory!=''){
	$where=" and parent_id ='$kategory'";
	}
   	
	$dataPerPage='20';	
 	if (!empty($page)) {
        $noPage = $page;
    } else {
        $noPage = 1;
    }
		

	$offset = ($noPage - 1) * $dataPerPage;
    $batas = "";
    if ($dataPerPage != null) {
        $batas = "limit $offset, $dataPerPage";
    }
	
	$fotolist = "select * from ".tabel_foto." where kategori = '0' $where $batas";
	
	$result['list']= _select_arr($fotolist);
	$sqli = "select * from ".tabel_foto." where kategori = '0' $where";
 	$result['paging'] = paging($sqli , $dataPerPage);
    $result['offset'] = $offset;
return $result;
}

function indexnews_muat_data($idsatu,$idua,$page){
$where='';
$or='';
if($idsatu!=''){
$where="  and id != '$idsatu' ";
}
if($idua!=''){
$or=" or kategori ='0' and  status='1' and id != '$idua' ";
}
$where="";
   $result = array();
	
	if($kategory!=''){
	$where=" and parent_id ='$kategory'";
	}
   	
	$dataPerPage='5';	
 	if (!empty($page)) {
        $noPage = $page;
    } else {
        $noPage = 1;
    }
		

	$offset = ($noPage - 1) * $dataPerPage;
    $batas = "";
    if ($dataPerPage != null) {
        $batas = "limit $offset, $dataPerPage";
    }
	
	
    $sql = "select * from ".tabel_berita." where kategori ='0' and  status='1' $where $or $batas";
 	$result['list']= _select_arr($sql);
	
	 $sqli = "select * from ".tabel_berita." where kategori ='0' and  status='1' $where $or";
	 $result['paging'] = pagination($sqli , $dataPerPage);
    $result['offset'] = $offset;
    return $result;
}

function indexevent_muat_data($page){
   $result = array();
	
	if($kategory!=''){
	$where=" and parent_id ='$kategory'";
	}
   	
	$dataPerPage='5';	
 	if (!empty($page)) {
        $noPage = $page;
    } else {
        $noPage = 1;
    }
		

	$offset = ($noPage - 1) * $dataPerPage;
    $batas = "";
    if ($dataPerPage != null) {
        $batas = "limit $offset, $dataPerPage";
    }
	
	
    $sql = "select * from ".tabel_event." where kategori ='0' order by id desc $batas";
 	$result['list']= _select_arr($sql);
	
	 $sqli = "select * from ".tabel_event." where kategori ='0'";
	 $result['paging'] = pagination2($sqli , $dataPerPage, 'events');
    $result['offset'] = $offset;
    return $result;
}
function indexlistevent_muat_data($limit){
   $result = array();
    $sql = "select * from ".tabel_event." where kategori ='0'  order by id desc limit $limit";
 	$result['list']= _select_arr($sql);
    return $result;
}

function katagori_foto_muat_data(){

$kategorifoto = "select * from ".tabel_foto." where kategori = '1'";
$exekategorifoto = mysql_query($kategorifoto);
$result = array();

    while ($rows = mysql_fetch_array($exekategorifoto)) {
        $result[] = $rows;
    }
return $result;
}

function jumlah_foto_muat_data($id){
$result = _select_unique_result("select count(id) from ".tabel_foto." where parent_id = '$id'");
return $result;
}

function tiket_package_muat_data($id){
$where="";
if($id!=''){
$where=" where id_fasilitas='$id'";
}
$sql=_select_arr("select * from cni_tiket $where");
return $sql;
}

function about_us_muat_data(){
$sql=_select_unique_result("SELECT * FROM ".tabel_halaman." WHERE top_halaman=1 AND halaman_id!=1   ORDER BY urut_halaman");
return $sql;
}

function dinamis_halaman_muat_data(){
$sql=_select_arr("SELECT * FROM ".tabel_halaman." WHERE top_halaman>1 AND halaman_id!=1   ORDER BY urut_halaman");
return $sql;
}

function menu_clean($tipe, $id, $url, $image=null, $temp) {
	if ($tipe!="sitemap" && $tipe!="dropdown") return;

	$menu = "";
	$submenu = "";
	$s = "select * from ".tabel_halaman." where top_halaman='2' and halaman_id=".$id;
	$r = mysql_query($s);
	if($d = mysql_fetch_assoc($r)) {
		$menu = $d['nama_halaman'.$temp];
	}
	$submenu = submenu_clean($id, $url,$temp);
			if($d['top_halaman']=="2"){
	if (empty($submenu)) {
		$menu = '<li id='.$d['nama_halaman'].'><a href="'.$url.'">'.$d['nama_halaman'.$temp].'</a></li>';
	} else {
		if ($tipe=="sitemap") $menu = '<li>'.$menu.''.$submenu.'</li>';
		if ($tipe=="dropdown") {
			if (empty($image)) $menu = '<li><a href="#">'.$menu.'</a>'.$submenu.'</li>';
			else $menu = '<li><a href="#"><img border="0" src="'.$image.'"/></a>'.$submenu.'</li>';			
		}
	}
	}
	return $menu;
}

function submenu_clean($id,$url,$temp) {
	$menu = "";
	$submenu = "";
	$childmenu = "";
	$s2 = "select * from ".tabel_halaman." where status_halaman='1' and top_halaman=".$id." ".$addSql." order by urut_halaman";
	$r2 = mysql_query($s2);
	$n2 = mysql_num_rows($r2);
	if ($n2>0) {
		while($d2 = mysql_fetch_assoc($r2)) {
		//echo $d2['nama_halaman'.$temp];
		
			$childmenu = submenu_clean($d2['halaman_id'], $url);
			$url2 = !empty($childmenu)? "#" : $url;
			$addClass = !empty($childmenu)? 'class="haschild"' : 'class="nochild"';
			$sessioncrypt2562=saveid($d2['halaman_id']);	
			$submenu .= '<li ><a '.$addClass.' href="'.app_base_url.$_SESSION['bahasa']."/".$sessioncrypt2562."/".cleanurllho($d2['nama_halaman'.$temp]).".html".'">'.$d2['nama_halaman'.$temp].'</a>';
			$submenu .= $childmenu;
			$submenu .= '</li>';
		}
		
		$menu .= "<ul>";
		$menu .= $submenu;
		$menu .= "</ul>";
	}
	return $menu;
}

function download_file_data(){
$sql= _select_arr("select * from ".tabel_download." order by id desc");
return $sql;
} 

function buku_tamu_muat_data(){
$sql= _select_arr("select * from ".tabel_tamu." where kategori =  'pengunjung' and status='1'");
return $sql;
}

function respon_admin($parent){
$sql= _select_arr("select * from ".tabel_tamu." where id_parent =  '$parent'  and status='1'");
return $sql;
}
function unread_testi(){
$sql= _select_arr("select * from ".tabel_tamu." where status='0'");
return $sql;
}
function yahoo_account(){
$sql= _select_arr("select * from ".yahoo_mesangger);
return $sql;
}
function nama_top_halaman($id){
$sql= _select_unique_result("select thdua.nama_halaman,thdua.nama_halaman_e from ".tabel_halaman." th
join ".tabel_halaman." thdua on(thdua.halaman_id=th.top_halaman) where th.halaman_id ='$id'");
return $sql;
}
function detail_dinamis_muat_data($id){
$sql= _select_arr("select * from ".tabel_halaman." where halaman_id ='$id'");
return $sql;
}
function event_expire(){
$today=date("Y-m-d");
$sql= _select_arr("select * from ".tabel_event." where kategori ='0' and tanggal_mulai <'$today' and status ='1'");
$total=count($sql);	
if($total !="0"){	
		foreach($sql as $data){
	mysql_query("update ".tabel_event." set status='0' where id='$data[id]'");
		}
	}
}
function bank_rek_muat_data(){
$sql= _select_arr("select * from ".bank_account." order by id desc");
return $sql;
}
function invoice_number(){
	global $baca;
	$sql = "select booking from ".tabel_pemesanan." where 1 Order By booking DESC LIMIT 1";
	$res = mysql_query($sql,$baca);
	$num = mysql_num_rows($res);
	$row = mysql_fetch_object($res);
    $nomori = $row->booking;
   
	if($num==0){
	   $urutan = "00001";
	}else{
		$hitung = $nomori+ 1;
		$urutan = sprintf("%05d",$hitung);
	}
	return $urutan;
}
function invoice_huruf($panjang) { 
   $ip=$_SERVER['REMOTE_ADDR'];
   $pstring =md5($ip."purawisata jogjakarta").sessionadmin($panjang); 
   $plen = strlen($pstring); 
   $unik='';
      for ($i = 1; $i <= $panjang; $i++) { 
          $start = rand(1,$plen); 
          $unik.= substr($pstring, $start, 1); 
      } 
 
   return $unik; 
} 

function paypalgatweway(){
$sql= _select_unique_result("select account from ".tabel_paypal." where id='1'");
$paypal_url="https://www.paypal.com/cgi-bin/webscr"; // Test Paypal API URL
$paypal_id="citra._1362632633_biz@gmail.com";
$html='
<form action="'.$paypal_url.'" method="post" name="form7">
<input type="hidden" name="business" value="'.$paypal_id.'">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="item_name" value="Mie Ayam Bakso">
<input type="hidden" name="amount" value="100">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="cancel_return" value="http://yoursite.com/cancel.php">
<input type="hidden" name="return" value="http://yoursite.com/success.php">
<input type="hidden" name="address_override" value="Jl Petung 31">
<input type="hidden" name="invoice" value="ABCD11212">

<input type="hidden" name="image_url" value="http://www.citrahost.com/images/logo_cni.jpg">

<input type="image" src="https://paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" name="submit">
</form> 
';
 return $html;
}
?>