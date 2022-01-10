<?php
//cek status login
include "../include/auth.php"; 

//file configurasi
include "../include/config.php";

//mengambil data surat
if(isset($_GET['id'])){
	$id_user	    = $_GET['id'];
	$get			= mysqli_query($connect, "SELECT * FROM kode_surat WHERE jenis_surat = '$id_user'");
	$data			= mysqli_fetch_array($get);
    
}
//proses input

    
if(isset($_POST['submit'])){
	 
	$nama		= $_POST['jenis_surat'];
	$pass		= $_POST['k_surat'];
	
	
	$query = mysqli_query($connect, "UPDATE kode_surat SET jenis_surat = '$nama', k_surat = '$pass' WHERE jenis_surat = '$id_user'");

	echo "<script>
				alert('Data User berhasil diubah')
				</script>

				<script>
				location.href='view_kode.php'
				</script>";
 }
 
//fungsi tambahan
include "../include/form.php"; 

//title page
$titlepage = "Update Data User";

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
									buat_textbox('Jenis Surat','jenis_surat','',$data['jenis_surat'],'required');
									buat_textbox('Kode surat','k_surat','',$data['k_surat'],'required');

								
								tutup_form('Simpan','view_kode.php');
							?>
							

            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
<?php include "../include/footer.php";?>