<?php 
//cek status login
include "include/auth.php"; 
//file configurasi
include "include/config.php";
//mengambil data surat
$sql = "SELECT * from inbox";
$query = mysqli_query ($connect, $sql);
//title page
$titlepage = "Surat Masuk";
//header aplikasi
include "include/header.php";
?>
<div class="wrapper">
  <div class="container">
    <div class="row">
      <?php include "include/menu.php";?>
      <div class="span9">
        <div class="content">
          <div class="module">
            <div class="module-head">
              <?php 
              if ($aksesusr == 1){
                echo '
                <a href="proses/input_inbox.php" class="btn btn-module pull-right">
                  <i class="icon-plus"></i> Tambah Data
                </a>
                ';
              }
              ?>
              <h2><?php echo $titlepage;?> </h2>
            </div>
            <div class="module-body table">
              <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-striped display"
                width="100%">
                <thead>
                  <tr>
                    <th>No Surat</th>
                    <th>Perihal</th>
                    <th>Pengirim</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
										while($data = mysqli_fetch_array ($query)){ 
											$tarik = mysqli_query($connect, "SELECT * FROM inbox i LEFT JOIN disposisi d ON i.id_surat = d. id_surat WHERE i.id_surat = '$data[id_surat]'");
											$cek1 = mysqli_num_rows($tarik);
											$cek = mysqli_fetch_array($tarik); ?>
                  <tr>
                    <td><?php echo $data['no_surat'];?></td>
                    <td><?php echo $data['perihal'];?></td>
                    <td><?php echo $data['pengirim'];?></td>
                    <td>
                      <?php 
                        if($cek['status'] == 'Diterima'){ 
                        echo '<a class="btn btn-small btn-success">Diterima</a>';
                        } 
                        else if($cek['status'] == 'Ditolak'){ 
                          echo '<a class="btn btn-small btn-danger">Ditolak</a>';
                        } 
                        else if($cek['status'] == 'Pending'){ 
                          echo '<a class="btn btn-small btn-warning">Pending</a>';
                        } 
                        else{ 
                          echo '<a class="btn btn-small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
                        } 
                      ?>

                    <td>
                      <div class="btn-group">
                        <a href="proses/detail_inbox.php?id=<?php echo $data['id_surat'];?>&&cek=1"
                          class="btn btn-small">Detail</a>

                        <a type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                        </a>

                        <?php
                            if($aksesusr == 2){ ?>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="proses/input_disposisi.php?id=<?php echo $data['id_surat'];?>">Add Disposisi</a>
                        <?php }?>
                          </li>
                        </ul>
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
<?php include "include/footer.php";?>