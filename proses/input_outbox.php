<?php
//cek status login
include "../include/auth.php"; 

//file configurasi
include "../include/config.php";

$last_sql = mysqli_query($connect,"select COUNT(id_surat) from outbox");
$last_id = mysqli_fetch_array($last_sql);

$view_ko = mysqli_query($connect,"select * from kode_surat");

$cek_last_id = $last_id['COUNT(id_surat)']+1;	



//proses input
if(isset($_POST['submit'])){
	 
	 
	 $kode_isi		= $_POST['kode_isi'];
	 $jenis			= $_POST['jenis'];
	 $tanggal		= $_POST['tanggal'];
	 $pengirim		= $_POST['pengirim'];
	 $tujuan		= $_POST['tujuan'];
	 $perihal		= $_POST['perihal'];
	 $isi			= $_POST['isi'];

	 $year = date('Y', strtotime($tanggal));
	 $month = date('m', strtotime($tanggal));


	 if($jenis == 'Surat Biasa'){
		$kod = 1;
		$query2 = mysqli_query($connect,"select k_surat from kode_surat WHERE id_kode=".$kod);
	 }
	 else if($jenis == 'Surat Keputusan'){
		$kod = 2;
		$query2 = mysqli_query($connect,"select k_surat from kode_surat WHERE id_kode=".$kod);
	 }
	 else if($jenis == 'Surat Perintah'){
		$kod =3;
		$query2 = mysqli_query($connect,"select k_surat from kode_surat WHERE id_kode=".$kod);
	 }
	 else{
		 echo "<script>alert('Pilihan Surat Tidak Tersedia')</script><script>location.href='../outbox.php'</script>";
	 }

	 $result2 = mysqli_fetch_array($query2);
	 $no_surat = $result2['k_surat'].'-'.$cek_last_id.'/L.1.21/'.$kode_isi.'/'.$month.'/'.$year;

	 $sql	= mysqli_query($connect,"select * from outbox where no_surat='$no_surat'");
	 $cek	= mysqli_num_rows($sql);
	 
	 if($cek > 0){
		 echo "<script>alert('Nomor Surat Sudah digunakan!')</script>";
	 }else{
		 $query = mysqli_query($connect,"insert into outbox values ('','$jenis','$tanggal','$no_surat','$pengirim','$tujuan','$perihal','$isi')");
		 echo "<script>alert('Data berhasil ditambah')</script><script>location.href='../outbox.php'</script>";
	 }
 }
 
 //fungsi tambahan
 include "../include/form.php";
 
//title page
$titlepage = "Input Surat Masuk";

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
											
											buat_textbox('Kode Isi Surat','kode_isi','Kode Isi Surat','','required');
											
											$list[]	= array('val' => '', 'cap' => '--Pilih Jenis Surat--');
											while ($data1 = mysqli_fetch_array($view_ko)){
												$list[]	= array('val' => $data1['jenis_surat'], 'cap' => $data1['jenis_surat']);
											}
											// $list[]	= array('val' => 'Surat Biasa', 'cap' => 'Surat Biasa');
											// $list[] = array('val' => 'Surat Keputusan', 'cap' => 'Surat Keputusan');
											// $list[]	= array('val' => 'Surat Perintah', 'cap' => 'Surat Perintah');

											
											buat_combobox('Jenis Surat','jenis',$list,'');
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