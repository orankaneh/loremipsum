<?php

function infoManual($namaMenu,$p) {
//$adddata=($tambahdata <> ' ') ? $tambahdata : 'tambah data';
if($p=="download") {
 $hasil=  '<div>  
			<b>Perhatian!</b><br/>
			<ol>
				<li>Langkah-langkah menambah/mengupdate data pada dasarnya sama.</li>
				<li>
					Perhatikan tulisan di bawah <b>'.$namaMenu.'</b>.									
				</li>                
                 <li>Klik <b>+ Tambah File Download +</b> untuk menyimpan data baru.</li>
                <li> klik <b>preview</b> untuk melihat data yang diupload pada baris terpilih.</li> 
			    <!--<li>tekan tombol <b>batal</b> untuk mengkosongkan kotak isian dan kembali ke mode tambah data (jika telah memasuki mode edit data)</li>-->            	
				<li>Menampilkan/tidak menampilkan data pada website:
					<ol>
						<li><img src="../images/status_1.gif"/>: data ditampilkan pada website</li>
						<li><img src="../images/status_0.gif"/>: data tidak ditampilkan pada website</li>
						<li>Klik pada gambar <img src="../images/status_0.gif"/> atau <img src="../images/status_1.gif"/> untuk mengubah status</li>
					</ol>
				</li>
                <li>klik <img src="../images/delete.png" alt="delete"/> untuk menghapus data pada baris yang bersangkutan.</li>
                <li>Masukan kata kunci dan tekan tombol cari untuk mencari data pada menu yang bersangkutan.</li>
			</ol>
		<div>';
}
if($p=="kategoripdf") {
 $hasil=  '<div>  
			<b>Perhatian!</b><br/>
			<ol>
				<li>Langkah-langkah menambah/mengupdate data pada dasarnya sama.</li>
				<li>
					Perhatikan tulisan di bawah <b>'.$namaMenu.'</b>.									
				</li>                
                 <li>Klik <b>+ Tambah File Kategori Program Studi +</b> untuk menyimpan data baru.</li>
                <li> klik <b>preview</b> untuk melihat data yang diupload pada baris terpilih.</li> 
			    <!--<li>tekan tombol <b>batal</b> untuk mengkosongkan kotak isian dan kembali ke mode tambah data (jika telah memasuki mode edit data)</li>-->            	
				<li>Menampilkan/tidak menampilkan data pada website:
					<ol>
						<li><img src="../images/status_1.gif"/>: data ditampilkan pada website</li>
						<li><img src="../images/status_0.gif"/>: data tidak ditampilkan pada website</li>
						<li>Klik pada gambar <img src="../images/status_0.gif"/> atau <img src="../images/status_1.gif"/> untuk mengubah status</li>
					</ol>
				</li>
                <li>klik <img src="../images/delete.png" alt="delete"/> untuk menghapus data pada baris yang bersangkutan.</li>
                <li>Masukan kata kunci dan tekan tombol cari untuk mencari data pada menu yang bersangkutan.</li>
			</ol>
		<div>';
}
else if($p=="testimonial"){
  $hasil=  '<div>  
			<b>Perhatian!</b><br/>
			<ol>		
				<li>
					Perhatikan tulisan di bawah <b>'.$namaMenu.'</b>.									
				</li>                
                <li>Klik kolom <b>judul</b> untuk melihat data tamu yang menulis testimonial.</li>
                <li> Data testimonal otomatis tersetting off. Hanya admin yang bisa mengaktifkan testimonial ke publik.</li> 
			    <!--<li>tekan tombol <b>batal</b> untuk mengkosongkan kotak isian dan kembali ke mode tambah data (jika telah memasuki mode edit data)</li>-->            	
				<li>Menampilkan/tidak menampilkan data pada website:
					<ol>
						<li><img src="../images/status_1.gif"/>: data ditampilkan pada website</li>
						<li><img src="../images/status_0.gif"/>: data tidak ditampilkan pada website</li>
						<li>Klik pada gambar <img src="../images/status_0.gif"/> atau <img src="../images/status_1.gif"/> untuk mengubah status</li>
					</ol>
				</li>
                <li>klik <img src="../images/delete.png" alt="delete"/> untuk menghapus data pada baris yang bersangkutan.</li>
                <li>Masukan kata kunci dan tekan tombol cari untuk mencari data pada menu yang bersangkutan.</li>
			</ol>
		<div>';   
    
}
else{
$hasil='<div>  
			<b>Perhatian!</b><br/> 
			<ol>
				<li>Langkah-langkah menambah/mengupdate data pada dasarnya sama.</li>
				<li>
					Perhatikan tulisan di bawah <b>'.$namaMenu.'</b>.									
				</li>
                <!--<li>Jika tertulis <b>edit data</b> berarti data yang disimpan akan mengubah data pada baris terpilih.</li> -->
			    <!--<li>tekan tombol <b>batal</b> untuk mengkosongkan kotak isian dan kembali ke mode tambah data (jika telah memasuki mode edit data)</li>-->            	
				<li>Menampilkan/tidak menampilkan data pada website:
					<ol>
						<li><img src="../images/status_1.gif"/>: data ditampilkan pada website</li>
						<li><img src="../images/status_0.gif"/>: data tidak ditampilkan pada website</li>
						<li>Klik pada gambar <img src="../images/status_0.gif"/> atau <img src="../images/status_1.gif"/> untuk mengubah status</li>
					</ol>
				</li>
                <li>klik <img src="../images/delete.png" alt="delete"/> untuk menghapus data pada baris yang bersangkutan.</li>
                <li>Masukan kata kunci dan tekan tombol cari untuk mencari data pada menu yang bersangkutan.</li>
			</ol>
		<div>';
        
        
        

} 
	return  $hasil; 
	
    	
}
$addStyle = ' style="font-weight:bold;color:#7E21AA;" ';

    $bantuanstatus =
	'<a href="javascript:void(0)" onclick="bantuan(0)">tentang status data</a>
		<span id="isihelp_0" class="sembunyi"><br/><br/>
			<img src="../images/status_1.gif"/> data pada baris ini statusnya aktif (ditampil pada halaman website)<br/>
			<img src="../images/status_1.gif"/> klik tombol ini untuk mengubah status menjadi tidak aktif<br/>
			<img src="../images/status_0.gif"/> data pada baris ini statusnya tidak aktif (tidak ditampil pada halaman website)<br/>
			<img src="../images/status_0.gif"/> klik tombol ini untuk mengubah status menjadi aktif<br/>
		</span><br/><br/>';
    $bantuaneditor_icon =
	'<a href="javascript:void(0)" onclick="bantuan(0)">tentang icon</a>
		<span id="isihelp_0" class="sembunyi"><br/><br/>
			<img src="../images/bs_up.gif"/> pindahkan posisi data pada baris ini ke atas<br/>
			<img src="../images/bs_down.gif"/> pindahkan posisi data pada baris ini ke bawah<br/>
		</span><br/><br/>';
  $bantuaneditor =
	'<a href="javascript:void(0)" onclick="bantuan(-1)">WYSIWYG Editor</a>
		<span id="isihelp_-1" class="sembunyi"><br/><br/>
		<b>Copy/Menyalin isi dari Dokumen MS Word</b><br/>
		Perlu diperhatikan ketika kita akan menyalin suatu data dari dokumen MS Word ke Editor ini.
		Data tersebut biasanya mengandung format atau style-style tertentu yang akan mempengaruhi format atau style yang ada di halaman Web.
		Format yang dimaksud biasanya adalah <b>jenis font</b> atau <b>ukuran font</b>.
		Hal inilah yang akan membuat suatu data pada halaman Web akan berubah tampilannya. 
		Untuk menghilangkan format dan styles suatu data yang disalin dari MS Word ikuti langkah2 berikut:<br/>
		<ol>
		<li>Copy/salin data dari MS Word</li>
		<li>Paste data tersebut pada editor dengan tombol <img border="0" src="../editor/images/pasteword.gif"/> (Paste From Word)</li>
		<li>Akan muncul jendela Paste From Word</li>
		<li>Dari jendela tersebut letakkan cursor pada text areanya.</li>
		<li>Kemudian tekan shortcut Ctrl+V atau dengan cara Right Click (klik kanan) pilih Paste.</li>
		<li>Pastikan Remove styles dicentang agar style dan format nya dapat dihilangkan.</li>
		<li>Terakhir, tekan tombol Insert untuk menyalin data ke Editor.</li>
		</ol>

		<b>Menyisipkan Gambar pada Editor</b><br/>
		Sebelum menyisipkan gambar pada Editor pastikan gambar Anda sudah berada di server.
		Untuk mengetahui apakah file gambar sudah berada di server atau belum caranya dengan menekan tombol <img border="0" src="../editor/images/image.gif"/> (Insert/Edit an Image).
		Perhatikan daftar file-file gambar yang sudah berada di server pada jendela Insert Image yang muncul.
		Klik pada panel sebelah kiri dan lihat gambarnya pada panel kanan untuk melihat gambarnya.
		Jika gambar yang dicari belum ada, yang dilakukan adalah meletakkan gambar tersebut di server (upload). Tata cara upload file dapat dilihat pada bagian <b>Meletakkan File Gambar di Server (Upload)</b> di bawah.
		<br/><br/>
		
		Setelah file gambar telah diupload berikut kelanjutan langkah-langkah untuk menyisipkan file gambar tersebut di Editor:<br/>
		<ol>
		<li>Setelah memilih file gambar, perhatikan tombol <b>Next...</b> yang sebelumnya non aktif akan menjadi aktif.</li>
		<li>Tekan tombol <b>Next...</b> tersebut, akan tampil step berikutnya dari jendela Insert Image</li>
		<li>Yang dilakukan selanjutnya adalah menentukan posisi gambar tersebut, yang biasanya diletakkan di kiri atau di kanan, caranya adalah dengan memilih Text flow.</li>
		<li>Kemudian untuk menentukan jarak antara tulisan di sekeliling gambar, dengan mengisi Distance to surrounding text, baik itu Top, Bottom, Left, Right dengan satuan pixel. Biasanya diisi 10 pixel.</li>
		<li>Perhatikan bila text-text di sekitar gambar tersebut bila mengandung daftar baik itu angka atau bullets, isi Distance to surrounding text dengan angka yang lebih besar dari 10 pixel, biasanya 20 pixel.</li>
		<li>Perhatikan Positioning Preview: untuk melihat posisinya.</li>
		<li>Tekan tombol OK.</li>
		</ol>

		<b>Meletakkan File Gambar di Server (Upload)</b><br/>
		Untuk upload file ikuti langkah-langkah berikut:<br/>
		<ol>
		<li>Bila jendela Insert Image belum muncul, tekan tombol <img border="0" src="../editor/images/image.gif"/> (Insert/Edit an Image)</li>
		<li>Perhatikan pada panel kanan sebelah atas, tekan tombol Browse</li>
		<li>Pilih file gambar yang akan di upload, tekan tombol Open.</li>
		<li>Kemudian tekan tombol Upload File.</li>
		<li>Perhatikan syarat-syarat gambar yang diperbolehkan untuk diupload.</li>
		</ol>
		
		<b>Membuat Tabel</b><br/>
		
		<br/><img src="../plugins/cluetip-1.0.6/images/manual_table.jpg"/><br/><br/>
		
		Untuk membuat tabel, berikut langkah-langkahnya:
		<ol>
		<li>Tekan tombol <img border="0" src="../editor/images/instable.gif"/> (Insert Table) pada toolbar Editor.</li>
		<li>Akan tampil jendela Insert Table</li>
		<li>Masukkan jumlah baris di Rows, jumlah kolom di Columns, lebar di Width, tinggi di Height.</li>
		<li>Cellspacing adalah jarak antara cell pada tabel, sedangkan cellpadding adalah jarak antara garis cell dengan isi cell.</li>
		<li>Penulis menyarankan untuk tidak merubah data yang ada, yang dapat disesuaikan adalah background color.</li>
		<li>Tekan tombol OK.</li>
		</ol>

		<b>Merubah Properti Cell, Row, dan Table</b><br/>
		Untuk melakukannya ikuti langkah-langkah berikut:
		<ol>
		<li>Dari suatu cell letakkan cursornya kemudian klik kanan, akan muncul menu pull down. Pilih Table, Row, and Cell Properties...</li>
		<li>Atau dengan menekan tombol <img border="0" src="../editor/images/edittable.gif"/> (Table, Row, and Cell Properties...)</li>
		<li>Akan tampak jendela Edit Table, Row, and Cell Properties.</li>
		<li>Pada jendela itu ada 3 tabulasi yaitu : This Cell, This Row, dan This Table.</li>
		<li>Pada tiap-tiap tabulasi terdapat properti-properti yang bisa dirubah.</li>
		<li>Untuk merubah hanya cell yang dipilih tersebut pilih tabulasi This Cell. </li>
		<li>Untuk merubah semua cell yang dipilih dalam satu baris pilih tabulasi This Row.</li>
		<li>Sedangkan untuk merubah properties tabel pilih tabulasi This Table.</li>
		</ol>
	</span><br/><br/>';
