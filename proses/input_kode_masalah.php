<?php
//cek status login
include "../include/auth.php"; 

//cek akses user
if($aksesusr != 1){
	echo "<script>
				alert('Anda tidak memiliki hak untuk mengakses halaman ini!')
				</script>
				
				<script>
				location.href='".$arsipsurat."'
				</script>";
}

//file configurasi
include "../include/config.php";

//proses input
if(isset($_POST['submit'])){
	 
	$kode_masalah	= $_POST['k_masalah'];
	$masalah		= $_POST['masalah'];
	
	$sql	= mysqli_query($connect, "SELECT * FROM kode_masalah WHERE k_masalah = '$kode_masalah'");
	$cek	= mysqli_num_rows($sql);
	
	if($cek > 0){
		echo "<script>
					alert('Kode Isi Surat Sudah Ada!')
					</script>";
	}
	else{
		$query = mysqli_query($connect, "INSERT INTO kode_masalah VALUES ('','$kode_masalah','$masalah')");

		echo "<script>
					alert('berhasil ditambah')
					</script>
					
					<script>
					location.href='view_kode_masalah.php'
					</script>";
	}
}
 
//fungsi tambahan
include "../include/form.php";
 
//title page
$titlepage = "Input Jenis Surat";

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
                buat_textbox('Kode Isi Surat','k_masalah','Masukan Kode Isi Surat','','required');
                buat_textbox('Perihal','masalah','Masukan perihal','','required');
            
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