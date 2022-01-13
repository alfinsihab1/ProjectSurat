<?php 
//cek status login
include "../include/auth.php"; 

//cek akses user
if($aksesusr != 1){
	echo "<script>
        alert('Anda tidak memiliki izin untuk mengakses halaman ini!')
        </script>
        
        <script>
        location.href='".$arsipsurat."'
        </script>";
}

//file configurasi
include "../include/config.php";

$sql    = "SELECT * FROM kode_masalah";
$query  = mysqli_query ($connect, $sql);

//title page
$titlepage = "Kode Isi Surat";

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
              <a href="input_kode_masalah.php" class="btn btn-module pull-right">
                <i class="icon-plus"></i> Tambah Kode Isi Surat
              </a>

              <h2><?php echo $titlepage;?> </h2>
            </div>

            <div class="module-body table">

              <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-striped display"
                width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode isi Surat</th>
                    <th>Perihal</th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                  $no = 1;
                  
                  while($data = mysqli_fetch_array ($query)){ ?>

                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $data['k_masalah'];?></td>
                    <td><?php echo $data['masalah'];?></td>

                    <td>
                      <div class="btn-group">
                        <a href="edit_kode_masalah.php?id=<?php echo $data['id_k_masalah'];?>" type="button"
                          class="btn btn-small">Edit</a>
                        <a href="delete_kode_masalah.php?id=<?php echo $data['id_k_masalah'];?>" type="button"
                          class="btn btn-small">Hapus</a>
                      </div>
                    </td>
                  </tr>

                  <?php } ?>
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<?php include "../include/footer.php";?>