<?php
ob_start();
session_start();
include_once("header.php");

$judul = "Agenda";
$isi = "";
$addSql = "";
$addLink = "";

$year = date("Y");
$dtgl = date("d-m-Y");

$kat = (int) $_GET['kat']; // filter by kategori
if($kat>0) {
	$addSql = " and parent_id='".$kat."' ";
	$addLink= '+"&kat='.$kat.'"';
}

if($_GET) {
	$tgl = $_GET['tgl'];
	$arrT = @explode("-", $tgl);
	$waktuT = @mktime(0, 0, 0, $arrT['1'], $arrT['0'], $arrT['2']);
	
	if($waktuT>0) {
		$year = date("Y",$waktuT);
		$dtgl = date("d-m-Y",$waktuT);
		$isi = "";
		$sqlD = "select * from ".tabel_agenda." where status='1' and kategori='0' and ('".date("Y-m-d",$waktuT)."' between tanggal_mulai and tanggal_selesai) ".$addSql." order by tanggal_mulai asc";
		$resD = mysql_query($sqlD,$baca);
		while($rowD = mysql_fetch_object($resD)) {
			$rowD->tanggal_mulai = tglIndo($rowD->tanggal_mulai,"s");
			$rowD->tanggal_selesai = tglIndo($rowD->tanggal_selesai,"s");
			$text_tgl = ($rowD->tanggal_mulai==$rowD->tanggal_selesai) ? $rowD->tanggal_mulai : $rowD->tanggal_mulai." s/d ".$rowD->tanggal_selesai ;
			
			$isi .= $rowD->nama.'<br/>'.$text_tgl.'<br/>'.html_entity_decode($rowD->isi, ENT_QUOTES).'<br/><br/>';
		}
	}
}

// setup calendar
$arr = array();
$sql = "select id, nama, DATE_FORMAT(tanggal_mulai+' 00:00:00', '%d-%m-%Y') as tgl,datediff(tanggal_selesai,tanggal_mulai) as diff from ".tabel_agenda." where status='1' and kategori='0' and (tanggal_mulai like '".$year."-%' or tanggal_selesai like '".$year."-%') ".$addSql."";
$res = mysql_query($sql,$baca);
while($row = mysql_fetch_object($res)) {
	$tanggal_a = explode("-", $row->tgl);
	$waktu1 = mktime(0, 0, 0, $tanggal_a['1'], $tanggal_a['0'], $tanggal_a['2']);
	$i = 0;
	for($i=0;$i<=$row->diff;$i++) {
		$waktu = $waktu1+(86400*$i);
		$tgl = date("n,j,Y",$waktu);
		$arr[$tgl] .= $row->nama.",";
	}
}

$i = 0;
$jumlah = count($arr);

$ui = '[';
foreach($arr as $key => $value) {
	$i++;
	$ui .= '['.$key.',"'.$value.'"]';
	if($i<$jumlah) $ui .= ',';
}
$ui .= ']';
?>

<script type="text/javascript">
$(document).ready(function() {
	$("select[name=kat]").change(function(){ window.location.href = "?kat="+$(this).val(); });

	var curYear = '<?=$year?>';
	$(".datepicker").datepicker({
		changeMonth: true,
		changeYear: true,
		gotoCurrent: true,
		dateFormat: "dd-mm-yy",
		defaultDate: "<?=$dtgl?>",
		monthNamesShort: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
		dayNamesMin: ['Mg', 'Sn', 'Sl', 'Rb', 'Ka', 'Jm', 'Sb'],
		beforeShowDay: function (date) {
			var calendarEvents = <?=$ui?>;
			var i = 0;
			for (i = 0; i < calendarEvents.length; i++) {
				if ( (date.getMonth() == calendarEvents[i][0] - 1) && (date.getDate() == calendarEvents[i][1]) && (date.getFullYear() == calendarEvents[i][2]) ) {
					//[disable/enable, class for styling appearance, tool tip]
					return [true,"ui-state-active",calendarEvents[i][3]]; 
				}
			};
			return [false, ""];//enable all other days	
		},
		onSelect: function(dateText, inst) { 
			window.location.href = "agenda.php?tgl="+dateText<?=$addLink?>;
		},
		onChangeMonthYear: function(year, month, inst) {
			// do nothing
			if(year!=curYear) window.location.href = "agenda.php?tgl=1-"+month+"-"+year<?=$addLink?>;
		}
	});
});
</script>

<?=$judul?>
<br/>
<?=getSocialMediaUI()?><br/>
<br/>
kategori: <?=katUI("agenda","kat",$kat,"inputpesan")?>
<br/>
<br/>
<div style="float:left;padding:6px;">	
	<div class="datepicker"></div>
</div>
<div style="float:left;padding:6px;">
	<b>Catatan</b>:<br/>
		<ul>
			<li>klik tanggal untuk mengetahui agenda pada tanggal tersebut</li>
			<li>klik judul agenda untuk melihat detail agenda pada tanggal tersebut</li>
		</ul>
</div>
<br class="clear"/>
<br/><br/>
<?=$isi?>

<?php
include_once("footer.php");
?>