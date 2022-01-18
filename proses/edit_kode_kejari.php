<?php
//cek status login
include "../include/auth.php"; 

//file configurasi
include "../include/config.php";

//mengambil data surat
if(isset($_GET['id'])){
	$id_user	    = $_GET['id'];
	$get			= mysqli_query($connect, "SELECT * FROM kode_kejari WHERE id_kejari = '$id_user'");
	$data			= mysqli_fetch_array($get);
    
}
//proses input

    
if(isset($_POST['submit'])){
	 
	$ks_masalah		= $_POST['nama_kode'];
	$masalah		= $_POST['bagian'];
	
	
	$query = mysqli_query($connect, "UPDATE kode_kejari SET nama_kode = '$ks_masalah', bagian = '$masalah' WHERE id_kejari = '$id_user'");

	echo "<script>
				alert('Data berhasil diubah')
				</script>

				<script>
				location.href='../view_kode_kejari.php'
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
                    buat_textbox('Kode ','nama_kode','',$data['nama_kode'],'required');
                    buat_textbox('Bagian','bagian','',$data['bagian'],'required');
			
                    tutup_form('Simpan','../view_kode_kejari.php');
                ?>
							

            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
<?php include "../include/footer.php";?>