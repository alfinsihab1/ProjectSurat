<?php
//cek status login
include "../include/auth.php"; 

//file configurasi
include "../include/config.php";

if(isset($_GET['id'])){
	$cek_form = $_GET['id'];
}



$last_sql = mysqli_query($connect,"select COUNT(id_surat) from outbox");
$last_id = mysqli_fetch_array($last_sql);

$view_k = mysqli_query($connect,"select * from outbox");
$view_ko = mysqli_query($connect,"select * from kode_surat");
$view_ko2 = mysqli_query($connect,"select * from kode_kejora");
$view_ko1 = mysqli_query($connect,"select * from kode_masalah");

$cek_last_id = $last_id['COUNT(id_surat)']+1;	


$query0=mysqli_fetch_array($view_k);
$query1=mysqli_fetch_array($view_ko1);
$query2=mysqli_fetch_array($view_ko2);

//proses input
if(isset($_POST['submit'])){
	 
	
	 $jenis			= $_POST['jenis'];
	 $kode_masalah	= $_POST['kode_masalah'];
	 $kode_kejora	= $_POST['kode_kejora'];
	 $tanggal		= $_POST['tanggal'];
	 $pengirim		= $_POST['pengirim'];
	 $tujuan		= $_POST['tujuan'];
	 $perihal		= $_POST['perihal'];
	 $isi			= $_POST['isi'];

	 $year = date('Y', strtotime($tanggal));
	 $month = date('m', strtotime($tanggal));
	 $pilih_jenis = mysqli_query($connect,"select k_surat from kode_surat WHERE id_kode =".$jenis);
	 $query_jenis = mysqli_fetch_array($pilih_jenis);
	 $pilih_jenis = $query_jenis['k_surat'];

	 $no_surat = $pilih_jenis.'-'.$cek_last_id.'/'.$kode_kejora.'/'.$kode_masalah.'/'.$month.'/'.$year;

	 $sql	= mysqli_query($connect,"select * from outbox where no_surat='$no_surat'");
	 $cek	= mysqli_num_rows($sql);
	 
	 if($cek > 0){
		 echo "<script>alert('Nomor Surat Sudah digunakan!')</script>";
	 }else{
		 $query = mysqli_query($connect,"insert into outbox values ('','$jenis','$tanggal','$no_surat','$pengirim','$tujuan','$perihal','$isi')");
		 echo "<script>
		 alert(berhasil ditambah')
		 </script>
		 
		 <script>
		 location.href='../outbox.php'
		 </script>";
	 }
 }
 
 //fungsi tambahan
 include "../include/form.php";
 
//title page
$titlepage = "Input Surat Keluar";

//header aplikasi
include "../include/header_user.php";
 
 ?>
 
 <div class="wrapper">
            <div class="container">
			
                <div class="row">
				<?php include "../include/menu_user.php";?>
                     <div class="span9">
                        <div class="content">
						
                            <div class="module">
                                <div class="module-head">
                                    <h2><?php echo $titlepage;?> </h2> 
                                </div>
                                <div class="module-body">
								
									<?php
										buka_form();
											
											$list[]	= array('val' => '', 'cap' => '--Pilih Jenis Surat--');
											while ($data1 = mysqli_fetch_array($view_ko)){
												$list[]	= array('val' => $data1['id_kode'], 'cap' => $data1['jenis_surat']);
											}
											buat_combobox('Jenis Surat','jenis',$list,'');


											$list2[]	= array('val' => '', 'cap' => '--Pilih Kode Masalah--');
											while ($data2 = mysqli_fetch_array($view_ko1)){
												$list2[]	= array('val' => $data2['k_masalah'], 'cap' => $data2['masalah']);
											}
											buat_combobox('Kode Masalah','kode_masalah',$list2,'');

											
											$list3[]	= array('val' => '', 'cap' => '--Pilih Kode Kejaksaan--');
											while ($data3 = mysqli_fetch_array($view_ko2)){
												$list3[]	= array('val' => $data3['nama_kode'], 'cap' => $data3['bagian']);
											}
											
											buat_combobox('Jenis Surat','kode_kejora',$list3,'');
											buat_datebox('Tanggal Surat','tanggal','','required');
											buat_textbox('Pengirim','pengirim','Masukan Nama Pengirim','','required');
											buat_textbox('Tujuan','tujuan','Masukan Nama Tujuan','','required');
											buat_textbox('Perihal','perihal','Example Liburan Akhir Tahun','','required');
											buat_textarea('Isi Surat','isi','');
										
											tutup_form('Simpan','../outbox.php');
									
									?>
																			
								</div>
							</div>
							
                        </div>
                    </div>
                </div>
				
            </div>
        </div>
<?php include "../include/footer.php";?>
