<?php
//cek status login
include "../include/auth.php"; 

//file configurasi
include "../include/config.php";

//mengambil data surat
if(isset($_GET['id'])){
	
	$id_user	= $_GET['id'];
	$get			= mysqli_query($connect, "SELECT * FROM user WHERE id_user = '$id_user'");
	$data			= mysqli_fetch_array($get);
	
}
//proses input

if(isset($_POST['submit'])){
	 
	$nama		= $_POST['nama'];
	$pass		= $_POST['pass'];
	$akses	= $_POST['akses'];
	 
	$pass = md5($pass);
	$query = mysqli_query($connect, "UPDATE user SET nama = '$nama', PASSWORD = '$pass', akses = '$akses' WHERE id_user = '$id_user'");

	echo "<script>
				alert('Data User berhasil diubah')
				</script>

				<script>
				location.href='../users.php'
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
									buat_textbox('Username','user','',$data['username'],'disabled');
									buat_textbox('Nama','nama','',$data['nama'],'required');
									buat_passbox('Password','pass','Masukan Password','required');
									
									$list[]	= array('val' => '', 'cap' => '--Pilih Akses User--');
									$list[]	= array('val' => '0', 'cap' => 'Administrator');
									$list[] = array('val' => '1', 'cap' => 'Petugas Arsip');
									$list[]	= array('val' => '2', 'cap' => 'Pimpinan/Atasan');
									
									buat_combobox('Akses User','akses',$list,$data['akses']);
								
								tutup_form('Simpan','../users.php');
								echo'
								<a href="editpwd.php?id='.$data['id_user'].'" class="btn btn-module"><i class="icon-arrow-right"></i>Ubah Password</a>
								'
							?>
							

            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
<?php include "../include/footer.php";?>