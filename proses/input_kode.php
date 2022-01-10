<?php
//cek status login
include "../include/auth.php"; 

//cek akses user
if($aksesusr != 0){
	echo "<script>
				alert('Anda tidak memiliki hak untuk mengakses halaman ini!')
				</script>
				
				<script>
				location.href='".$arsipsurat."'
				</script>";
}

//file configurasi
include "../include/config.php";

$sql_count	= mysqli_query($connect, "SELECT COUNT(id_kode) FROM kode_surat");
$cek_count	= mysqli_fetch_array($sql_count);

$cekk =  $cek_count['COUNT(id_kode)'];
//proses input
if(isset($_POST['submit'])){
	 
    $id_kode        = $cek_count['COUNT(id_kode)'];
	$jenis_surat	= $_POST['jenis_surat'];
	$k_surat		= $_POST['k_surat'];
	
	$sql	= mysqli_query($connect, "SELECT * FROM kode_surat WHERE jenis_surat = '$jenis_surat'");
	$cek	= mysqli_num_rows($sql);
	
	if($cek > 0){
		echo "<script>
					alert('Jenis Surat Sudah ada!')
					</script>";
	}
	else{
        $cekk = $cekk + 1;
		$query = mysqli_query($connect, "INSERT INTO kode_surat VALUES ('$cekk','$k_surat','$jenis_surat')");

		echo "<script>
					alert('User berhasil ditambah')
					</script>
					
					<script>
					location.href='view_kode.php'
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
                                buat_textbox('Jenis Surat','jenis_surat','Masukan Jenis Surat','','required');
                                buat_textbox('Kode Surat','k_surat','Masukan Kode Surat','','required');

                            
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