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

//proses input
if(isset($_POST['submit'])){
	 
	$user		= $_POST['user'];
	$nama		= $_POST['nama'];
	$pass		= $_POST['pass'];
	$akses		= $_POST['akses'];
	
	$sql	= mysqli_query($connect, "SELECT * FROM user WHERE username = '$user'");
	$cek	= mysqli_num_rows($sql);
	
	if($cek > 0){
		echo "<script>
					alert('Username Sudah digunakan!')
					</script>";
	}
	else{
		$pass = md5($pass);
		$query = mysqli_query($connect, "INSERT INTO user VALUES ('','$nama','$user','$pass','$akses')");

		echo "<script>
					alert('User berhasil ditambah')
					</script>
					
					<script>
					location.href='../users.php'
					</script>";
	}
}
 
//fungsi tambahan
include "../include/form.php";
 
//title page
$titlepage = "Input Pengguna Baru";

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
								
									buat_textbox('Nama','nama','Masukan Nama User','','required');
									buat_textbox('Username','user','Masukan Username','','required');
									buat_passbox('Password','pass','Masukan Password','required');
									
									$list[]	= array('val' => '', 'cap' => '--Pilih Akses User--');
									$list[]	= array('val' => '0', 'cap' => 'Administrator');
									$list[] = array('val' => '1', 'cap' => 'Petugas Arsip');
									$list[]	= array('val' => '2', 'cap' => 'Pimpinan/Atasan');
									
									buat_combobox('Akses User','akses',$list,'');
									
								tutup_form('Simpan','users.php');
							?>

            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
<?php include "../include/footer.php";?>