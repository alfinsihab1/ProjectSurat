<?php

include "../include/config.php";

if(isset($_GET['id'])){
	$id_user	= $_GET['id'];
	$sql		= mysqli_query($connect, "DELETE FROM kode_masalah WHERE id_k_masalah = '$id_user'");
	header("location:view_kode_masalah.php");
    echo "<script>
    alert('Berhasil Dihapus!')
    </script>";
}
?>