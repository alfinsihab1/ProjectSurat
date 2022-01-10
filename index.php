<?php 
//cek status login
include "include/auth.php"; 

//file configurasi
include "include/config.php";

//menghitung data rincian aplikasi
$count1 = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM inbox"));
$count2 = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM outbox"));
$count3 = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user"));
$count4 = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM disposisi"));
$count5 = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM kode_surat"));

//title page
$titlepage = "Dashboard";

//header aplikasi
include "include/header.php";

?>
<div class="wrapper">
  <div class="container">
    <div class="row">
      <?php include "include/menu.php";?>

      <div class="span9">
        <div class="content">

          <div class="alert alert-success">
            <strong>Hai <?php echo $namausr;?>!</strong>
            Selamat datang di aplikasi Pengarsipan Surat Kejaksaan Negeri Bireun.<br />
            Anda telah login sebagai
            <?php if($aksesusr == 2){
              echo "Pimpinan";
              }
              else if($aksesusr == 1){
                echo "Petugas Arsip";
                }
                else{
                   echo "Admin";
                   } 
            ?>.
            Berikut rincian data aplikasi.
          </div>

          <div class="btn-controls">
            <?php if($aksesusr == 2){ ?>

              <div class="btn-box-row row-fluid">
                <a href="inbox.php" class="btn-box big span4">
                  <i class=" icon-inbox"></i>

                  <b><?php echo $count1; ?></b>

                  <p class="text-muted">Surat Masuk</p>
                </a>

                <a href="outbox.php" class="btn-box big span4">
                  <i class="icon-envelope"></i>

                  <b><?php echo $count2; ?></b>

                  <p class="text-muted"> Surat Keluar</p>
                </a>

                <a href="proses/disposisi.php?cek=0&&id=0" class="btn-box big span4">
                  <i class="icon-edit"></i>

                  <b><?php echo $count4; ?></b>

                  <p class="text-muted">Disposisi</p>
                </a>
              
              </div>
            

            <?php }
            else if($aksesusr == 1){
            ?>
              <div class="btn-box-row row-fluid">
                <a href="inbox.php" class="btn-box big span4">
                  <i class=" icon-inbox"></i>

                  <b><?php echo $count1; ?></b>

                  <p class="text-muted">Surat Masuk</p>
                </a>

                <a href="outbox.php" class="btn-box big span4">
                  <i class="icon-envelope"></i>

                  <b><?php echo $count2; ?></b>

                  <p class="text-muted"> Surat Keluar</p>
                </a>
              </div>
            <?php
            }
            else{ ?>

            <div class="btn-box-row row-fluid">
              <a <?php if($aksesusr == 0){ ?> href="users.php" <?php } ?> class="btn-box big span3">
                <i class="icon-group"></i>

                <b><?php echo $count3; ?></b>

                <p class="text-muted">Pengguna</p>
              </a>
              <a href="proses/view_kode.php" class="btn-box big span4">
                <i class="icon-edit"></i>

                <b><?php echo $count5; ?></b>

                <p class="text-muted">Jenis Surat</p>
              </a>

            </div>

            <?php } ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!--footer aplikasi-->
<?php include "include/footer.php";?>