if($_GET) {
	$p = $_GET['p'];
	$hasil = '';
	if($p=="password") {
		$hasil =
			'<a  href="javascript:void(0)" onclick="bantuan(1)">Password Lama</a>
				<span id="isihelp_1" class="sembunyi">: untuk mengisi password lama.</span><br/><br/>
			<a  href="javascript:void(0)" onclick="bantuan(2)">Password Baru</a>
				<span id="isihelp_2" class="sembunyi">: untuk mengisi password baru yang diinginkan. Perhatikan jumlah karakter yang diperbolehkan.</span><br/><br/>
			<a  href="javascript:void(0)" onclick="bantuan(3)">Konfirmasi Password Baru</a>
				<span id="isihelp_3" class="sembunyi">: untuk mengisi password baru yang diinginkan. Langkah ini diperlukan untuk menghindari adanya kesalahan ketika mengisi password baru.</span><br/><br/>
			';
	
	} else if($p=="beritalist") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">mengedit data</a>
				<span id="isihelp_2" class="sembunyi">: klik data pada kolom <b>nama</b> untuk mengedit data pada baris yang bersangkutan.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(3)">mencari data tertentu</a>
				<span id="isihelp_3" class="sembunyi">: masukkan kata kunci pada pada kotak isian <b>kata kunci</b> kemudian tekan tombol cari untuk mencari data tertentu.</span><br/><br/>
			'.$bantuanstatus;
	} else if($p=="beritaupdate") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">judul</a>
				<span id="isihelp_2" class="sembunyi">: judul berita dan kegiatan.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(1)">kategori</a>
				<span id="isihelp_1" class="sembunyi">: kategori berita dan kegiatan.</span><br/><br/>		
			<a href="javascript:void(0)" onclick="bantuan(3)">isi</a>
				<span id="isihelp_3" class="sembunyi">: penjelasan atau detail berita dan kegiatan. Menggunakan WYSIWYG Editor. Untuk detail penggunaan editor ini click pada link bantuan <b>WYSIWYG Editor</b>.</span><br/><br/>
			'.$bantuaneditor;
	} else if($p=="kategorilist") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">mengedit data</a>
				<span id="isihelp_2" class="sembunyi">: klik data pada kolom <b>nama</b> untuk mengedit data pada baris yang bersangkutan.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(3)">mencari data tertentu</a>
				<span id="isihelp_3" class="sembunyi">: masukkan kata kunci pada pada kotak isian <b>kata kunci</b> kemudian tekan tombol cari untuk mencari data tertentu.</span><br/><br/>
			'.$bantuanstatus;
	} else if($p=="kategoriupdate") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">judul</a>
				<span id="isihelp_2" class="sembunyi">: nama kategori.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(9)">induk</a>
				<span id="isihelp_9" class="sembunyi">: pilih induk kategori.</span><br/><br/>
			';   
   	} else if($p=="agendalist") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">mengedit data</a>
				<span id="isihelp_2" class="sembunyi">: klik data pada kolom <b>nama</b> untuk mengedit data pada baris yang bersangkutan.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(3)">mencari data tertentu</a>
				<span id="isihelp_3" class="sembunyi">: masukkan kata kunci pada pada kotak isian <b>kata kunci</b> kemudian tekan tombol cari untuk mencari data tertentu.</span><br/><br/>
			'.$bantuanstatus;         
   } else if($p=="agendaupdate") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">judul</a>
				<span id="isihelp_2" class="sembunyi">: judul agenda.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(1)">kategori</a>
				<span id="isihelp_1" class="sembunyi">: pilih kategori agenda.</span><br/><br/>
   	        <a href="javascript:void(0)" onclick="bantuan(4)">tanggal mulai</a>
				<span id="isihelp_4" class="sembunyi">: tanggal mulai agenda acara.</span><br/><br/>	
             <a href="javascript:void(0)" onclick="bantuan(5)">tanggal selesai</a>
				<span id="isihelp_5" class="sembunyi">: tanggal akhir agenda acara.</span><br/><br/>	
			<a href="javascript:void(0)" onclick="bantuan(3)">isi</a>
				<span id="isihelp_3" class="sembunyi">: penjelasan atau detail berita dan kegiatan. Menggunakan WYSIWYG Editor. Untuk detail penggunaan editor ini click pada link bantuan <b>WYSIWYG Editor</b>.</span><br/><br/>
            '.$bantuaneditor;  
  	} else if($p=="fotoupdate") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(5)">kategori</a>
				<span id="isihelp_5" class="sembunyi">: kategori foto.</span><br/><br/>
            <a href="javascript:void(0)" onclick="bantuan(2)">Nama</a>
				<span id="isihelp_2" class="sembunyi">: nama foto.</span><br/><br/>
   	        <a href="javascript:void(0)" onclick="bantuan(3)">keterangan</a>
				<span id="isihelp_3" class="sembunyi">: penjelasan singkat foto (jika ada).</span><br/><br/>   	     
			<a href="javascript:void(0)" onclick="bantuan(1)">file gambar</a>
				<span id="isihelp_1" class="sembunyi">: untuk mengisi file foto. Tekan tombol browse untuk memilih file yang hendak diupload. Pastikan file yang hendak diupload memenuhi kriteria yang tertera di bawah kotak isian file dan kotak isian ukuran. Ketika <b>mengedit data</b> foto, Anda tidak perlu mengupload file jika Anda tidak ingin mengganti file.</span><br/><br/>
                
		   <a href="javascript:void(0)" onclick="bantuan(4)">resize otomatis</a>
				<span id="isihelp_4" class="sembunyi">: beri centang pada kotak isian ini untuk melakukan resize otomatis foto pada halaman website atau sebaliknya.</span><br/><br/>
		   <a href="javascript:void(0)" onclick="bantuan(9)">thumbnail</a>
				<span id="isihelp_9" class="sembunyi">: untuk mengisi file foto thumbnail. Tekan tombol browse untuk memilih file. Pastikan file yang hendak diupload memenuhi kriteria . Thumbnail otomatis dibuat jika Anda mengaktifkan <b>resize otomatis</b>.Ketika <b>mengedit data</b> foto, Anda tidak perlu mengupload file jika Anda tidak ingin mengganti file.</span><br/><br/>
			';
       	} else if($p=="fotolist") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">mengedit data</a>
				<span id="isihelp_2" class="sembunyi">: klik data pada kolom <b>nama</b> untuk mengedit data pada baris yang bersangkutan.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(3)">mencari data tertentu</a>
				<span id="isihelp_3" class="sembunyi">: masukkan kata kunci pada pada kotak isian <b>kata kunci</b> kemudian tekan tombol cari untuk mencari data tertentu.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(4)">menghapus foto secara permanen</a>
				<span id="isihelp_4" class="sembunyi">: <b>Peringatan</b>: Anda harus mengupload ulang foto jika ingin menampilkan foto yang telah dihapus dengan menggunakan fitur ini.<br/>Klik gambar <img src="../images/delete.png" /> pada kolom <b>hapus</b> untuk menghapus foto secara permanen.</span><br/><br/>
			'.$bantuanstatus;     
          	} else if($p=="videoupdate") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">nama</a>
				<span id="isihelp_2" class="sembunyi">: nama video.</span><br/><br/>
  		      <a href="javascript:void(0)" onclick="bantuan(3)">url</a>
				<span id="isihelp_3" class="sembunyi">: alamat youtube. Anda hanya memasukkan nilai <b>v</b>-nya saja.</span><br/><br/>
   	          <a href="javascript:void(0)" onclick="bantuan(9)">induk</a>
				<span id="isihelp_9" class="sembunyi">: pilih induk kategori.</span><br/><br/>   
			';
            
       	} else if($p=="videolist") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">mengedit data</a>
				<span id="isihelp_2" class="sembunyi">: klik data pada kolom <b>link</b> untuk mengedit data pada baris yang bersangkutan.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(3)">mencari data tertentu</a>
				<span id="isihelp_3" class="sembunyi">: masukkan kata kunci pada pada kotak isian <b>kata kunci</b> kemudian tekan tombol cari untuk mencari data tertentu.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(4)">menghapus video secara permanen</a>
				<span id="isihelp_4" class="sembunyi">: <b>Peringatan</b>: Anda harus mengupload ulang video jika ingin menampilkan video yang telah dihapus dengan menggunakan fitur ini.<br/>Click gambar pada kolom <b>hapus</b> untuk menghapus foto secara permanen.</span><br/><br/>
			'.$bantuanstatus;        
            
        } else if($p=="bannerlist") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">mengedit data</a>
				<span id="isihelp_2" class="sembunyi">: klik data pada kolom <b>nama</b> untuk mengedit data pada baris yang bersangkutan.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(3)">mencari data tertentu</a>
				<span id="isihelp_3" class="sembunyi">: masukkan kata kunci pada pada kotak isian <b>kata kunci</b> kemudian tekan tombol cari untuk mencari data tertentu.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(4)">menghapus banner secara permanen</a>
				<span id="isihelp_4" class="sembunyi">: <b>Peringatan</b>: Anda harus mengupload ulang banner jika ingin menampilkan banner yang telah dihapus dengan menggunakan fitur ini.<br/>Click gambar pada kolom <b>hapus</b> untuk menghapus banner secara permanen.</span><br/><br/>
			'.$bantuanstatus;
		} else if($p=="bannerupdate") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(1)">file</a>
				<span id="isihelp_1" class="sembunyi">: untuk mengisi file banner. Tekan tombol browse untuk memilih file yang hendak diupload. Pastikan file yang hendak diupload memenuhi kriteria yang tertera di bawah kotak isian file dan kotak isian ukuran. Ketika <b>mengedit data</b> banner, Anda tidak perlu mengupload file jika Anda tidak ingin mengganti file.</span><br/><br/>
            <a href="javascript:void(0)" onclick="bantuan(2)">nama</a>
				<span id="isihelp_2" class="sembunyi">: nama banner.</span><br/><br/>    
			<a href="javascript:void(0)" onclick="bantuan(5)">kategori</a>
				<span id="isihelp_5" class="sembunyi">: kategori banner. Angka di dalam tanda kurung merupakan syarat tambahan file untuk kategori tersebut.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(3)">URL</a>
				<span id="isihelp_3" class="sembunyi">: Alamat website banner.</span><br/><br/>
            <a href="javascript:void(0)" onclick="bantuan(4)">tanggal</a>
				<span id="isihelp_4" class="sembunyi">: tanggal aktif banner.</span><br/><br/>
			';    
           } else if($p=="imageheader") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(1)">mengedit header</a>
				<span id="isihelp_1" class="sembunyi">:
					<ol>
						<li>Klik gambar untuk mengupdate gambar header.</li>
						<li>Tekan Ctrl+F5 setelah mengupload gambar jika gambar belum berubah.</li>
					</ol>
				</span><br/><br/>
			';             
      	} else if($p=="updateheader") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(3)">keterangan</a>
				<span id="isihelp_3" class="sembunyi">: penjelasan singkat header (jika ada).</span><br/><br/>                  	 
			<a href="javascript:void(0)" onclick="bantuan(1)">file</a>
				<span id="isihelp_1" class="sembunyi">: untuk mengisi file header. Tekan tombol browse untuk memilih file yang hendak diupload. Pastikan file yang hendak diupload memenuhi kriteria yang tertera di bawah kotak isian file dan kotak isian ukuran. Ketika <b>mengedit data</b> banner, Anda tidak perlu mengupload file jika Anda tidak ingin mengganti file.</span><br/><br/>                   
			';          
      } else if($p=="pollinglist") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">mengedit data</a>
				<span id="isihelp_2" class="sembunyi">: klik data pada kolom <b>nama</b> untuk mengedit data pada baris yang bersangkutan.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(3)">mencari data tertentu</a>
				<span id="isihelp_3" class="sembunyi">: masukkan kata kunci pada pada kotak isian <b>kata kunci</b> kemudian tekan tombol cari untuk mencari data tertentu.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(4)">mereset dan melihat hasil</a>
				<span id="isihelp_4" class="sembunyi">: klik <b>reset</b> untuk mereset perhitungan polling atau klik <b>hasil</b> untuk melihat hasil polling di halaman baru.</span><br/><br/>
			'.$bantuanstatus;	
			             
      	} else if($p=="pollingupdate") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">jumlah pilihan</a>
				<span id="isihelp_2" class="sembunyi">: diisi dengan jumlah pilihan jawaban yang akan disediakan.</span><br/><br/>  
            <a href="javascript:void(0)" onclick="bantuan(3)">pertanyaan</a>
				<span id="isihelp_3" class="sembunyi">: menampilkan pertanyaan polling</span><br/><br/>                  	 
			<a href="javascript:void(0)" onclick="bantuan(1)">pilihan [angka]</a>
				<span id="isihelp_1" class="sembunyi">:  diisi dengan pilihan jawaban untuk pertanyaan</span><br/><br/>   
             <a href="javascript:void(0)" onclick="bantuan(4)">hapus pilihan</a>
				<span id="isihelp_4" class="sembunyi">: beri centang pada kotak ini untuk menghapus pilihan pada halaman website atau sebaliknya kemudian simpan.</span><br/><br/>                    
			';    
       	} else if($p=="halamanlist") {
		$hasil =
			'<a  href="javascript:void(0)" onclick="bantuan(1)">mengedit konten halaman</a>
			<span id="isihelp_1" class="sembunyi">: klik data pada kolom <b>Nama Halaman</b> untuk mengedit konten halaman.</span><br/><br/>
			';
	} else if($p=="halamanedit") {
		$hasil =
			'<a  href="javascript:void(0)" onclick="bantuan(1)">nama halaman</a>
				<span id="isihelp_1" class="sembunyi">: untuk mengisi nama halaman.</span><br/><br/>
			<a  href="javascript:void(0)" onclick="bantuan(2)">kategori</a>
				<span id="isihelp_2" class="sembunyi">: untuk memilih tipe halaman. Jika halaman yang bersangkutan akan dialihkan ke halaman lain/situs lain pilih kategori <b>aplikasi</b> dan isi alamat/url pada kotak isian include file. Kotak isian Isi Halaman akan diabaikan jika memilih kategori <b>aplikasi</b>.</span><br/><br/>
			<a  href="javascript:void(0)" onclick="bantuan(3)">isi halaman</a>
				<span id="isihelp_3" class="sembunyi">: isi konten halaman. Menggunakan WYSIWYG Editor. Untuk detail penggunaan editor ini klik pada link bantuan <b>WYSIWYG Editor</b>.</span><br/><br/>
			'.$bantuaneditor; 
	} else if($p=="filelist") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(2)">mengedit data</a>
				<span id="isihelp_2" class="sembunyi">: klik data pada kolom <b>nama</b> untuk mengedit data pada baris yang bersangkutan.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(3)">mencari data tertentu</a>
				<span id="isihelp_3" class="sembunyi">: masukkan kata kunci pada pada kotak isian <b>kata kunci</b> kemudian tekan tombol cari untuk mencari data tertentu.</span><br/><br/>
			<a href="javascript:void(0)" onclick="bantuan(4)">menghapus file secara permanen</a>
				<span id="isihelp_4" class="sembunyi">: <b>Peringatan</b>: Anda harus mengupload ulang file jika ingin menampilkan file yang telah dihapus dengan menggunakan fitur ini.<br/>Click gambar pada kolom <b>hapus</b> untuk menghapus file secara permanen.</span><br/><br/>
			'.$bantuanstatus;
	} else if($p=="fileupdate") {
		$hasil =
			'<a href="javascript:void(0)" onclick="bantuan(1)">file</a>
				<span id="isihelp_1" class="sembunyi">: untuk mengisi file. Tekan tombol browse untuk memilih file yang hendak diupload. Pastikan file yang hendak diupload memenuhi kriteria yang tertera di bawah kotak isian file dan kotak isian ukuran. Ketika <b>mengedit data</b> file, Anda tidak perlu mengupload file jika Anda tidak ingin mengganti file.</span><br/><br/>
            <a href="javascript:void(0)" onclick="bantuan(2)">nama</a>
				<span id="isihelp_2" class="sembunyi">: nama file.</span><br/><br/>    
			';   
	}
	
	echo '<div style="height:400px;overflow:auto;">'.$hasil.'</div>';
}

?>