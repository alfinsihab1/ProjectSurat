<?php
//cek status login
include "../include/auth.php"; 

//file configurasi
include "../include/config.php";

//mengambil data surat
if(isset($_GET['id'])){
	$id_user	    = $_GET['id'];
	$get			= mysqli_query($connect, "SELECT * FROM kode_masalah WHERE id_k_masalah = '$id_user'");
	$data			= mysqli_fetch_array($get);
    
}
//proses input

    
if(isset($_POST['submit'])){
	 
	$ks_masalah		= $_POST['k_masalah'];
	$masalah		= $_POST['masalah'];
	
	
	$query = mysqli_query($connect, "UPDATE kode_masalah SET k_masalah = '$ks_masalah', masalah = '$masalah' WHERE jenis_surat = '$id_user'");

	echo "<script>
				alert('Data User berhasil diubah')
				</script>

				<script>
				location.href='view_kode_masalah.php'
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
                    buat_textbox('Kode Isi Surat','k_masalah','',$data['k_masalah'],'required');
                    buat_textbox('Perihal','masalah','',$data['masalah'],'required');
			
                    tutup_form('Simpan','view_kode_masalah.php');
                ?>
							

            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
<?php include "../include/footer.php";?>