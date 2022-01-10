<?php 
//cek status login
include "include/auth.php"; 

//file configurasi
include "include/config.php";

$sql = "SELECT * from outbox ORDER BY id_surat DESC";
$query = mysqli_query ($connect,$sql);

//title page
$titlepage = "Surat Keluar";

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
                                if($aksesusr == 1){
                                    echo'
								    <a href="proses/input_outbox.php" class="btn btn-module pull-right"><i class="icon-plus"></i> Tambah Data</a>
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
												<th>Jenis</th>
												<th>Perihal</th>
												<th>Tujuan</th>
												<th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										while($data = mysqli_fetch_array ($query)){ ?>
                                            <tr>
                                                <td><?php echo $data['no_surat'];?></td>
                                                <td><?php echo $data['jenis'];?></td>
												<td><?php echo $data['perihal'];?></td>
												<td><?php echo $data['tujuan'];?></td>
												<td>
													<div class="btn-group">
														<a href="proses/detail_outbox.php?id=<?php echo $data['id_surat'];?>" class="btn btn-small">Detail</a>
														<?php if($aksesusr != 2){ ?>
															<a href="proses/edit_outbox.php?id=<?php echo $data['id_surat'];?>">Edit</a>
															
															<?php } ?>
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