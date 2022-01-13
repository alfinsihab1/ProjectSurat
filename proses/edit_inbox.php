<?php
//cek status login
include "../include/auth.php"; 

//file configurasi
include "../include/config.php";
$view_ko = mysqli_query($connect,"select * from kode_surat");

//mengambil data surat
if(isset($_GET['id'])){
	$id_surat	= $_GET['id'];
	$get			= mysqli_query($connect, "SELECT * FROM inbox WHERE id_surat = '$id_surat'");
	$data			= mysqli_fetch_array($get);

  
}
//proses input
if(isset($_POST['submit'])){
	
	$perihal	= $_POST['perihal'];
  $jenis_surat = $_POST['jenis'];
  $isi_surat  = $_POST['isi_surat'];
	 
	$query = mysqli_query($connect, "UPDATE inbox SET perihal = '$perihal' ,jenis = '$jenis_surat', isi_surat = '$isi_surat' WHERE id_surat = '$id_surat'");
	echo "<script>
				alert('Data berhasil diubah')
				</script>

				<script>
				location.href='detail_inbox.php?id= $id_surat&&cek=1'
				</script>"; 
}
 
//fungsi tambahan
include "../include/form.php";
 
//title page
$titlepage = "Update Surat Masuk";

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
									buat_textbox('Tanggal Dikirim','tanggal','',dateIndo($data['tanggal_kirim']),'disabled');
                  buat_textbox('Tanggal Diterima','tanggal','',dateIndo($data['tanggal_terima']),'disabled');
									buat_textbox('Pengirim','pengirim','Masukan Nama Pengirim',$data['pengirim'],'disabled');

                  $list[]	= array('val' => '', 'cap' => '--Pilih Jenis Surat--');
                  while ($data1 = mysqli_fetch_array($view_ko)){
                       $list[]	= array('val' => $data1['jenis_surat'], 'cap' => $data1['jenis_surat']);
                  }
                  buat_combobox('Jenis Surat','jenis',$list,$data['jenis']);
									buat_textbox('Perihal','perihal','Example Liburan Akhir Tahun',$data['perihal'],'required');
									buat_textarea('Isi Surat','isi_surat',$data['isi_surat']);
									
								
								tutup_form('Simpan','detail_inbox.php?id='.$id_surat.'&&cek=1');
							?>

            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
<?php include "../include/footer.php";?>