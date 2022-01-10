<?php

include "../include/config.php";

if(isset($_GET['id'])){
	$id_user	= $_GET['id'];
	$sql		= mysqli_query($connect, "DELETE FROM kode_surat WHERE jenis_surat = '$id_user'");
	header("location:view_kode.php");
    echo "<script>
    alert('Berhasil Dihapus!')
    </script>";
}
?>