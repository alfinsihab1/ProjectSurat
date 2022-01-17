<?php
//cek status login
include "../include/auth.php"; 

//file configurasi
include "../include/config.php";
$view_ko = mysqli_query($connect,"select * from kode_surat");
//mengambil data surat
if(isset($_GET['id'])){
	
	$id_surat	= $_GET['id'];
	$get			= mysqli_query($connect, "SELECT * FROM outbox o
											JOIN kode_surat k
											ON o.id_kode = k.id_kode
											WHERE o.id_surat = '$id_surat'");
	$data			= mysqli_fetch_array($get);
}
//proses input
if(isset($_POST['submit'])){
	 
	$tujuan		= $_POST['tujuan'];
	$perihal	= $_POST['perihal'];
	$isi			= $_POST['isi'];
	 
	$query = mysqli_query($connect, "UPDATE outbox SET tujuan = '$tujuan', perihal = '$perihal', isi = '$isi' WHERE id_surat = '$id_surat'");
	echo "<script>
				alert('Data berhasil diubah')
				</script>

				<script>
				location.href='../outbox.php'
				</script>"; 
}
 
//fungsi tambahan
include "../include/form.php";
 
//title page
$titlepage = "Update Surat Keluar";

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
									
									buat_textbox('Nomor Surat','no_surat','Example XXX/SDS/FBTR/II/2018',$data['no_surat'],'disabled');
									
									buat_textbox('Tanggal Surat','tanggal','',dateIndo($data['tanggal']),'disabled');
									buat_textbox('Pengirim','pengirim','Masukan Nama Pengirim',$data['pengirim'],'disabled');

									buat_textbox('Tujuan','tujuan','Masukan Nama Tujuan',$data['tujuan'],'required');
									buat_textbox('Perihal','perihal','Example Liburan Akhir Tahun',$data['perihal'],'required');
									buat_textarea('Isi Surat','isi',$data['isi']);
								
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