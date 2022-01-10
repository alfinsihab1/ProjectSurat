<?php 
//cek status login
include "../include/auth.php"; 

//file configurasi
include "../include/config.php";

//mengambil data surat
// if(isset($_GET['id'])){
	$idsurat		= $_GET['id'];
  $cek_arr    = $_GET['cek'];

  if($cek_arr == 1){
  // WHERE id_surat='$idsurat'
	$get				= mysqli_query($connect, "SELECT * FROM inbox WHERE id_surat = '$idsurat'");
	$surat			= mysqli_fetch_array($get);
	$no_surat		= $surat['no_surat'];
// }

  //mengambil data disposisi surat
  $query = mysqli_query ($connect, "SELECT * 
                                    FROM disposisi d
                                    JOIN inbox i
                                    ON d.id_surat = i.id_surat 
                                    WHERE d.id_surat = '$idsurat'
                                    ");
  }
  else{
	$get				= mysqli_query($connect, "SELECT * FROM inbox ");
	$surat			= mysqli_fetch_array($get);
	$no_surat		= $surat['no_surat'];
// }

  //mengambil data disposisi surat
  $query = mysqli_query ($connect, "SELECT * 
                                    FROM disposisi d
                                    JOIN inbox i
                                    ON d.id_surat = i.id_surat 
                                    ");
  }

//title page
$titlepage = "Disposisi";

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
              <!-- <?php if($aksesusr == 2){ ?>
              <a href="input_disposisi.php?id=<?php echo $idsurat; ?>" class="btn btn-module pull-right">
                <i class="icon-plus"></i> Tambah Data</a>

              <?php } ?> -->
              <h2><?php echo $titlepage;?> </h2>
            </div>

            <div class="module-body table">

              <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-striped display"
                width="100%">
                <thead>
                  <tr>
                    <th>No Surat</th>
                    <th>Kepada</th>
                    <th>Status</th>
                    <th>Tanggapan</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
										while($data = mysqli_fetch_array ($query)){ 
                  ?>

                  <tr>
                    <td><?php echo $data['no_surat'];?></td>
                    <td><?php echo $data['kepada'];?></td>
                    <td>                      
                      <?php 
                        if($data['status'] == 'Diterima'){ 
                        echo '<a class="btn btn-small btn-success">Diterima</a>';
                        } 
                        else if($data['status'] == 'Ditolak'){ 
                          echo '<a class="btn btn-small btn-danger">Ditolak</a>';
                        } 
                        else if($data['status'] == 'Pending'){ 
                          echo '<a class="btn btn-small btn-warning">Pending</a>';
                        } 
                        else{ 
                          echo '<a class="btn btn-small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
                        } 
                      ?></td>
                    <td><?php echo $data['tanggapan'];?></td>
                    <?php if($aksesusr == 2){?>
                    <div class="btn-group">
                      <td><a href="edit_disposisi.php?id=<?php echo $data['id_surat'];?>"
                            class="btn btn-small">Edit</a>
                      </td>
                    </div>
                    <?php }?>
                  </tr>

                  <?php } ?>
                </tbody>
              </table>

            </div>
            <?php
            if($cek_arr == 1){ ?>
                <a href="detail_inbox.php?id=<?php echo $surat['id_surat'];?>&&cek=1" class="btn btn-module pull-right">
                <i class="icon-arrow-left"></i> Kembali
              </a>
            <?php  } 
            else{ ?>
                <a href="../index.php" class="btn btn-module pull-right">
                <i class="icon-arrow-left"></i> Kembali
              </a>
            <?php } ?>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<?php include "../include/footer.php";?>